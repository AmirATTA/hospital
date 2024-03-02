var csrfToken = $('meta[name="csrf-token"]').attr('content');

const insuranceDiv = document.getElementById('insurances');

function insuranceType(value) {
    $.ajax({
        url: '/admin/insurance-reports/names',
        type: "POST",
        data: {
            _token: csrfToken,
            data: value,
        },
        success : function(result){
            insuranceDiv.innerHTML = '';
            
            const labelOption = document.createElement('option');
            labelOption.setAttribute('label', 'انتخاب نام بیمه');
            
            insuranceDiv.appendChild(labelOption);

            result.forEach(element => {
                // Create a new <option> element
                const insuranceOption = document.createElement('option');
                insuranceOption.setAttribute('value', element.id);
                insuranceOption.textContent = element.name;

                insuranceDiv.appendChild(insuranceOption);
            });
        }
    });
}