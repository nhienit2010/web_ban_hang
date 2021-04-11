let timer = 2000;
let slider = document.getElementById("slider");
let scrollStep = 700;
let count = 0;
let step = 1;

window.setInterval(() => {
    if (count === 4 || count < 0) {
        scrollStep *= -1;
        step *= -1;
    } 
    count += step;
    slider.scrollLeft += scrollStep;
}, timer);