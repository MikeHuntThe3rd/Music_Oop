document.addEventListener('DOMContentLoaded', function() {
    const creatorSelect = document.getElementById('creatorSelect');
    const bandSelect = document.getElementById('bandSelect');
    const finalField = document.getElementById('finalCreatorId');
    const typeField = document.getElementById('creatorType');
    const form = document.getElementById('musicForm');

    // Disable dropdowns if empty
    if (creatorSelect.options.length <= 1) creatorSelect.disabled = true;
    if (bandSelect.options.length <= 1) bandSelect.disabled = true;

    // === Function to set hidden fields ===
    function setHiddenFields() {
        if (creatorSelect.value !== "") {
            finalField.value = creatorSelect.value;
            typeField.value = "creator";
        } else if (bandSelect.value !== "") {
            finalField.value = bandSelect.value;
            typeField.value = "band";
        } else {
            finalField.value = "";
            typeField.value = "";
        }
    }

    // Run on page load to handle pre-selected values (EDIT)
    setHiddenFields();

    // Event listeners
    creatorSelect.addEventListener('change', function() {
        if (this.value !== "") {
            bandSelect.value = "";
            bandSelect.disabled = true;
        } else {
            bandSelect.disabled = (bandSelect.options.length <= 1);
        }
        setHiddenFields();
    });

    bandSelect.addEventListener('change', function() {
        if (this.value !== "") {
            creatorSelect.value = "";
            creatorSelect.disabled = true;
        } else {
            creatorSelect.disabled = (creatorSelect.options.length <= 1);
        }
        setHiddenFields();
    });

    // Form submission check
    form.addEventListener('submit', function(e) {
        setHiddenFields(); // ensure value is set before submit
        if (!finalField.value || !typeField.value) {
            alert("Please select either a creator or a band.");
            e.preventDefault();
        }
    });
});
