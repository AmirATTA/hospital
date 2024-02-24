const selectAllCheckbox = document.getElementById('select_all');
selectAllCheckbox.addEventListener('change', function() {
    var checkboxes = document.querySelectorAll('.checkbox');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = selectAllCheckbox.checked;
    });
});

var checkboxes = document.querySelectorAll('.checkbox');
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var allChecked = true;
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                allChecked = false;
            }
        });
        selectAllCheckbox.checked = allChecked;
    });
});