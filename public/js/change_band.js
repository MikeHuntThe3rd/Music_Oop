document.addEventListener("DOMContentLoaded", () => {
    const birthInput = document.getElementById("birth");
    const deathInput = document.getElementById("death");

    if (birthInput && deathInput) {
        birthInput.addEventListener("change", () => {
            deathInput.min = birthInput.value || "";
        });

        deathInput.addEventListener("change", () => {
            if (birthInput.value && deathInput.value < birthInput.value) {
                alert("Death cannot be before birth!");
                deathInput.value = "";
            }
        });
    }
});
