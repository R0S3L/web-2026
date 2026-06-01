document.addEventListener('DOMContentLoaded', () => {
    // Элементы интерфейса
    const fileInput = document.getElementById('fileInput');
    const btnBlackAdd = document.getElementById('btnBlackAdd');
    const btnLinkAdd = document.getElementById('btnLinkAdd');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const createSlider = document.getElementById('createSlider');
    const sliderTrack = document.getElementById('sliderTrack');
    const btnShare = document.getElementById('btnShare');
    const postDescription = document.getElementById('postDescription');
    
    const slidePrev = document.getElementById('slidePrev');
    const slideNext = document.getElementById('slideNext');
    const currentSlideCtx = document.getElementById('currentSlide');
    const totalSlidesCtx = document.getElementById('totalSlides');

    // Массив для хранения загруженных файлов (объектов File)
    let uploadedFiles = [];
    let currentSlideIndex = 0;

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

    // Валидация формы: кнопка активна, только если есть и фото, и текст
    function validateForm() {
        const hasText = postDescription.value.trim().length > 0;
        const hasImages = uploadedFiles.length > 0;

        if (hasText && hasImages) {
            btnShare.disabled = false;
        } else {
            btnShare.disabled = true;
        }
    }

    // Слушаем ввод текста для постоянной валидации
    postDescription.addEventListener('input', validateForm);

    // Клик на кнопку «Поделиться»
    btnShare.addEventListener('click', () => {
        // Формируем объект с информацией о новом посте
        const postData = {
            description: postDescription.value.trim(),
            imagesCount: uploadedFiles.length,
            images: uploadedFiles.map(file => ({
                name: file.name,
                size: `${(file.size / 1024).toFixed(2)} KB`,
                type: file.type
            }))
        };

        // Выводим в консоль по ТЗ для последующей отправки в лабораторной 9.2.1
        console.log('--- Информация о новом посте ---');
        console.log(postData);
        alert('Информация о посте успешно выведена в консоль!');
    });
});