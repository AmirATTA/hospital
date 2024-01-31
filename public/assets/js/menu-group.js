const groupIdInput = document.getElementById('change_group_id');
const groupNameInput = document.getElementById('change_group_name');
const groupLabelInput = document.getElementById('change_group_label');

function menuGroupEditModal(btn) {
    var inputId = btn.querySelector('.group-id');
    var inputName = btn.querySelector('.group-name');
    var inputLabel = btn.querySelector('.group-label');

    groupIdInput.value = inputId.value;
    groupNameInput.value = inputName.value;
    groupLabelInput.value = inputLabel.value;
}

function updateGroup() {
    var data = [];
    data.push({ ['id']: groupIdInput.value });
    data.push({ ['name']: groupNameInput.value });
    data.push({ ['label']: groupLabelInput.value });

    if(groupNameInput.value != '' && groupLabelInput.value != '') {
        $.ajax({
            url: '/admin/menus/groups/' + groupIdInput.value,
            type: "PUT",
            data: {
                _token: csrfToken,
                group: data,
            },
            success : function(result){
                location.reload();
            }
        });
    } else if(groupNameInput.value == '') {
        groupNameInput.style.border = '1px solid red';
        setTimeout(function() {
            groupNameInput.style.border = '1px solid #d3dfea';
        }, 1500);
    } else {
        groupLabelInput.style.border = '1px solid red';
        setTimeout(function() {
            groupLabelInput.style.border = '1px solid #d3dfea';
        }, 1500);
    }
}