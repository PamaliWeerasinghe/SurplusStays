const slider_b = document.querySelector('.slider_b ul');
const nextBtn_b = document.querySelector('.item_slider_b .next_btn');
const backBtn_b = document.querySelector('.item_slider_b .back_btn');
let CurrentIndex_b = 0;

nextBtn_b.addEventListener('click', () => {
    const itemWidth = document.querySelector('.slider_b ul li').offsetWidth;
    const visibleItems = Math.floor(slider_b.parentElement.offsetWidth / itemWidth);
    const maxIndex = slider_b.children.length - visibleItems;

    if (CurrentIndex_b < maxIndex) {
        CurrentIndex_b++;
        updateBusinessSliderPosition(itemWidth);
    }
});

backBtn_b.addEventListener('click', () => {
    const itemWidth = document.querySelector('.slider_b ul li').offsetWidth;

    if (CurrentIndex_b > 0) {
        CurrentIndex_b--;
        updateBusinessSliderPosition(itemWidth);
    }
});

function updateBusinessSliderPosition(itemWidth) {
    slider_b.style.transform = `translateX(-${itemWidth * CurrentIndex_b}px)`;
}

window.addEventListener('resize', () => {
    const itemWidth = document.querySelector('.slider_b ul li').offsetWidth;
    const visibleItems = Math.floor(slider_b.parentElement.offsetWidth / itemWidth);
    const maxIndex = slider_b.children.length - visibleItems;

    if (currentIndex > maxIndex) {
        currentIndex = maxIndex;
    }
    
    updateSliderPosition(itemWidth);
});

// Initial slider position setup
const itemWidth__b = document.querySelector('.slider_b ul li').offsetWidth;
updateBusinessSliderPosition(itemWidth__b);
