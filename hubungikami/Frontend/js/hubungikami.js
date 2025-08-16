// Scroll Driven Animation for Footer
const footer = document.querySelector('.footer-section');

window.addEventListener('scroll', () => {
    const footerTop = footer.getBoundingClientRect().top;
    const footerBottom = footer.getBoundingClientRect().bottom;

    if (footerTop < window.innerHeight && footerBottom > 0) {
    footer.style.animation = 'fadeIn 1s ease forwards';
    } else {
    footer.style.animation = 'none';
    }
});