document.querySelectorAll('.toggle-header').forEach(header => {
    header.addEventListener('click', () => {
    const parent = header.parentElement;
    parent.classList.toggle('active');
    });
});

// Scroll animation that works in both directions (down & up)
const fadeEls = document.querySelectorAll('.fade-slide-up');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
    if (entry.isIntersecting) {
        entry.target.classList.add('show');
    } else {
        entry.target.classList.remove('show');
    }
    });
}, {
    threshold: 0.2
});

fadeEls.forEach(el => observer.observe(el));

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