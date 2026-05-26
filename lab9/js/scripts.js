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