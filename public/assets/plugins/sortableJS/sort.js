var csrfToken = $('meta[name="csrf-token"]').attr('content');

var el = document.getElementById('items');
var sortable = new Sortable(el, {
	onEnd: function (/**Event*/evt) {
		evt.item;  // dragged HTMLElement
		evt.to;    // target list
		evt.from;  // previous list
		evt.oldIndex;  // element's old index within old parent
		evt.newIndex;  // element's new index within new parent
        var menuItems = document.querySelectorAll('#items li');
        var childItemsArray = [];
        menuItems.forEach((item) => {
            var childItem = item.querySelector('.item_title');
            childItemsArray.push(childItem.innerHTML);
        });
        $.ajax({
            url: '/admin/menus/items/' + 1,
            type: "PUT",
            data: {
                _token: csrfToken,
                items: childItemsArray,
            }
        });
	},
});

$(function(){
    'use strict'
    //______________
    $(".role-menu-item").on("click", function(e){
        var button = $(this);
        var buttonDataset = button.data();
        swal({
            title: "ایا مطمئن هستید؟",
            text: "پس از حذف، نمی توانید این را بازیابی کنید!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                const div = button.parent();;
                const parentOfDiv = div.parent();;
                parentOfDiv.remove();
                
                var menuItems = document.querySelectorAll('#items li');
                var childItemsArray = [];
                menuItems.forEach((item) => {
                    var childItem = item.querySelector('.item_title');
                    childItemsArray.push(childItem.innerHTML);
                });
                $.ajax({
                    url: '/admin/menus/items/' + buttonDataset.id,
                    type: "DELETE",
                    data: {
                        _token: csrfToken,
                        items: childItemsArray,
                    },
                    success : function(result){
                        console.log(result);
                        swal({
                        	title: "انجام شد",
                        	text: "با موفقیت انجام شد!",
                        	icon: "success",
                        });
                    }
                });
            }
        });
    });
});