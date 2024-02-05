$(function(e){

    //________ Data Table
	$('#superrole-list').DataTable( {
        order: [[2, 'asc']],
        rowGroup: {
            dataSrc: [2]
        },
        columnDefs: [ 
			{ orderable: false, targets: [0] } ,
			{targets: [ 2],
			visible: false,}
		],
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			
		}
    } );

	//________ Select2
	$('.select2').select2({
		minimumResultsForSearch: Infinity
	});


	
});


function addPermission(event, parent) {
    event.preventDefault(); // Prevent the default behavior

    var permissionIdsInput = document.getElementById('permission_ids');
    var permissionId = parent.dataset.id;

    if (parent.dataset.statue == '0') {
        parent.dataset.statue = 1;
        var span = parent.getElementsByTagName('span');
        for (var i = 0; i < span.length; i++) {
            span[i].className = 'feather feather-check text-success icon-style-circle bg-success-transparent';
        }
        // Add the permission ID to the hidden input value
        permissionIdsInput.value += permissionId + ',';
    } else {
        parent.dataset.statue = 0;
        var span = parent.getElementsByTagName('span');
        for (var i = 0; i < span.length; i++) {
            span[i].className = 'feather feather-x text-danger icon-style-circle bg-danger-transparent';
        }
        // Remove the permission ID from the hidden input value
        permissionIdsInput.value = permissionIdsInput.value.replace(permissionId + ',', '');
    }
}