var operationAmount = 0;
var quotaAmount = 0;

const operationSumTD = document.getElementById('operation_sum');
const quotaSumTD = document.getElementById('quota_sum');


const selectAllCheckbox = document.getElementById('select_all');
selectAllCheckbox.addEventListener('change', function() {
    var checkboxes = document.querySelectorAll('.checkbox');

    var operationSum = document.querySelectorAll('.operation-sum');
    var quotaSum = document.querySelectorAll('.quota-sum');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = selectAllCheckbox.checked;
    });
    if (selectAllCheckbox.checked) {
        operationAmount = 0;
        operationSum.forEach(function(operation) {
            operationAmount += parseInt(operation.value);
        });
        quotaAmount = 0;
        quotaSum.forEach(function(quota) {
            quotaAmount += parseInt(quota.value);
        });
    } else {
        operationAmount = 0;
        
        quotaAmount = 0;
    }
    operationSumTD.innerHTML = operationAmount.toLocaleString() + ' تومان';
    quotaSumTD.innerHTML = quotaAmount.toLocaleString() + ' تومان';
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

        let label = checkbox.nextElementSibling;
        let operation = label.nextElementSibling;
        let quota = operation.nextElementSibling;

        if (checkbox.checked) {
            operationAmount += parseInt(operation.value);
            quotaAmount += parseInt(quota.value);

            operationSumTD.innerHTML = operationAmount.toLocaleString() + ' تومان';
            quotaSumTD.innerHTML = quotaAmount.toLocaleString() + ' تومان';
        } else {
            operationAmount -= parseInt(operation.value);
            quotaAmount -= parseInt(quota.value);
            
            operationSumTD.innerHTML = operationAmount.toLocaleString() + ' تومان';
            quotaSumTD.innerHTML = quotaAmount.toLocaleString() + ' تومان';
        }
        selectAllCheckbox.checked = allChecked;
    });
});