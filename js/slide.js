var slide = document.getElementById("slide");
var i = 1;

setInterval(() => {
    if (i > 5) 
        i = 1;
    slide.src = "images/slides/" + i + ".png";
    i++;
}, 2000);