function linkInput(type, method) {
    if(method == 'new') {
        var typeCategory = document.getElementById('new_type_category');
        var typeCustom = document.getElementById('new_type_custom');
    } else {
        var typeCategory = document.getElementById('edit_type_category');
        var typeCustom = document.getElementById('edit_type_custom');
    }
    if(type.value == 'Category') {
        typeCategory.style.display = 'block';
        typeCustom.style.display = 'none';
        typeCustom.value = '';
    } else if(type.value == 'custom') {
        typeCategory.style.display = 'none';
        typeCustom.style.display = 'block';
    } else {
        typeCategory.style.display = 'none';
        typeCustom.style.display = 'none';
    }
}

const itemIdInput = document.getElementById('change_item_id');
const itemTitleInput = document.getElementById('change_item_title');
const itemLinkableTypeInput = document.getElementById('change_item_linkable_type');
const itemLinkableIdInput = document.getElementById('change_item_linkable_id');
const itemLinkInput = document.getElementById('change_item_link');
const itemNewTab1Input = document.getElementById('change_item_new_tab_1');
const itemNewTab2Input = document.getElementById('change_item_new_tab_2');
const itemStatus1Input = document.getElementById('change_item_status_1');
const itemStatus2Input = document.getElementById('change_item_status_2');

function selectOptionByValue(value) {
    var options = itemLinkableIdInput.options;
  
    for (var i = 0; i < options.length; i++) {
        if (options[i].value === value.toString()) {
            options[i].selected = true;
            break;
        }
    }
}

function menuItemEditModal(btn) {
    var inputId = btn.querySelector('.item-id');
    var inputTitle = btn.querySelector('.item-title');
    var inputLinkableType = btn.querySelector('.item-linkable-type');
    var inputLinkableId = btn.querySelector('.item-linkable-id');
    var inputLink = btn.querySelector('.item-link');
    var inputNewTab = btn.querySelector('.item-new-tab');
    var inputStatus = btn.querySelector('.item-status');

    var typeCategory = document.getElementById('edit_type_category');
    var typeCustom = document.getElementById('edit_type_custom');

    itemIdInput.value = inputId.value;
    itemTitleInput.value = inputTitle.value;
    if(inputLinkableType.value !== '') {
        typeCategory.style.display = 'block';
        typeCustom.style.display = 'none';
        itemLinkableTypeInput.options[1].selected = true;
        selectOptionByValue(inputLinkableId.value);
    } else {
        typeCategory.style.display = 'none';
        typeCustom.style.display = 'block';
        itemLinkableTypeInput.options[2].selected = true;
        itemLinkableIdInput.options[0].selected = true;
        itemLinkInput.value = inputLink.value;
    }
    if(inputNewTab.value === '1') {
        itemNewTab1Input.checked = true;
        itemNewTab2Input.checked = false;
    } else {
        itemNewTab1Input.checked = false;
        itemNewTab2Input.checked = true;
    }
    if(inputStatus.value === '1') {
        itemStatus1Input.checked = true;
        itemStatus2Input.checked = false;
    } else {
        itemStatus1Input.checked = false;
        itemStatus2Input.checked = true;
    }
}

function updateItem() {
    var data = [];
    let category = 'App\\Models\\Category';
    data.push({ 'id': itemIdInput.value });
    data.push({ 'title': itemTitleInput.value });
    data.push({ 'link': itemLinkInput.value });
    data.push({ 'linkable_type': itemLinkableTypeInput.value === 'Category' ? category : null });
    data.push({ 'linkable_id': itemLinkableIdInput.value === '' ? null : itemLinkableIdInput.value });
    data.push({ 'new_tab': itemNewTab1Input.checked ? '1' : '0' });
    data.push({ 'status': itemStatus1Input.checked ? '1' : '0' });

    if(itemTitleInput.value != '') {
        if(itemLinkableTypeInput.value == 'custom' && itemLinkInput.value == '') {
            itemLinkInput.style.border = '1px solid red';
            setTimeout(function() {
                itemLinkInput.style.border = '1px solid #d3dfea';
            }, 1500);
            return;
        }
        $.ajax({
            url: '/admin/menus/items/' + itemIdInput.value,
            type: "PATCH",
            data: {
                _token: csrfToken,
                item: data,
            },
            success : function(result){
                location.reload();
            }
        });
    } else if(itemTitleInput.value == '') {
        itemTitleInput.style.border = '1px solid red';
        setTimeout(function() {
            itemTitleInput.style.border = '1px solid #d3dfea';
        }, 1500);
    }
}
