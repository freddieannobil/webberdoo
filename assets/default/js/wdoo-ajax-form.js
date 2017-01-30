/*******************************************************
*
*  doo-wp-ajax-form.js relies on $ and makes it easy 
*  to add ajax functionality.
*
*  Freddie Annobil @ DooWebDev.com ----===
* 
* ****************************************************/

$('form.ajax').on('submit', function(){

	var form = $(this), 
		url  = form.attr('action'),
		type = form.attr('method'),
		data = {};

	form.find('[name]').each(function(index, value){
		var form  = $(this), 
		    name  = form.attr('name'),
		    value = form.val();

		data[name] = value;
	});
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('[name="_token"]').val()
		}
	});

	$.ajax({
		beforeSend: function(){
		   $('#ajax_response').html(spinner)
		},
		url: url,
		type: type,
		data: data,
		dataType: 'json',
		success: function(response){
          //  console.log(response.auth_response);
			if(response.auth_response =='error'){
				$('#ajax_response').html('Credentials not valid ');
			}
			if(response.auth_response =='success'){
                console.log('success');
				//toastr.success('You are now logged In!');
			//	window.location.href = site_url;
				$("#myModal").animate({ opacity: 0, backgroundColor: '#000' }, function() {
				//	toastr.success('You are now logged In!');
					window.location.href = site_url;
				})
			}
			if(response.auth_response =='like_success'){
				$('#ajax_response').html(response);
			}
		}

	});
	return false;

});
