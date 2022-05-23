jQuery(document).ready(function($) {
	//console.log(ajax_object);
	neonSort();
	function neonSort(){
		$( "table#neonSortable tbody" ).sortable({
			containment: "parent",
			handle: ".neonAddonSort"
		});

		$( "#neonSortable" ).on( "sortstop", function( event, ui ) {

			var product_id = ui.item.attr('data-product-id');
			var beforeAddon = ui.item.prev().attr('data-id');
			var currentAddon = ui.item.attr('data-id');
			console.log('before: ' + beforeAddon + ' - after: ' + currentAddon + ' -product-id : ' + product_id );

			$.ajax({
		        url : ajax_object.ajax_url,
		        data : {
		            action : 'neon_data_sort',
		            product_id : product_id,
		            currentAddon : currentAddon,
		            moveAddon : beforeAddon
		        },
		        method : 'POST',
		        success : function( response ){ 
		        	//console.log(response) 
		        },
		        error : function(error){
		         	//console.log(error) 
		     	}
		    });

		});
	}
	

	

	$("body").on("change","#addonFieldType",function(){
		var type = $(this).val();
		if(type == 'text' || type == 'textarea' ) {
			$('.neonPanelOption').hide();
			$('.form-field-extra').hide();
			$('.form-placeholder').show();
		}else if(type == 'checkbox') {
			$('.form-field-extra').show();
			$('.neonPanelOption').hide();
			$('.form-placeholder').hide();
		}else if(type == 'radio-img'){
			$('.form-field-extra').hide();
			$('.option-image').show();
			$('.neonPanelOption').show();
			$('.form-placeholder').hide();
		}else{
			$('.form-field-extra').hide();
			$('.option-image').hide();
			$('.neonPanelOption').show();
			$('.form-placeholder').hide();
		}
	});

	$("body").on("click",".btnAdd",function(){ 
        var html = $("#option-html").html();
        $(".neonOptionGroup").append(html);

    });

	jQuery( 'body' ).on( 'thickbox:removed', function() {
		//location.reload();
		var product_id = jQuery('#product_id').val();
		
		$.ajax({
		        url : ajax_object.ajax_url,
		        data : {
		            action : 'neon_panel_update',
		            product_id : product_id,
		        },
		        method : 'POST',
		        success : function( response ){
		        	jQuery("#panelData").html( response );
		        	neonSort();
		        	//console.log(response) 
		        },
		        error : function(error){
		        	console.log(error) 
		     	}
		    });
	});

	//form validation
	$(document).on('submit','form.neon-form',function(){
		var value = $("input[name='addon_name']").val();
		var error = "Name must contain only letters and underscores with no spaces!";
		//var valid = true;
		if (value === '') {
            return false;
        }
        // Check the name strength
        if (value.trim().length < 3) {
        	$('.name-error').html("Please enter atleast 3 letters!");
            return false;
        }

        // Check the name strength
        if ( value.trim().indexOf(" ") > 0 && value != "" ) {
        	$('.name-error').html(error);
            return false;
        }
 
        if (/^[a-zA-Z_]*$/.test(value)) {
        setTimeout(function(){ javascript:parent.eval('tb_remove()');
        }, 500);
			return true;
		} else {
			$('.name-error').html(error);
			return false;
		};

		setTimeout(function(){ javascript:parent.eval('tb_remove()');
        }, 500);
		return true;
	});

	//on form submit close thickbox & update data
	// $("body").on("click",".neonFormSave",function(){ 
 	//    javascript:parent.eval('tb_remove()');
	// });

	$("body").on("click",".btnRemove",function(){ 
		var len = $(this).parents(".neonOptionGroup").children().length;
	  	if(len > 1 ){
	  		$(this).parents(".neon-option-field").remove();
	  	}
	});

	$("body").on("click",".btnAddonRemove",function() {
		var product_id = $(this).attr('data-product-id');
		var addon_key = $(this).attr('data-id');
		var r = confirm("Are you sure you want to delete this addon?");
		if (r == true) {
			$.ajax({
		        url : ajax_object.ajax_url,
		        data : {
		            action : 'neon_addon_remove',
		            product_id : product_id,
		            addonKey : addon_key,
		        },
		        method : 'POST',
		        success : function( response ){ 
		        	jQuery("#panelData").html( response );
		        	neonSort();
		        },
		        error : function(error){
		        	//console.log(error) 
		     	}
	    	});
		}
		
	});
	

	//toggle show hide neon tab 
	$('#_neon_product').on('change', function() {
		if( $(this).is(':checked') ) {
			$('.neon_options').removeClass('hide_if_neon')
		}else{
			$('.neon_options').addClass('hide_if_neon')
		}
	});
	
	$("body").on('change', '.neon_option_file' , function() {
	
		var $this = $(this);
        file_data = $(this).prop('files')[0];
        form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('action', 'option_img_upload');
 
        $.ajax({
            url : ajax_object.ajax_url,
            type: 'POST',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
				$this.val('');
            	res = JSON.parse(response);
            	console.log(response);
				if(res.status == 'success'){
					$this.siblings('.neon_option_img').val(res.path);
				}
            }
        });

	});


});