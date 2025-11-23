/* Fade-in animation for musician cards */
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".musician-card");

    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add("visible");
        }, index * 120); // stagger animation
    });
});

/* Background subtle pulsation on scroll */
let scrollPos = 0;
window.addEventListener("scroll", () => {
    const bg = document.querySelector(".background");
    scrollPos = window.scrollY;

    const shift = scrollPos * 0.05;
    bg.style.transform = `scale(1.05) translateY(${shift}px)`;
});
