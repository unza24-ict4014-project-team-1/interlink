
let infoHeight = document.querySelector("#info").offsetHeight;
document.querySelector(".show-after-hover").style.top = infoHeight + "px";

const parent = document.querySelector('li.relative');
const child = document.querySelector('.show-after-hover');
let timeout;
parent.addEventListener('mouseenter', () => {
    clearTimeout(timeout);
    child.style.opacity = '1';
    child.style.visibility = 'visible';
});
parent.addEventListener('mouseleave', () => {
    timeout = setTimeout(() => {
        child.style.opacity = '0';
        child.style.visibility = 'hidden';
    }, 500); // Delay time in milliseconds
});
