var csrfToken = $('meta[name="csrf-token"]').attr('content');

$(function(){
   'use strict'

	//______________
	$(".role-user").on("click", function(e){
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
				$.ajax({
					url: '/admin/users/' + buttonDataset.id,
					type: "DELETE",
					data: {
						_token: csrfToken,
					},
					success : function(result){
						if(result === true) {
							swal({
								title: "خطا",
								text: "شما نميتوانيد حساب خود را حذف كنيد.",
								icon: "error",
							});
						} else {
							const div = button.parent();;
							const parentOfDiv = div.parent();;
							const parentOfParentOfDiv = parentOfDiv.parent();;
							parentOfParentOfDiv.remove();
							
							swal({
								title: "انجام شد",
								text: "با موفقیت انجام شد!",
								icon: "success",
							});
						}
					}
				});
			}
		});
	});
});

