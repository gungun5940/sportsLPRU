// Utility
if ( typeof Object.create !== 'function' ) {
	Object.create = function( obj ) {
		function F() {};
		F.prototype = obj;
		return new F();
	};
}

(function( $ ) {

	var URL = window.location.origin + '/sportsLPRU/';

	$.fn.sweetalert = function( result ){
		if( result.alert === false ){
			return false;
		}

		if( result.status != 200 ){
			Swal.fire({
				icon: result.type,
				title: result.title,
				text: result.text
			});
		}
		else{
			Swal.fire({
				icon: result.type,
				title: result.title,
				text: result.text,
				showConfirmButton: false,
				timer: result.timer || 1500
			});
		}
	};

	$.fn.sweetConfirm = function( res, ops={} ){
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: ops.btnconfirm || 'btn btn-primary m-1',
				cancelButton: ops.btncancel || 'btn btn-secondary m-1'
			},
			buttonsStyling: false
		})

		if( ops.return ){
			res.return = ops.return;
		}

		swalWithBootstrapButtons.fire({
			title: ops.title,
			text: ops.text,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: ops.textconfirm || "ยืนยัน",
			cancelButtonText: ops.textcancel || "ยกเลิก",
			// reverseButtons: true
		}).then((result) => {
			if (result.value) {

				$.fn.confirmData( res );

			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
				) {
				swalWithBootstrapButtons.fire({
					title:'ยกเลิกการดำเนินการ',
					icon:'error',
					showConfirmButton: false,
					timer: result.timer || 1500
				})
			}
		})
	};

	$.fn.showError = function( error ){
		$.each( error, function(field, message) {
			$.fn.showErrorMsg( field, message );
		});
	};

	$.fn.showErrorMsg = function( field,msg ){
		var input = $('form.form-submit').find('[name='+field+']');
		var div = input.closest("div")
		input.addClass('is-invalid');
		div.find('.invalid-feedback').text( msg );
	};

	$.fn.formData = function(form) {
		return form.serializeArray();
	};

	$.fn.inlineSubmit = function($form, formData, dataType) {
		var self = this;
		var dataType = dataType || 'json';

		if( !formData ){
			var formData = new FormData();

			$.each( $.fn.formData($form), function (index, field) {
				formData.append(field.name, field.value);
			});

			$.each( $form.find('input[type=file]'), function (index, field) {
				var files = $(this)[0].files;
				if( files.length>0 ){
					$.each( $(this)[0].files, function(i, file) {
						formData.append(field.name, file);
					});
				}
			});
		}

		$.ajax({
			url: $form.attr('action'),
			type: 'POST',
			data: formData,
			dataType: dataType,
			processData: false, // Don't process the files
        	contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        	success : function( res ) {
        		$.fn.processForm( res );
        	},
        	error : function() {
        		$.fn.sweetalert( {type:"error", title:"เกิดข้อผิดพลาด...", "timer":2000} );
        	}
        });
		// .fail(function() {
		// 	$.fn.sweetalert( {type:"error", title:"เกิดข้อผิดพลาด...", "timer":2000} );
		// })
		// .always(function( result ) {
		// 	$.fn.processForm( result );
		// });
	};

	$.fn.processForm = function( res ){
		if( !res.error ){
			$.fn.sweetalert( res );
			if( res.status != 200 ){
				return false;
			}

			res.timer = res.timer || 1500;
			res.timer += 100;

			if( res.url == 'refresh' ){
				res.url = window.location.href;
			}

			if( res.url != "" && res.url != undefined ){
				setTimeout(function(){
					window.location = res.url;
				}, res.timer);
			}

			// Clear Modal And Hide After Success //
			$(".modal").modal('hide');
			$.fn.clearModal();
		}
		else{
			res.alert = res.alert || false;
			$.fn.showError( res.error );
			$.fn.sweetalert( res );
			$('.btn-submit').effect("shake",{distance:10,times:3});
		}
	};

	$.fn.confirmData = function( result, dataType ){
		var dataType = dataType || 'json';

		$.ajax({
			url: result.attr('href'),
			type: 'GET',
			dataType: dataType,
			processData: false, // Don't process the files
        	contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        	success : function( res ) {
        		$.fn.processForm( res );
        	},
        	error : function() {
        		$.fn.sweetalert( {type:"error", title:"เกิดข้อผิดพลาด...", "timer":2000} );
        	}
        });
	};

	$.fn.readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#js-img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    };

    $.fn.onUpdate = function( select ){
    	var id = select.data('id');
    	var status = select.val();
    	$.ajax({
    		url: select.data('url'),
    		type: 'POST',
    		dataType : 'json',
    		data : {id: id, status: status},
        	success : function( res ) {
        		$.fn.processForm( res );
        	},
        	error : function() {
        		$.fn.sweetalert( {type:"error", title:"เกิดข้อผิดพลาด...", "timer":2000} );
        	}
    	});
	};
	
	$.fn.setModal = function( res ){
		var modal = $(".modal");

		if( !res.attr('href') ){
			$.fn.sweetalert( {type:"error", title:"เกิดข้อผิดพลาด...", text:"กรุณาระบุ a.href สำหรับโหลดข้อมูล", "timer":2000} );
			return false;
		}

		$.get( res.attr('href'), function( result ) {

			if( !result.bgClose ){
				modal.modal({backdrop: 'static', keyboard: false});
			}

			var setCenter = result.center || "true";

			var $elem = $(result.form || '<div>').addClass("modal-content").addClass( result.addClass ).addClass( result.style ? 'style-'+result.style: '' );

			if( result.hiddenInput ){
				$.each( result.hiddenInput, function(i, input) {
					var hiddenInput = $.fn.setHiddenInput( input );
					$elem.append( hiddenInput );
				});
			}

			if( result.title || result.headClose ){
				$elem.append( $('<div>', {class:"modal-header"}) );
			}
			if( result.title ){
				$elem.find('.modal-header').append(
					$('<h5>', {class:'modal-title'}).html( result.title )
				);
			}
			if( result.headClose ){
				$elem.find('.modal-header').append( 
					$('<button>', {class:'close', 'data-dismiss':'modal', 'aria-label':'Exit'}).append( 
						$('<span>', {'aria-hidden':'true'}).html('&times;') 
					)
				);
			}
			if( result.body ){
				$elem.append( $('<div>', {class:"modal-body"}).html( result.body ) );
			}
			if( result.btnclose || result.btnsubmit ){
				$elem.append( $('<div>', {class:"modal-footer clearfix"}) );
				if( result.btnclose ){
					$elem.find('.modal-footer').append( result.btnclose );
				}
				if( result.btnsubmit ){
					$elem.find('.modal-footer').append( result.btnsubmit );
				}
			}
			if( setCenter == "true" ){
				modal.find('.modal-dialog').addClass('modal-dialog-centered')
			}

			modal.find('.modal-dialog').empty(); //Clear Old Modal
			modal.find('.modal-dialog').addClass( result.dialogClass ).append( $elem );
			modal.modal('show');
		}, 'json');
	};

	$.fn.setHiddenInput = function( input ){
		return $('<input>', {type:"hidden", "name":input.name, "value":input.value});
	};

	$.fn.clearModal = function(){
		var modal = $('.modal');
		setTimeout(function(){
			modal.find(".modal-dialog").empty();
		}, 400);
	};

})( jQuery );

//Event//
$('body').delegate('form.form-submit','submit',function(e){
	var $form = $(this);
	e.preventDefault();
	$.fn.inlineSubmit( $form );
});

$("form.form-submit").find("input, textarea, checkbox, select, radio").change(function(){
	var input = $(this);
	var div = input.closest("div");
	input.removeClass('is-invalid');
	div.find('.invalid-feedback').empty();
});

$('body').delegate('a.btn-confirm', 'click', function(e) {
	$.fn.sweetConfirm( $(this), $(this).data('options') );
	return false;
});

$(".js-img").change(function(){
	$.fn.readURL( $(this)[0] );
});

$(".js-select").change(function(){
	$.fn.onUpdate( $(this) );
});

$("a[data-plugins=modal]").click(function(){
	$.fn.setModal( $(this) );
	return false;
});

$("body").delegate('[data-dismiss=modal]', 'click', function(event) {
	var modal = $(".modal");
	$.fn.clearModal();
});