let slideIndex = 0;

function showSlides() {
    const slides = document.getElementsByClassName("slides");
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");  
    }
    slideIndex++;
    if (slideIndex >= slides.length) { slideIndex = 0; }
    slides[slideIndex].classList.add("active");  
    setTimeout(showSlides, 2000); // Change image every 3 seconds
}

function changeSlide(n) {
    const slides = document.getElementsByClassName("slides");
    slideIndex += n;
    if (slideIndex >= slides.length) { slideIndex = 0; }
    if (slideIndex < 0) { slideIndex = slides.length - 1; }
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");  
    }
    slides[slideIndex].classList.add("active");  
}
showSlides();	
