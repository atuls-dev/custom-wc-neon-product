<?php
  
	// -----------------------------------------
	// Throw error if custom input field empty

	// add_filter( 'woocommerce_add_to_cart_validation', 'exp_product_add_on_validation', 10, 3 );
	 
	// function exp_product_add_on_validation( $passed, $product_id, $qty ){
	//    if( isset( $_POST['neon_text'] ) && sanitize_text_field( $_POST['neon_text'] ) == '' ) {
	//       $passed = false;
	//    }
	//    return $passed;
	// }
 
	// -----------------------------------------
	//  Save custom input field value into cart item data
 
	add_filter( 'woocommerce_add_cart_item_data', 'exp_product_add_on_cart_item_data', 10, 2 );
	 
	function exp_product_add_on_cart_item_data( $cart_item, $product_id ){

		if( isset( $_POST['neon_addon'] ) ) {
			$cart_item['neon_addon'] = $_POST['neon_addon'];
		}

	    if( isset( $_POST['neon_text'] ) && !empty($_POST['neon_text']) ) {
	        $cart_item['neon_text'] = sanitize_text_field( $_POST['neon_text'] );
	    }
		if( isset( $_POST['font_type'] ) && !empty($_POST['font_type']) ) {
			$cart_item['font_type'] = sanitize_text_field( $_POST['font_type'] );
		}
		if( isset( $_POST['font_shadow'] ) && !empty($_POST['font_shadow']) ) {
			$cart_item['font_shadow'] = sanitize_text_field( $_POST['font_shadow'] );
		}
		if( isset( $_POST['cut'] ) && !empty($_POST['cut']) ) {
			$cart_item['cut'] = sanitize_text_field( $_POST['cut'] );
		}
		if( isset( $_POST['support'] ) && !empty($_POST['support'])   ) {
			$cart_item['support'] = sanitize_text_field( $_POST['support'] );
		}
	
		if( isset( $_POST['comments'] ) && trim($_POST['comments']) !== '' ) {
			$cart_item['comments'] = sanitize_text_field( $_POST['comments'] );
		}
		if( isset( $_POST['product_price'] ) ) {
			$cart_item['product_price'] = sanitize_text_field( $_POST['product_price'] );
		}

		if( isset($_POST['product_image']) && !empty($_POST['product_image'])  ) {
			$image = $_POST["product_image"];
			$image = explode(";", $image)[1];
			$image = explode(",", $image)[1];
			$image = str_replace(" ", "+", $image);

			$imgstring = base64_decode($image);
			
	      	$now = date("U");  // create a timestamp to append to the filename

	        $upload_dir   = wp_upload_dir();
			
	        $targetfolder = $upload_dir['basedir'] . '/neon_product';
	       
			if (!file_exists($targetfolder)) {
			    mkdir($targetfolder, 0755, true);
			}

	        $file_name = 'image-'.$now.'.jpeg';
	        $upl_base_url = is_ssl() ? str_replace('http://', 'https://', $upload_dir['baseurl']) : $upload_dir['baseurl'];

	        $file = $targetfolder. '/' . $file_name;

			file_put_contents($file, $imgstring);
	        $base_name    = basename( $file_name );

	        $cart_item['product_image'] = array(
	            'guid'      => $upl_base_url .'/neon_product/'. $base_name, // Url
	            'file_type' => 'jpeg', // File type
	            'file_name' => $base_name, // File name
	            'title'     => ucfirst( preg_replace('/\.[^.]+$/', '', $base_name ) ), // Title
	        );
    	}


		/*if( isset($_FILES['bg_image']) && !empty($_FILES['bg_image']['name']) ) {
	        $upload       = wp_upload_bits( $_FILES['bg_image']['name'], null, file_get_contents( $_FILES['bg_image']['tmp_name'] ) );
	        $filetype     = wp_check_filetype( basename( $upload['file'] ), null );
	        $upload_dir   = wp_upload_dir();
	        $upl_base_url = is_ssl() ? str_replace('http://', 'https://', $upload_dir['baseurl']) : $upload_dir['baseurl'];
	        $base_name    = basename( $upload['file'] );

	        $cart_item['file_upload'] = array(
	            'guid'      => $upl_base_url .'/'. _wp_relative_upload_path( $upload['file'] ), // Url
	            'file_type' => $filetype['type'], // File type
	            'file_name' => $base_name, // File name
	            'title'     => ucfirst( preg_replace('/\.[^.]+$/', '', $base_name ) ), // Title
	        );
    	}*/

    	if( isset($_FILES['custom_design']) && !empty($_FILES['custom_design']['name']) ) {
	        $upload       = wp_upload_bits( $_FILES['custom_design']['name'], null, file_get_contents( $_FILES['custom_design']['tmp_name'] ) );
	        $filetype     = wp_check_filetype( basename( $upload['file'] ), null );
	        $upload_dir   = wp_upload_dir();
	        $upl_base_url = is_ssl() ? str_replace('http://', 'https://', $upload_dir['baseurl']) : $upload_dir['baseurl'];
	        $base_name    = basename( $upload['file'] );

	        $cart_item['custom_design'] = array(
	            'guid'      => $upl_base_url .'/'. _wp_relative_upload_path( $upload['file'] ), // Url
	            'file_type' => $filetype['type'], // File type
	            'file_name' => $base_name, // File name
	            'title'     => ucfirst( preg_replace('/\.[^.]+$/', '', $base_name ) ), // Title
	        );
	        //$cart_item['unique_key'] = md5( microtime().rand() ); // Avoid merging items
    	}

	    return $cart_item;
	}
 
	// -----------------------------------------
	//  Display custom input field value @ Cart
 
	add_filter( 'woocommerce_get_item_data', 'exp_product_add_on_display_cart', 10, 2 );
	 
	function exp_product_add_on_display_cart( $data, $cart_item ) {

		

	    if ( isset( $cart_item['neon_text'] ) ){
	        $data[] = array(
	            'name' => 'Text',
	            'value' => sanitize_text_field( $cart_item['neon_text'] )
	        );
	    }
	    if ( isset( $cart_item['font_type'] ) ){
	        $data[] = array(
	            'name' => 'Text Font Style',
	            'value' => sanitize_text_field( $cart_item['font_type'] )
	        );
	    }
	    if ( isset( $cart_item['font_shadow'] ) ){
	        $data[] = array(
	            'name' => 'Color',
	            'value' => sanitize_text_field( $cart_item['font_shadow'] )
	        );
	    }
	    if ( isset( $cart_item['cut'] ) ){
	        $data[] = array(
	            'name' => 'Cut',
	            'value' => sanitize_text_field( $cart_item['cut'] )
	        );
	    }

	    if ( isset( $cart_item['support'] ) ){
	        $data[] = array(
	            'name' => 'Type de support',
	            'value' => sanitize_text_field( $cart_item['support'] )
	        );
	    }
	    
	    if ( isset( $cart_item['comments'] ) ){
	        $data[] = array(
	            'name' => 'Comments',
	            'value' => sanitize_text_field( $cart_item['comments'] )
	        );
	    }

	    if ( isset( $cart_item['custom_design']['title'] ) ){
	        $data[] = array(
	            'name' => __( 'Design Uploaded', 'woocommerce' ),
	            'value' =>  $cart_item['custom_design']['title'],
	        );
    	}

    	if ( isset( $cart_item['neon_addon'] ) && !empty($cart_item['neon_addon']) ){
	        
			foreach( $cart_item['neon_addon'] as $name => $value ) {
				if( is_array($value) ){
					if( !empty($value)) {
						$data[] = array(
				            'name' => ucfirst($name),
				            'value' => implode(", ", $value )
				        );
					}
				}else{
					if( !empty($value)) {
						$data[] = array(
				            'name' => ucfirst($name),
				            'value' => sanitize_text_field( $value )
				        );
			        }		
				}
			}
	    }
	    
	    /*if ( is_checkout() ) {
	    	$data[] = array(
	            'name' => 'Preview',
	            'value' => 'Preview'
	        );
	    }*/

	    // if ( isset( $cart_item['file_upload']['title'] ) ){
	    //     $data[] = array(
	    //         'name' => __( 'Image Uploaded', 'woocommerce' ),
	    //         'value' =>  $cart_item['file_upload']['title'],
	    //     );
    	// }
    	
	    return $data;
	}

	// -----------------------------------------
	//WooCommerce Show Product Image @ Checkout Page
	add_filter( 'woocommerce_cart_item_name', 'ts_product_image_on_checkout', 10, 3 );

	function ts_product_image_on_checkout( $name, $cart_item, $cart_item_key ) {  

	    /* Return if not checkout page */
	    if ( ! is_checkout() ) {
	        return $name;
	    }

	    /* Get product object */
	    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

	    if( isset($cart_item['custom_design']) ) {

	    	/* Get product thumbnail */
		    $thumbnail = '<img class="attachment-woocommerce_thumbnail size-woocommerce_thumbnai" src="'.$cart_item['custom_design']['guid'].'" >';

		    /* Add wrapper to image and add some css */
		    $image = '<div class="ts-product-image" style="width: 100px; height: 100px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
		                . $thumbnail .
		            '</div>';

		    /* Prepend image to name and return it */
		    return $image . $name;

	    } else if( isset($cart_item['product_image'])) {

	    	  // Get product thumbnail 
		    $thumbnail = '<img class="attachment-woocommerce_thumbnail size-woocommerce_thumbnai" src="'.$cart_item['product_image']['guid'].'" >';

		     // Add wrapper to image and add some css 
		    $image = '<div class="ts-product-image" style="width: 100px; height: 100px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
		                . $thumbnail .
		            '</div>';

		     // Prepend image to name and return it 
		    return $image . $name;
	    }

	   	return $name;
	}


	// -----------------------------------------
	//  Display custom product image @ Cart
	add_filter( 'woocommerce_cart_item_thumbnail', 'custom_new_product_image', 10, 3 );
	function custom_new_product_image( $_product_img, $cart_item, $cart_item_key ) {

	    $is_neon = get_post_meta( $cart_item['product_id'], '_neon_product', true );
	    if ( $is_neon == 'yes' ) {
	    	if( isset($cart_item['custom_design']) && !empty($cart_item['custom_design']['guid']) ){
	    		$image_path = $cart_item['custom_design']['guid'];
	    	}else{
	    		$image_path = $cart_item['product_image']['guid'];
	    	}
	    	$img      =   '<img class="attachment-woocommerce_thumbnail size-woocommerce_thumbnai" src="'.$image_path.'" >';
	    	return $img;
	    }else{
	    	return $_product_img;
	    }
	}

	// -----------------------------------------
	// set custom product price
	add_action( 'woocommerce_before_calculate_totals', 'custom_cart_item_price', 30, 1 );
	function custom_cart_item_price( $cart ) {
	    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
	        return;

	    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
	        return;

	    foreach ( $cart->get_cart() as $cart_item ) {
	    	//echo "<pre>";print_r(); echo "</pre>";
	    	if( isset($cart_item['custom_design']) && !empty($cart_item['custom_design']['guid']) ){
	    		$product_price = get_post_meta( $cart_item['product_id'], 'custom_design_product_price', true );
	    		if(empty($product_price)) {
	    			$product_price = $cart_item['data']->price;
	    		}
	        	$cart_item['data']->set_price( $product_price );
	    	}else if( isset($cart_item['product_price']) ) {
	    		$product_price = $cart_item['product_price'];
	        	$cart_item['data']->set_price( $product_price );
	    	}
	        // if( isset($cart_item['product_price']) )
	    }
	}
	

	// Save Image data as order item meta data
	/*add_action( 'woocommerce_checkout_create_order_line_item', 'custom_field_update_order_item_meta', 20, 4 );
	function custom_field_update_order_item_meta( $item, $cart_item_key, $values, $order ) {
	    if ( isset( $values['product_image'] ) ){
	        $item->update_meta_data( '_img_file',  $values['product_image'] );
	    }
	}*/

	// Admin orders: Display a linked button + the link of the image file
	add_action( 'woocommerce_after_order_itemmeta', 'backend_image_link_after_order_itemmeta', 10, 3 );
	function backend_image_link_after_order_itemmeta( $item_id, $item, $product ) {
	    // Only in backend for order line items (avoiding errors)
	    if( is_admin() && $item->is_type('line_item')  ){
	    	if( $file_data = $item->get_meta( '_img_custom_file' )) {
	        	echo '<p><a href="'.$file_data['guid'].'" download class="button">'.'<img style="width: 100px; height: 100px;" src="'.$file_data['guid'].'"></a></p>'; // Optional
	    	}else if($file_data = $item->get_meta( '_img_file' )){
	        	echo '<p><a href="'.$file_data['guid'].'" download class="button">'.'<img style="width: 100px; height: 100px;" src="'.$file_data['guid'].'"></a></p>'; // Optional
	    	}
	    }
	}

	// -----------------------------------------
	// Save custom input field value into order item meta
	 
	add_action( 'woocommerce_add_order_item_meta', 'exp_product_add_on_order_item_meta', 10, 2 );
	 
	function exp_product_add_on_order_item_meta( $item_id, $values ) {

	    if ( ! empty( $values['neon_text'] ) ) {
	        wc_add_order_item_meta( $item_id, 'Text', $values['neon_text'], true );
	    }
	    if ( ! empty( $values['font_type'] ) ) {
	        wc_add_order_item_meta( $item_id, 'Text Font Style', $values['font_type'], true );
	    }
	    if ( ! empty( $values['font_shadow'] ) ) {
	        wc_add_order_item_meta( $item_id, 'Color', $values['font_shadow'], true );
	    }
	    if ( ! empty( $values['cut'] ) ) {
	        wc_add_order_item_meta( $item_id, 'Cut', $values['cut'], true );
	    }
	    if ( ! empty( $values['support'] ) ) {
	        wc_add_order_item_meta( $item_id, 'Type de support', $values['support'], true );
	    }
	    if ( ! empty( $values['comments'] ) ) {
	        wc_add_order_item_meta( $item_id, 'Comments', $values['comments'], true );
	    }
	    if ( ! empty( $values['product_image'] ) ) {
	        wc_add_order_item_meta( $item_id, '_img_file', $values['product_image'], true );
	    }
	    if ( ! empty( $values['custom_design'] ) ) {
	        wc_add_order_item_meta( $item_id, '_img_custom_file', $values['custom_design'], true );
	    }

	    if ( ! empty( $values['neon_addon'] ) ) {

			foreach( $values['neon_addon'] as $name => $value ) {
				if( is_array($value) ){
					wc_add_order_item_meta( $item_id, $name, implode(", ", $value ), true );
				}else{
					wc_add_order_item_meta( $item_id, $name, $value, true );			
				}
			}
	        
	    }
	}
	 
	 
	// -----------------------------------------
	// Display custom input field value into order emails
	 
	// add_filter( 'woocommerce_email_order_meta_fields', 'exp_product_add_on_display_emails' );
	 
	// function exp_product_add_on_display_emails( $fields ) { 
	//     $fields['neon_text'] = 'Text';
	//     return $fields; 
	// }


	// -----------------------------------------
	// loading scripts for frontend
	function neon_front_load_scripts() {
		global $post;
		$plugin_url = plugin_dir_url( __FILE__ );

	    $is_neon = get_post_meta( $post->ID, '_neon_product', true );
	    
	    if ( $is_neon == 'yes' ) {
			wp_enqueue_style( 'font-awe-style', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css');
	    	wp_enqueue_style( 'form-style',  $plugin_url . "css/frontend_style.css",false,time(),false);

			// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
			wp_localize_script( 'form-script', 'ajax_object',
		            array( 
		            	'ajax_url' => admin_url( 'admin-ajax.php' ), 
		            	'we_value' => 1234
		            ) 
		        );


			wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '1.12.1');

	    	
			//wp_enqueue_style( 'custom-drag-drop-style', $plugin_url. 'css/draganddrop.css', false,time(), true );
			//wp_enqueue_script( 'custom-drag-drop-script', $plugin_url. 'js/draganddrop.js', array('jquery'),time(),true );
			wp_enqueue_script( 'custom-drag-drop-script', $plugin_url. 'js/jquery.dragon.js', array('jquery'),time(),true );
	    	
	    	//wp_enqueue_style( 'slick',  $plugin_url . "css/slick/slick.css",false,time(),false);
	    	//wp_enqueue_style( 'slick-theme',  $plugin_url . "css/slick/slick-theme.css",false,time(),false);
	    	//wp_enqueue_script( 'slick', $plugin_url. 'js/slick/slick.min.js', array(),time(),true );

            //wp_enqueue_script( 'sticky-rAF', $plugin_url. 'js/rAF.js', array('jquery') );
            //wp_enqueue_script( 'sticky-ResizeSensor', $plugin_url. 'js/ResizeSensor.js', array('jquery') );
            wp_enqueue_script( 'sticky-sidebar', $plugin_url. 'js/sticky-sidebar.js', array('jquery'),time(),true );

			wp_enqueue_script( 'html2canvas', $plugin_url. 'js/html2canvas.js', array('jquery'), time(), false);
            wp_enqueue_script( 'form-script', $plugin_url. 'js/frontend_script.js', array('jquery'), time(), true );
	    	
	    	//script causing js conflict kadence woo extras
        	wp_dequeue_style('kadence_product_gallery_css');
        	wp_dequeue_script( 'kadence_product_gallery_zoom');
        	wp_dequeue_script( 'kadence-gal-slick');
        	wp_dequeue_script( 'magnific_popup');
        	wp_dequeue_script( 'kadence_product_gallery');
		}
	}
	add_action('wp_enqueue_scripts', 'neon_front_load_scripts');


	//single product image section html
	add_filter( 'woocommerce_single_product_image_html', 'neon_product_image_html', 99999, 2);
	add_filter( 'woocommerce_single_product_image_thumbnail_html', 'neon_product_image_html', 99999, 2);
	function neon_product_image_html( $html, $post_id ) {
		global $product;
	    $is_neon = get_post_meta( $product->get_id(), '_neon_product', true );
	    if ( $is_neon == 'yes' ) {
	    	ob_start();
        		include( plugin_dir_path( __FILE__ ) . '/product_image_section.php' );
			return ob_get_clean();
		}
		return $html;
	}
	
	//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_single_product_image_thumbnail_html', 9999999 );
	// if single product image is not hooked then product thumbnails section
	add_action( 'woocommerce_product_thumbnails', 'neon_product_image_section', 99999 );
	function neon_product_image_section() {
		global $product;
	    $is_neon = get_post_meta( $product->get_id(), '_neon_product', true );
	    if ( $is_neon == 'yes' ) {
			include( plugin_dir_path( __FILE__ ) . '/product_image_section.php' );	
		}else{
			return;
		}
	}


	// single product page front-end form html
	add_action( 'woocommerce_before_add_to_cart_button', 'neon_product_add_on', 99999 );

	function neon_product_add_on() {
		global $product;
		$is_neon = get_post_meta( $product->get_id(), '_neon_product', true );

	    if ( $is_neon == 'yes' ) {

	    	//enqueue scripts ends
	    	include( plugin_dir_path( __FILE__ ) . '/front_form.php' );		

		}

	}

    // Custom add to cart button
    add_action( 'woocommerce_after_add_to_cart_form', 'neon_product_cartbutton', 1 );

    function neon_product_cartbutton() {

    	global $product;
		if ( ! $product->is_purchasable() ) return;

	    $is_neon = get_post_meta( $product->get_id(), '_neon_product', true );
	    if ( $is_neon == 'yes' ) {
	        echo '<button id="previewNeon" >Preview</button><br>';
	        echo '<div class="exp-price">$<span class="exp-price-field">0.00</span></div>';
	        echo '<button class="action button" onclick="doCapture();" disabled>Add to Cart</button>';
    	}
    }
   
    //add class for product image wrapper
   	add_filter( 'woocommerce_single_product_image_gallery_classes', 'product_image_wrapper_classes' );
   	function product_image_wrapper_classes( $class ) {
   		global $product;
	    $is_neon = get_post_meta( $product->get_id(), '_neon_product', true );
	    if ( $is_neon == 'yes' ) {
	   		$class[] = 'neon_image_wrapper';
   		}
   		return $class;
   	}

   	// add class for sticky container element .sticky-container
	add_filter( 'woocommerce_post_class', 'neon_filter_woocommerce_post_class', 10, 2 );
   	function neon_filter_woocommerce_post_class( $classes, $product ) {
	    global $woocommerce_loop;
	    
	    // is_product() - Returns true on a single product page
	    // NOT single product page, so return
	    if ( ! is_product() ) return $classes;
	    
	    // The related products section, so return
	    if ( $woocommerce_loop['name'] == 'related' ) return $classes;
	    
	    // Add new class
	    $is_neon = get_post_meta( $product->get_id(), '_neon_product', true );
		if ( $is_neon == 'yes' ) {
	    	$classes[] = 'sticky-container';
	    }
	    return $classes;
	}

	//Removed Additional information Tab & Reviews  
	add_filter( 'woocommerce_product_tabs', 'exp_remove_product_tabs', 9999 );
	function exp_remove_product_tabs( $tabs ) {
	    unset( $tabs['reviews'] ); 
	    unset( $tabs['additional_information'] ); 
	    return $tabs;
	}

