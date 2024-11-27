const parent = document.querySelector('.parent');
const child = document.querySelector('.child');

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
    }, 300); // Delay time in milliseconds
});
