document.addEventListener("DOMContentLoaded", function () {
    console.log("Main JS Loaded!");

    const buttons = document.querySelectorAll("button, .btn, .btn-outline");

    buttons.forEach(btn => {
        btn.addEventListener("mousedown", () => {
            btn.style.transform = "scale(0.92)";
            btn.style.transition = "transform 0.1s";
        });

        btn.addEventListener("mouseup", () => {
            btn.style.transform = "scale(1)";
        });

        btn.addEventListener("mouseleave", () => {
            btn.style.transform = "scale(1)";
        });
    });

    buttons.forEach(btn => {
        btn.addEventListener("mouseenter", () => {
            btn.style.boxShadow = "0 0 10px rgba(0,0,0,0.2)";
        });

        btn.addEventListener("mouseleave", () => {
            btn.style.boxShadow = "none";
        });
    });

    buttons.forEach(btn => {
        btn.addEventListener("click", function (e) {
            let ripple = document.createElement("span");
            ripple.classList.add("ripple");

            let x = e.clientX - btn.getBoundingClientRect().left;
            let y = e.clientY - btn.getBoundingClientRect().top;

            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;

            btn.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

});
