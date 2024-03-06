function payTypeSelect(select) {
    let input = document.getElementById('due_date_input')
    if(select.value == 'cheque') {
        input.style.display = 'block';        
    } else {
        input.style.display = 'none';        
    }
}

$(document).ready(function () {
    $('input.amount').on('keyup', function(event) {
        if(event.which >= 37 && event.which <= 40) return;
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
});

const amountInput = document.getElementById('amount');
function amountChange(value) {
    const amountWithoutCommas = value.replace(/,/g, '');
    const amountAsInteger = parseInt(amountWithoutCommas, 10);
    if(isNaN(amountAsInteger)) {
        amountInput.value = '0';
    } else {
        amountInput.value = amountAsInteger;
    }
}