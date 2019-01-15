window.addEventListener('DOMContentLoaded', () => {
    const circles = document.getElementsByClassName("clickableCircleBtn");
    const hdnExcite = document.getElementById("hdnExcite");
    const hdnRelax = document.getElementById("hdnRelax");
    const hdnFear = document.getElementById("hdnFear");
    const hdnSad = document.getElementById("hdnSad");
    const hdnAnger = document.getElementById("hdnAnger");

    for (const circle of circles) {
        circle.addEventListener('click', () => {
            circle.value = circle.value % 5 + 1;
            circle.style.width = 20 + circle.value * 15 + 'px';
            circle.style.height = 20 + circle.value * 15 + 'px';
            switch (circle.id) {
                case "circleBtnExcite":
                    hdnExcite.value = circle.value;
                    break;
                case "circleBtnRelax":
                    hdnRelax.value = circle.value;
                    break;
                case "circleBtnFear":
                    hdnFear.value = circle.value;
                    break;
                case "circleBtnSad":
                    hdnSad.value = circle.value;
                    break;
                case "circleBtnAnger":
                    hdnAnger.value = circle.value;
                    break;
                default:
                    break;
            }
        });
    }
});
