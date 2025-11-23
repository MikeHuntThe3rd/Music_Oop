document.addEventListener("DOMContentLoaded", () => {
    const birthInput = document.getElementById("birth");
    const deathInput = document.getElementById("death");

    birthInput.addEventListener("change", () => {
        if (birthInput.value) {
            deathInput.min = birthInput.value; // death cannot be before birth
        } else {
            deathInput.min = ""; // reset if birth cleared
        }
    });

    deathInput.addEventListener("change", () => {
        if (birthInput.value && deathInput.value < birthInput.value) {
            alert("Death cannot be before birth!");
            deathInput.value = ""; // clear invalid death date
        }
    });
});
