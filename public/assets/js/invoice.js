function openDescriptionModal(id) {
    $.ajax({
        url: '/admin/invoices/' + id + '/description',
        type: "GET",
        data: {
            _token: csrfToken,
        },
        success : function(result){
            description = result;            
            document.getElementById('description_body').innerHTML = description;
        }
    });
}

function fillPaymentVariables(id, amount) {
    document.getElementById('invoice_id').value = id;
    document.getElementById('amount_maximum').innerHTML = 'حداکثر مبلغ قابل پرداخت: ' + amount + ' تومان';
}

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


const paymentTds = document.querySelectorAll('div.finished-progress-bar');

paymentTds.forEach(div => {
    const paymentValues = div.innerHTML;
    const payments = paymentValues.split(', ').map(value => parseInt(value.trim()));

    div.innerHTML = '';

    const paymentSumPercentage = (payments[0] / payments[1]) * 100;
    const roundedPaymentSumPercentage = Math.round(paymentSumPercentage);

    if (roundedPaymentSumPercentage <= 100) {
        div.style.width = roundedPaymentSumPercentage + '%';
    } else {
        div.style.width = '100%';
    }
});