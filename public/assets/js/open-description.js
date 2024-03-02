function openDescriptionModal(id, model) {
    $.ajax({
        url: '/admin/' + model + '/' + id + '/description',
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