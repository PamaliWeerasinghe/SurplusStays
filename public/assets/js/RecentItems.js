const slider = document.querySelector('.slider ul');
const nextBtn = document.querySelector('.next_btn');
const backBtn = document.querySelector('.back_btn');
let currentIndex = 0;

nextBtn.addEventListener('click', () => {
    const itemWidth = document.querySelector('.slider ul li').offsetWidth;
    const visibleItems = Math.floor(slider.parentElement.offsetWidth / itemWidth);
    const maxIndex = slider.children.length - visibleItems;

    if (currentIndex < maxIndex) {
        currentIndex++;
        updateSliderPosition(itemWidth);
    }
});

backBtn.addEventListener('click', () => {
    const itemWidth = document.querySelector('.slider ul li').offsetWidth;

    if (currentIndex > 0) {
        currentIndex--;
        updateSliderPosition(itemWidth);
    }
});

function updateSliderPosition(itemWidth) {
    slider.style.transform = `translateX(-${itemWidth * currentIndex}px)`;
}

// Initial setup to handle window resize events
window.addEventListener('resize', () => {
    const itemWidth = document.querySelector('.slider ul li').offsetWidth;
    const visibleItems = Math.floor(slider.parentElement.offsetWidth / itemWidth);
    const maxIndex = slider.children.length - visibleItems;

    if (currentIndex > maxIndex) {
        currentIndex = maxIndex;
    }
    
    updateSliderPosition(itemWidth);
});

const itemWidth = document.querySelector('.slider ul li').offsetWidth;
updateSliderPosition(itemWidth);
