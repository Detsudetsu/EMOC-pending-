window.addEventListener('DOMContentLoaded', () => {
    const circles = document.getElementsByClassName("circleBtn");
    for (const circle of circles) {
        circle.style.width = 20 + circle.value * 15 + 'px';
        circle.style.height = 20 + circle.value * 15 + 'px';
    }
});