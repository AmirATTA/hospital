const paymentTds = document.querySelectorAll('div.finished-progress-bar');

paymentTds.forEach(div => {
    const paymentValues = div.innerHTML;
    const payments = paymentValues.split(', ').map(value => parseInt(value.trim()));

    div.innerHTML = '';

    const paymentSumPercentage = (payments[0] / payments[1]) * 100;
    const roundedPaymentSumPercentage = Math.round(paymentSumPercentage);

    if (roundedPaymentSumPercentage <= 100) {
        div.style.width = roundedPaymentSumPercentage + '%';
        document.getElementById('percentage_text').innerHTML = roundedPaymentSumPercentage + '%';
    } else {
        div.style.width = '100%';
    }
});