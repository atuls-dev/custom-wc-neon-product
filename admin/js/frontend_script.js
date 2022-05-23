jQuery(document).ready(function($) {
    
	$('.neon_option').on('input', function() {
		// var text = document.getElementById("neon_input_text").value.trim()
		// console.log ( getCanvasFontSize() );
		// console.log (text );
		// var width = getTextWidth(text);
		// console.log( 'text - ' + width );

		update_product_data();
	});

	$('.wc-pao-addon-field').on('input', function() {
		update_product_data();
	});

	function getTextWidth(text, font = getCanvasFontSize()) {
	    // if given, use cached canvas for better performance
	    // else, create new canvas
	    var canvas = getTextWidth.canvas || (getTextWidth.canvas = document.createElement("canvas"));
	    var context = canvas.getContext("2d");
	    context.font = font;
	    var metrics = context.measureText(text);
	    return metrics.width;
	};

	function getCssStyle(element, prop) {
    	return window.getComputedStyle(element, null).getPropertyValue(prop);
	}

	function getCanvasFontSize(el = document.getElementById("neon_preview_text")) {
		const fontWeight = getCssStyle(el, 'font-weight') || 'normal';
		const fontSize = getCssStyle(el, 'font-size') || '16px';
		const fontFamily = getCssStyle(el, 'font-family') || 'Times New Roman';

		return `${fontWeight} ${fontSize} ${fontFamily}`;
	}

	function update_product_data() {

		//text field
		var neon_input_text = document.getElementById("neon_input_text").value.trim()
		var neon_text_length = neon_input_text.length;
	
		if( neon_text_length <= 0){
			$("#neon_preview_text").text('Lorem ipsum');
			$(".action").prop('disabled', true);
		}else{
			var maxlen = parseInt( $("#neon_input_text").attr('maxlength') );
			if(neon_text_length >= maxlen ){
				$('.neon_text_error').html('Only '+maxlen+' characters allowed!');
			}else{
				$('.neon_text_error').html('');
			}

			$(".action").prop('disabled', false);
			$("#neon_preview_text").html(neon_input_text);
		}

		//font type field
		if($("input[name='font_type'").is(':checked')) { 
			//var neon_font_type = $("input[name='font_type']:checked").val();
			var neon_font_type = $("input[name='font_type']:checked").attr('data-class');
			var old_class =  $("#neon_preview_text").attr('data-class');
			$("#neon_preview_text").removeClass(old_class);

			$("#neon_preview_text").addClass(neon_font_type);
			$("#neon_preview_text").attr('data-class',neon_font_type);
		}

		//shadow color field
		if($("input[name='font_shadow'").is(':checked')) {
			var neon_font_shadow = $("input[name='font_shadow']:checked").attr('data-shadow');
			$("#neon_preview_text").css({ 
				"text-shadow": neon_font_shadow,
			});
		}

		calculateProductPrice();
	}

	function calculateProductPrice(){
		
		var price = parseInt($('#base_price').val());

		var neon_text_length = $("#neon_input_text").val().trim().length;
		if( neon_text_length > 0){
			var price_char = $("#price_per_character").val();
			if( typeof price_char != 'undefined' ) {
				if(price_char == ''){
					price_char = 0;	
				}
			}
			price_char = parseInt(price_char);
			price = price + ( neon_text_length * price_char );
		}


		$('.neonCustomAddon').each(function() {
			var inputType = this.type;
			if ( inputType == 'radio' ) {
				if( $(this).is(':checked') ){
					var rprice = $(this).attr('data-price');
					if(rprice == ''){
						rprice = 0;	
					}
					price = price + parseInt(rprice);
				}
			}else if( inputType == 'checkbox' ){
				if( $(this).is(':checked') ){
					var cprice = $(this).attr('data-price');
					if(cprice == ''){
						cprice = 0;	
					}
					price = price + parseInt(cprice);
				}
			}else if( inputType == 'select-one' ) {
				var sprice =  $(this).find('option:selected').attr('data-price');
				if(sprice == ''){
					sprice = 0;	
				}
				price = price + parseInt(sprice);
			}
		});


		var cut = $("input[name='cut']:checked").attr('data-price');
		if( typeof cut != 'undefined' ) {
			if(cut == ''){
				cut = 0;	
			}
			price = price + parseInt(cut);
		}

		var support = $("input[name='support']:checked").attr('data-price');
		if( typeof support != 'undefined' ) {
			if(support == ''){
				support = 0;	
			}
			//console.log("support-" + support);
			price = price + parseInt(support);
		}

		var ex_size = $("input[name='addon-11722-size-0[]']:checked").attr('data-price');
		//console.log("size"+ ex_size);
		if( typeof ex_size != 'undefined' ) {
			if(ex_size == ''){
				ex_size = 0;	
			}
			price = price + parseInt(ex_size);
		}

		var ex_waterproof = $("input[name='addon-11722-waterproof-2[]']:checked").attr('data-price');
		if( typeof ex_waterproof != 'undefined' ) {
			if(ex_waterproof == ''){
				ex_waterproof = 0;	
			}
			price = price + parseInt(ex_waterproof);
		}
		var ex_color_type = $("input[name='addon-11722-color-type-3[]']:checked").attr('data-price');
		if( typeof ex_color_type != 'undefined' ) {
			if(ex_color_type == ''){
				ex_color_type = 0;	
			}
			price = price + parseInt(ex_color_type);
		}

		$("#neon_price").text(price);
		$(".exp-price-field").text(price);
		$("#product_price").val(price);
		
		console.log('---'+price);
	}

	//background images 
	// $('.bg_slider').slick({
	// 	infinite: false,
	// 	slidesToShow: 4,
	// 	slidesToScroll: 1,
	// 	dots: false,
	// 	arrows: true,
	// });

	$(document).on('click', '.bg_change' , function() {
	    var img_src =  $(this).attr('src');
	    $('.bg-img').removeClass("bg-active");

	    $(this).parent().addClass("bg-active");
	    $('#neon_product_img').attr('src', img_src);
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			  	$('#previewHolder').attr('src', e.target.result);
			  	$('#neon_product_img').attr('src', e.target.result);
			  	var img_html = '<div><img class="bg_change"  src="'+e.target.result+'" ></div>';
				$('.bg_slider').slick('slickAdd',img_html,0);

			}
			reader.readAsDataURL(input.files[0]);
		} else {
				alert('select a file to see preview');
				$('#previewHolder').attr('src', '');
		}

	}

	function previewProduct(input) {
		//console.log(input);
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				console.log(e.target.result);
			  	$('#neon_product_img').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#bg_image").change(function() {
	  	 readURL(this);
	});

	// $( ".bg_custom_image" ).click(function() {
	// 	$("#bg_image").click();
	// });

	$("#custom_design").change(function() {
		previewProduct(this);
		$('#neon_preview_text').html('');
		var proPrice = $('#custom_design_product_price').val();
		if(proPrice === ''){
			proPrice = $('#base_price').val();
		}
		$("#neon_price").text(proPrice);
		$("#product_price").val(proPrice);
		$(".exp-price-field").text(proPrice);
	  	$(".action").prop('disabled', false);
	});
	
	//drag text over
	// 	jQuery( function() {
	//     	jQuery( "#neon_preview_text" ).draggable({
	//     		containment: "parent"
	//     	});
	//  });

   	$('#neon_preview_text').dragon({
       'within': $('#drag_container')
    });
    
    var winWidth = window.innerWidth;

    if( winWidth > 719 ) {
        setTimeout(function(){ 
	   	var sidebar = new StickySidebar('.neon_image_wrapper', {
		        containerSelector: '.sticky-container',
		        innerWrapperSelector: '.product_image',
		        topSpacing: 20,
		        bottomSpacing: 20
		    });
	   	
	   }, 200);
    }

    // Get the modal
	var modal = document.querySelector("#myPrevModal");

	// Get the button that opens the modal
	var btn = document.querySelector("#previewNeon");

	// Get the <span> element that closes the modal
	var span = document.querySelector(".close");

	// When the user clicks the button, open the modal 
	btn.onclick = function() {
		window.scrollTo(0, 0);
		setTimeout(function(){ 
		document.documentElement.classList.add("hide-scrollbar");
		//var el = document.querySelector("#drag_container");
		  html2canvas( document.querySelector("#drag_container"), {
       			scale: 2,
       			width: document.querySelector("#drag_container").scrollWidth,
    			height: document.querySelector("#drag_container").scrollHeight,
    			//scrollX: -window.scrollX,
		       // scrollY: -window.scrollY,
		        windowWidth: document.documentElement.offsetWidth,
		        windowHeight: document.documentElement.offsetHeight
            }).then(function (canvas) {
	        	var img = canvas.toDataURL("image/jpeg");
	    		 
	        	document.querySelector("#previewProImg").src = img;
		  		modal.style.display = "block";
		  		
        		document.documentElement.classList.remove("hide-scrollbar");
		    });
		   }, 700);
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}


});


function doCapture() {
    
    window.scrollTo(0, 0);
    
    setTimeout(function(){ 
		document.documentElement.classList.add("hide-scrollbar");
		var ele = document.querySelector("#drag_container");
		  html2canvas( ele, {
       			scale: 2,
       			width: ele.scrollWidth,
    			height: ele.scrollHeight,
    			// scrollX: -window.scrollX,
		     //    scrollY: -window.scrollY,
		        windowWidth: document.documentElement.offsetWidth,
		        windowHeight: document.documentElement.offsetHeight
            }).then(function (canvas) {
        	var img = canvas.toDataURL("image/jpeg");
    		 
        	document.getElementById("product_image").value = img;
    		document.querySelector(".single_add_to_cart_button").click();

    		document.documentElement.classList.remove("hide-scrollbar");
	    });
        
    }, 700);

 }

