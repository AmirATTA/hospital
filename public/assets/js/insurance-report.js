const insurances = document.querySelectorAll('.insurance-amount');

insurances.forEach(element => {
    let content = element.innerHTML;

    let values = content.split(',').map(value => parseInt(value));

    let discountedValue = values[0] / 100 * values[1];

    let formattedValue = Math.round(discountedValue).toLocaleString();

    element.innerHTML = formattedValue + ' تومان';
});

const insuranceSum = document.getElementById('insurances_sum');

const insuranceSumContent = insuranceSum.innerHTML;

const insuranceValues = insuranceSumContent.split(',').map(value => parseInt(value));

const discountedNumber = insuranceValues[0] / 100 * insuranceValues[1];

const formattedValue = Math.round(discountedNumber).toLocaleString();

insuranceSum.innerHTML = formattedValue + ' تومان';