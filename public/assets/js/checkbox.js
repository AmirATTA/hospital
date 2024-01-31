// Get the reference to the specific checkbox
const specificCheckbox = document.getElementById('select_all');

// Get all the other checkboxes
const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#select_all)');

// Add an event listener to the specific checkbox
specificCheckbox.addEventListener('click', function () {
    // Loop through all the other checkboxes
    checkboxes.forEach(function (checkbox) {
        // Set the checked state of each checkbox to match the specific checkbox
        checkbox.checked = specificCheckbox.checked;
    });
});