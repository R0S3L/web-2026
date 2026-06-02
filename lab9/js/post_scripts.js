document.addEventListener('DOMContentLoaded', async () => {
    // Элементы интерфейса
    const fileInput = document.getElementById('fileInput');
    const btnBlackAdd = document.getElementById('btnBlackAdd');
    const btnLinkAdd = document.getElementById('btnLinkAdd');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const createSlider = document.getElementById('createSlider');
    const sliderTrack = document.getElementById('sliderTrack');
    const btnShare = document.getElementById('btnShare');
    const postDescription = document.getElementById('postDescription');
    const userId = document.getElementById('userId');
    const postId = document.getElementById('postId');
    const isEditing = document.getElementById('isEditing').value === '1';
    
    const slidePrev = document.getElementById('slidePrev');
    const slideNext = document.getElementById('slideNext');
    const currentSlideCtx = document.getElementById('currentSlide');
    const totalSlidesCtx = document.getElementById('totalSlides');

    const formContainer = document.getElementById('formContainer');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    // Массив для хранения загруженных файлов (объектов File)
    let uploadedFiles = [];
    let currentSlideIndex = 0;
    let existingPostImage = null; // For edit mode

    // Load existing post data if editing
    if (isEditing && postId.value) {
        try {
            const response = await fetch(`../home/api_get_post.php?post_id=${postId.value}`);
            const data = await response.json();
            
            if (data.success && data.post) {
                const post = data.post;
                postDescription.value = post.post_description;
                existingPostImage = post.post_image;
                
                // Show existing image as default
                if (existingPostImage) {
                    const existingImg = new Image();
                    existingImg.src = `../images/${existingPostImage}`;
                    existingImg.onload = () => {
                        // Create a blob from the image URL to add to uploadedFiles
                        fetch(`../images/${existingPostImage}`)
                            .then(res => res.blob())
                            .then(blob => {
                                const file = new File([blob], existingPostImage, { type: blob.type });
                                uploadedFiles.push(file);
                                updateSliderUI();
                                validateForm();
                            })
                            .catch(err => console.error('Failed to load existing image:', err));
                    };
                    existingImg.onerror = () => {
                        updateSliderUI();
                        validateForm();
                    };
                }
            } else {
                showErrorMessage(data.error || 'Failed to load post');
            }
        } catch (error) {
            console.error('Error loading post:', error);
            showErrorMessage('Error loading post: ' + error.message);
        }
    }

    // Срабатывание выбора файлов при клике на кнопки
    btnBlackAdd.addEventListener('click', () => fileInput.click());
    btnLinkAdd.addEventListener('click', () => fileInput.click());

    // Обработка выбора файлов
    fileInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        if (files.length === 0) return;

        files.forEach(file => {
            // Проверяем, что это действительно картинка
            if (file.type.startsWith('image/')) {
                uploadedFiles.push(file);
            }
        });

        // Сбрасываем значение инпута, чтобы можно было загрузить тот же файл повторно
        fileInput.value = '';

        updateSliderUI();
        validateForm();
    });

    // Функция обновления слайдера картинок
    function updateSliderUI() {
        // Если картинок нет — показываем черный плейсхолдер
        if (uploadedFiles.length === 0) {
            uploadPlaceholder.style.display = 'flex';
            createSlider.style.display = 'none';
            return;
        }

        // Скрываем плейсхолдер, показываем область слайдера
        uploadPlaceholder.style.display = 'none';
        createSlider.style.display = 'block';

        // Очищаем текущий трек слайдера
        sliderTrack.innerHTML = '';

        // Генерируем слайды с помощью FileReader (Base64-превью)
        uploadedFiles.forEach((file) => {
            const slide = document.createElement('div');
            slide.classList.add('create-slider__slide');

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file); // Более производительно, чем FileReader
            
            // Освобождаем память после загрузки картинки на экран
            img.onload = () => URL.revokeObjectURL(img.src);

            slide.appendChild(img);
            sliderTrack.appendChild(slide);
        });

        // Корректируем текущий индекс, если он вышел за рамки
        if (currentSlideIndex >= uploadedFiles.length) {
            currentSlideIndex = uploadedFiles.length - 1;
        } else if (currentSlideIndex < 0) {
            currentSlideIndex = 0;
        }

        // Обновляем счетчики
        totalSlidesCtx.textContent = uploadedFiles.length;
        currentSlideCtx.textContent = currentSlideIndex + 1;

        // Двигаем слайдер на нужную позицию
        goToSlide(currentSlideIndex);

        // Управляем видимостью стрелок (если картинка одна — скрываем стрелки)
        if (uploadedFiles.length <= 1) {
            slidePrev.style.display = 'none';
            slideNext.style.display = 'none';
        } else {
            slidePrev.style.display = 'flex';
            slideNext.style.display = 'flex';
        }
    }

    // Переключение слайдов
    function goToSlide(index) {
        sliderTrack.style.transform = `translateX(-${index * 100}%)`;
    }

    slidePrev.addEventListener('click', () => {
        if (uploadedFiles.length <= 1) return;
        currentSlideIndex = (currentSlideIndex === 0) ? uploadedFiles.length - 1 : currentSlideIndex - 1;
        currentSlideCtx.textContent = currentSlideIndex + 1;
        goToSlide(currentSlideIndex);
    });

    slideNext.addEventListener('click', () => {
        if (uploadedFiles.length <= 1) return;
        currentSlideIndex = (currentSlideIndex === uploadedFiles.length - 1) ? 0 : currentSlideIndex + 1;
        currentSlideCtx.textContent = currentSlideIndex + 1;
        goToSlide(currentSlideIndex);
    });

    // Валидация формы
    function validateForm() {
        const hasText = postDescription.value.trim().length > 0;
        const hasImages = uploadedFiles.length > 0;

        // For create mode: require both text and images
        // For edit mode: require only text (images are optional)
        if (isEditing) {
            if (hasText) {
                btnShare.disabled = false;
            } else {
                btnShare.disabled = true;
            }
        } else {
            if (hasText && hasImages) {
                btnShare.disabled = false;
            } else {
                btnShare.disabled = true;
            }
        }
    }

    // Слушаем ввод текста для постоянной валидации
    postDescription.addEventListener('input', validateForm);

    // Функция отправки поста на сервер
    async function savePostToServer() {
        try {
            // Показываем индикатор загрузки
            btnShare.disabled = true;
            const originalButtonText = btnShare.textContent;
            btnShare.textContent = 'Сохраняем...';

            // Создаем FormData для отправки файлов и данных
            const formData = new FormData();

            // Добавляем данные поста
            const postData = {
                user_id: userId.value,
                description: postDescription.value.trim(),
            };

            if (isEditing && postId.value) {
                postData.post_id = postId.value;
                formData.append('data', JSON.stringify(postData));
                
                // Добавляем новое изображение если оно было загружено (необязательно для edit)
                if (uploadedFiles.length > 0 && uploadedFiles[0].size > 0) {
                    // Проверяем, это новый файл или существующий (по размеру)
                    if (uploadedFiles[0].size !== undefined) {
                        formData.append('post_image', uploadedFiles[0]);
                    }
                }
                
                // Отправляем запрос на сервер
                const response = await fetch('../home/api_edit.php', {
                    method: 'POST',
                    body: formData
                });

                const responseData = await response.json();

                if (response.ok && responseData.success) {
                    // Успешное сохранение поста
                    hideForm();
                    showSuccessMessage();
                } else {
                    // Ошибка при сохранении
                    const errorText = responseData.error || 'Произошла неизвестная ошибка';
                    showErrorMessage(errorText);
                    btnShare.disabled = false;
                    btnShare.textContent = originalButtonText;
                }
            } else {
                // Create mode
                formData.append('data', JSON.stringify(postData));

                // Добавляем первое изображение (API ожидает post_image)
                if (uploadedFiles.length > 0) {
                    formData.append('post_image', uploadedFiles[0]);
                }

                // Отправляем запрос на сервер
                const response = await fetch('../home/api.php', {
                    method: 'POST',
                    body: formData
                });

                const responseData = await response.json();

                if (response.ok && responseData.success) {
                    // Успешное сохранение поста
                    hideForm();
                    showSuccessMessage();
                } else {
                    // Ошибка при сохранении
                    const errorText = responseData.error || 'Произошла неизвестная ошибка';
                    showErrorMessage(errorText);
                    btnShare.disabled = false;
                    btnShare.textContent = originalButtonText;
                }
            }
        } catch (error) {
            // Ошибка при отправке запроса
            console.error('Ошибка при отправке поста:', error);
            showErrorMessage('Ошибка соединения: ' + error.message);
            btnShare.disabled = false;
            btnShare.textContent = isEditing ? 'Сохранить' : 'Поделиться';
        }
    }

    // Функция скрытия формы
    function hideForm() {
        formContainer.style.display = 'none';
    }

    // Функция отображения сообщения об успехе
    function showSuccessMessage() {
        successMessage.style.display = 'block';
        errorMessage.style.display = 'none';
    }

    // Функция отображения сообщения об ошибке
    function showErrorMessage(message) {
        errorMessage.textContent = '✗ Ошибка: ' + message;
        errorMessage.style.display = 'block';
        successMessage.style.display = 'none';
    }


    btnShare.addEventListener('click', savePostToServer);
});