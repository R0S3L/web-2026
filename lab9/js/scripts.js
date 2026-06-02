function initSlider(sliderEl) {
    const track   = sliderEl.querySelector('.slider__track');
    const btnPrev = sliderEl.querySelector('.slider__btn--prev');
    const btnNext = sliderEl.querySelector('.slider__btn--next');
    const current = sliderEl.querySelector('.slider__current');
 
    if (!track || !btnPrev || !btnNext) return;
 
    const total = parseInt(sliderEl.querySelector('.slider__total').textContent, 10);
    let idx = 0;
 
    function go(n) {
        idx = ((n % total) + total) % total;
        track.style.transform = `translateX(-${idx * 100}%)`;
        current.textContent = idx + 1;
    }
 
    btnPrev.addEventListener('click', () => go(idx - 1));
    btnNext.addEventListener('click', () => go(idx + 1));
}
 
document.querySelectorAll('.slider').forEach(initSlider);

function initSlider(sliderEl) {
    const track   = sliderEl.querySelector('.slider__track');
    const btnPrev = sliderEl.querySelector('.slider__btn--prev');
    const btnNext = sliderEl.querySelector('.slider__btn--next');
    const current = sliderEl.querySelector('.slider__current');
 
    if (!track || !btnPrev || !btnNext) return;
 
    const total = parseInt(sliderEl.querySelector('.slider__total').textContent, 10);
    let idx = 0;
 
    function go(n) {
        idx = ((n % total) + total) % total;
        track.style.transform = `translateX(-${idx * 100}%)`;
        if (current) current.textContent = idx + 1;
    }
 
    btnPrev.addEventListener('click', (e) => {
        e.stopPropagation();
        go(idx - 1);
    });
    btnNext.addEventListener('click', (e) => {
        e.stopPropagation();
        go(idx + 1);
    });
}

document.querySelectorAll('.slider:not(#modalSlider)').forEach(initSlider);



const modal = document.getElementById('imageModal');
const modalTrack = document.getElementById('modalTrack');
const modalCloseBtn = modal.querySelector('.modal__close');
const modalSlider = document.getElementById('modalSlider');


function handleEscKey(event) {
    if (event.key === 'Escape' || event.keyCode === 27) {
        closeModal();
    }
}

function openModal(postSliderEl) {
    const originalImages = postSliderEl.querySelectorAll('.photo_post');
    
    modalTrack.innerHTML = '';
    
    originalImages.forEach(img => {
        const slide = document.createElement('div');
        slide.classList.add('slider__slide');
        
        const newImg = document.createElement('img');
        newImg.classList.add('photo_post');
        newImg.src = img.src;
        newImg.alt = img.alt;
        
        slide.appendChild(newImg);
        modalTrack.appendChild(slide);
    });
    
    const totalCount = originalImages.length;
    modalSlider.querySelector('.slider__total').textContent = totalCount;
    modalSlider.querySelector('.slider__current').textContent = 1;
    
    const prevBtn = modalSlider.querySelector('.slider__btn--prev');
    const nextBtn = modalSlider.querySelector('.slider__btn--next');
    const counter = modalSlider.querySelector('.slider__counter');
    
    if (totalCount <= 1) {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        if (counter) counter.style.display = 'none';
    } else {
        prevBtn.style.display = 'flex';
        nextBtn.style.display = 'flex';
        if (counter) counter.style.display = 'block';
    }
    
    initSlider(modalSlider);
    
    modal.classList.add('is-open');
    
    document.addEventListener('keydown', handleEscKey);
}

function closeModal() {
    modal.classList.remove('is-open');

    modalTrack.style.transform = 'translateX(0)';

    document.removeEventListener('keydown', handleEscKey);
}

document.querySelectorAll('.slider:not(#modalSlider)').forEach(slider => {
    slider.style.cursor = 'pointer'; 
    slider.addEventListener('click', () => {
        openModal(slider);
    });
});

modalCloseBtn.addEventListener('click', closeModal);

function initReadMore() {
    const containers = document.querySelectorAll('.post-text-container');
    
    containers.forEach(container => {
        const textEl = container.querySelector('.post-text');
        const btn = container.querySelector('.read-more-btn');
        
        if (!textEl || !btn) return;
        
        container.classList.remove('is-clamped');
        const fullHeight = textEl.scrollHeight;
        container.classList.add('is-clamped');
        
        const lineHeight = parseFloat(getComputedStyle(textEl).lineHeight);
        const maxHeight = lineHeight * 2; 
        
        if (fullHeight > maxHeight + 2) { 
            btn.style.display = 'inline-block';
            
            btn.onclick = function(e) {
                e.stopPropagation();
                
                if (container.classList.contains('is-clamped')) {
                    container.classList.remove('is-clamped');
                    this.textContent = 'Свернуть';
                } else {
                    container.classList.add('is-clamped');
                    this.textContent = 'ещё';
                }
            };
        } else {
            btn.style.display = 'none';
        }
    });
}

initReadMore();