// 	function meks_which_template_is_loaded() {
	
// 		// global $template;
// 		// print_r( $template );

// 		$hook_name = 'woocommerce_product_thumbnails';
// 		//global $wp_filter;
		
// 		echo "<pre>"; print_r( list_hooks($hook_name) ); echo "<pre>"; exit;
		
	
// 	}
	 
// 	add_action( 'wp_footer', 'meks_which_template_is_loaded' );

// 	function list_hooks( $hook = '' ) {
//     global $wp_filter;

//     if ( isset( $wp_filter[$hook]->callbacks ) ) {      
//         array_walk( $wp_filter[$hook]->callbacks, function( $callbacks, $priority ) use ( &$hooks ) {           
//             foreach ( $callbacks as $id => $callback )
//                 $hooks[] = array_merge( [ 'id' => $id, 'priority' => $priority ], $callback );
//         });         
//     } else {
//         return [];
//     }

//     foreach( $hooks as &$item ) {
//         // skip if callback does not exist
//         if ( !is_callable( $item['function'] ) ) continue;

//         // function name as string or static class method eg. 'Foo::Bar'
//         if ( is_string( $item['function'] ) ) {
//             $ref = strpos( $item['function'], '::' ) ? new ReflectionClass( strstr( $item['function'], '::', true ) ) : new ReflectionFunction( $item['function'] );
//             $item['file'] = $ref->getFileName();
//             $item['line'] = get_class( $ref ) == 'ReflectionFunction' 
//                 ? $ref->getStartLine() 
//                 : $ref->getMethod( substr( $item['function'], strpos( $item['function'], '::' ) + 2 ) )->getStartLine();

//         // array( object, method ), array( string object, method ), array( string object, string 'parent::method' )
//         } elseif ( is_array( $item['function'] ) ) {

//             $ref = new ReflectionClass( $item['function'][0] );

//             // $item['function'][0] is a reference to existing object
//             $item['function'] = array(
//                 is_object( $item['function'][0] ) ? get_class( $item['function'][0] ) : $item['function'][0],
//                 $item['function'][1]
//             );
//             $item['file'] = $ref->getFileName();
//             $item['line'] = strpos( $item['function'][1], '::' )
//                 ? $ref->getParentClass()->getMethod( substr( $item['function'][1], strpos( $item['function'][1], '::' ) + 2 ) )->getStartLine()
//                 : $ref->getMethod( $item['function'][1] )->getStartLine();

//         // closures
//         } elseif ( is_callable( $item['function'] ) ) {     
//             $ref = new ReflectionFunction( $item['function'] );         
//             $item['function'] = get_class( $item['function'] );
//             $item['file'] = $ref->getFileName();
//             $item['line'] = $ref->getStartLine();

//         }       
//     }

//     return $hooks;
// }



