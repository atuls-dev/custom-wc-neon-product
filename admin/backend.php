<?php

	//adding checkbox option to enable neon product
	add_filter( 'product_type_options', 'hide_related_products_option' );
	function hide_related_products_option( $fields ) {
	    $fields['neon_product'] = array(
	        'id'                => '_neon_product',
	        'wrapper_class'     => '',
	        'label'             => __('Neon Product'),
	        'description'   => __( 'Check if you need neon product configuration.', 'woocommerce' ),
	        
	    );
	    return $fields;
	}

	add_action( 'woocommerce_admin_process_product_object', 'hide_related_products_option_save' );
	function hide_related_products_option_save( $product ) {
	    $product->update_meta_data( '_neon_product', isset( $_POST['_neon_product'] ) ? 'yes' : '' );
	}

	// -----------------------------------------
	// Created new neon product meta tab
	add_filter( 'woocommerce_product_data_tabs', 'neon_product_tab' );

	function neon_product_tab( $tabs) {
		global $post;
		$is_neon = get_post_meta( $post->ID, '_neon_product', true );
	    $neon_class = ( $is_neon == 'yes' ) ? '' : 'hide_if_neon';
		$tabs['neon'] = array(
	      'label'	 => __( 'Neon Product', 'exp_product' ),
	      'target' => 'neon_product_options',
	      'class'  => 'hide_if_external '.$neon_class,
	      'style' => 'display:none;'
	      //'priority' => 25
	     );
	    
	    return $tabs;
	}

	// -----------------------------------------
	// Created custom input fields inside neon product tab
	add_action( 'woocommerce_product_data_panels', 'neon_product_tab_product_tab_content' );

	function neon_product_tab_product_tab_content() {
		global $post;
		$product_id = $post->ID;
		$neon_addon_data = get_post_meta( $product_id, 'neon_addon_data', true );
		 // echo "<pre>";
		 // print_r($neon_addon_data);
		 // echo "</pre>";
	 ?><div id='neon_product_options' class='panel woocommerce_options_panel'>
	 	<?php include( plugin_dir_path( __FILE__ ) . '/backend_panel.php' ); ?>
	 </div><?php
	}


	// -----------------------------------------
	// Process custom input fields inside neon product tab
	add_action( 'woocommerce_process_product_meta', 'save_neon_product_settings' );
	
	function save_neon_product_settings( $post_id ){
			
	    update_post_meta( $post_id, 'neon_custom_design', $_POST['neon_custom_design'] );
			
	    $neon_price_per_character = $_POST['neon_price_per_character'];
	    if( isset( $neon_price_per_character ) ) {
			update_post_meta( $post_id, 'neon_price_per_character', esc_attr( $neon_price_per_character ) );
	    }

	    $custom_design_product_price = $_POST['custom_design_product_price'];
	    if( isset( $custom_design_product_price ) ) {
			update_post_meta( $post_id, 'custom_design_product_price', esc_attr( $custom_design_product_price ) );
	    }

	    if( !empty( $_POST['neon_size'] ) ) {
	    	$neon_size = json_encode($_POST['neon_size']);
			update_post_meta( $post_id, 'neon_size', $neon_size );
	    }

	    if( !empty( $_POST['neon_support'] ) ) {
	    	$neon_support = json_encode($_POST['neon_support']);
			update_post_meta( $post_id, 'neon_support', $neon_support );
	    }

	}

	// -----------------------------------------
	// loading scripts for backend
	function neon_admin_load_scripts() {
		$plugin_url = plugin_dir_url( __FILE__ );
		wp_enqueue_style( 'backend-style',  $plugin_url . "css/backend_style.css",false,time(),false);

		wp_enqueue_script( 'neon-custom-backend-js', $plugin_url.'js/backend_script.js', array('jquery'),time(),true );
		wp_localize_script( 'neon-custom-backend-js', 'ajax_object',
	             array( 
	             	'ajax_url' => admin_url( 'admin-ajax.php' ),
	             ) 
	         );
	}
	add_action('admin_enqueue_scripts', 'neon_admin_load_scripts');

	// -----------------------------------------
	// adding custom addon thickbox fields
	function neon_render_add_form_page() {
		$product_id = $_GET['product_id'];
		if(isset($_POST['neonSave'])){
			$neon_addon_data = get_post_meta( $product_id, 'neon_addon_data', true );
			if(empty($neon_addon_data)){
				$neon_addon_data = array();
			}
			$optionArr = [];
			//creating type array
			if( $_POST['addon_field_type'] != 'text' && $_POST['addon_field_type'] != 'checkbox' ) {

				foreach($_POST['neon_option_label'] as $key => $val) {
					$optionArr[] = array(
						'label' => $val,
						'value' => $_POST['neon_option_value'][$key],
						'price' => $_POST['neon_option_price'][$key],
						'img' => $_POST['neon_option_img'][$key],
					);
				}
			}

			$addon_id = uniqid();
			$data[$addon_id] = array(
				'field_type' => $_POST['addon_field_type'],
				'addon_name' => $_POST['addon_name'],
				'addon_label' => $_POST['addon_label'],
				'addon_desc' => $_POST['addon_desc'],
				'addon_value' => $_POST['addon_value'],
				'addon_price' => $_POST['addon_price'],
				'addon_place' => $_POST['addon_place'],
				'field_option' => $optionArr,
			);
			//echo "<pre>";
			//print_r($data);die('dfdsf');

			$neon_addon_data = array_merge( $neon_addon_data, $data );

			update_post_meta( $product_id, 'neon_addon_data', $neon_addon_data );
		}

	    define( 'IFRAME_REQUEST', true );
	    iframe_header();
	    	include( plugin_dir_path( __FILE__ ) . '/backend_form_add.php' );
	    iframe_footer();
	    exit;
	}
	add_action( 'admin_action_add_addon_modal_box', 'neon_render_add_form_page' );


	function neon_render_edit_form_page() {
		$product_id = $_GET['product_id'];
		$addon_id = $_GET['addon_id'];
		$neon_addon_data = get_post_meta( $product_id, 'neon_addon_data', true );
		$addon_data = $neon_addon_data[$addon_id];

		if(isset($_POST['neonSave'])){

			$optionArr = [];
			//creating type array
			if( $_POST['addon_field_type'] != 'text' && $_POST['addon_field_type'] != 'checkbox' ) {

				foreach($_POST['neon_option_label'] as $key => $val) {
					$optionArr[] = array(
						'label' => $val,
						'value' => $_POST['neon_option_value'][$key],
						'price' => $_POST['neon_option_price'][$key],
						'img' => $_POST['neon_option_img'][$key],
					); 
				}
			}

			//$addon_id = uniqid();
			$data[$addon_id] = array(
				'field_type' => $_POST['addon_field_type'],
				'addon_name' => $_POST['addon_name'],
				'addon_label' => $_POST['addon_label'],
				'addon_desc' => $_POST['addon_desc'],
				'addon_price' => $_POST['addon_price'],
				'addon_place' => $_POST['addon_place'],
				'field_option' => $optionArr,
			);

			$neon_addon_data = array_merge( $neon_addon_data, $data );

			update_post_meta( $product_id, 'neon_addon_data', $neon_addon_data );
		}

	    define( 'IFRAME_REQUEST', true );
	    iframe_header();
	    	include( plugin_dir_path( __FILE__ ) . '/backend_form_edit.php' );
	    iframe_footer();
	    exit;
	}
	add_action( 'admin_action_edit_addon_modal_box', 'neon_render_edit_form_page' );

	// -----------------------------------------
	// backend ajax for sorting handling
	add_action( 'wp_ajax_neon_data_sort', 'neon_sort_addon' );
	add_action( 'wp_ajax_nopriv_neon_data_sort', 'neon_sort_addon' );
	function neon_sort_addon() {
		$key = $_POST['currentAddon'];
		$before = $_POST['moveAddon'];
		$product_id = $_POST['product_id'];
		$neon_addon_data = get_post_meta( $product_id, 'neon_addon_data', true );

		$finalArr = moveKeyAfter( $neon_addon_data, $key, $before );
		
		update_post_meta( $product_id, 'neon_addon_data', $finalArr );
		wp_die();
	}

	// -----------------------------------------
	// handling sorting of array
	function moveKeyAfter( array $arr, $key, $before ) {

	  	if (array_key_exists($key, $arr) && array_key_exists($before, $arr) ) {
	 
	        $newArr = [];
	        foreach ($arr as $idx => $value) {
	            switch ($idx) {
	            case $key:
	              continue 2;
				case $before:
				  $newArr[$idx] = $value;
				  $newArr[$key] = $arr[$key];
				  break;
				default:
				  $newArr[$idx] = $value;
				  break;
	            }
	        }

	          return $newArr;
	    }else if( !array_key_exists($before, $arr) ){
	    	$newArr = [];
	          foreach ($arr as $idx => $value) {
	              switch ($idx) {
	                  case $key :
	                    $keyVal[$key] = $value;
	                    break;
	                  default:
	                    $newArr[$idx] = $value;
	                    break;
	              }
	          }
			return array_merge($keyVal, $newArr);
	   }
   
	}

	// -----------------------------------------
	// backend ajax for addon remove
	add_action( 'wp_ajax_neon_addon_remove', 'neon_addon_remove' );
	add_action( 'wp_ajax_nopriv_neon_addon_remove', 'neon_addon_remove' );
	function neon_addon_remove() {
		$addonKey = $_POST['addonKey'];
		$product_id = $_POST['product_id'];

		$neon_addon_data = get_post_meta( $product_id, 'neon_addon_data', true );
		unset($neon_addon_data[$addonKey]);
		update_post_meta( $product_id, 'neon_addon_data', $neon_addon_data );
		$neon_addon_data = get_post_meta( $product_id, 'neon_addon_data', true );
		include( plugin_dir_path( __FILE__ ) . 'backend_panel_fields.php' ); 
		wp_die();
	}
	

	// -----------------------------------------
	// backend ajax for addon remove
	add_action( 'wp_ajax_neon_panel_update', 'neon_panel_update' );
	add_action( 'wp_ajax_nopriv_neon_panel_update', 'neon_panel_update' );
	function neon_panel_update() {
		$product_id = $_POST['product_id'];
		$neon_addon_data = get_post_meta( $product_id, 'neon_addon_data', true );
		//ob_start();
		
		include( plugin_dir_path( __FILE__ ) . 'backend_panel_fields.php' ); 
		//return ob_get_clean();
		wp_die();
	}


	// -----------------------------------------
	// backend ajax for addon option image upload
	add_action( 'wp_ajax_option_img_upload', 'neon_option_img_upload' );
	add_action( 'wp_ajax_nopriv_option_img_upload', 'neon_option_img_upload' );
	function neon_option_img_upload() {
	
		$upload = array();
		$arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
	    if (in_array($_FILES['file']['type'], $arr_img_ext)) {
	        $upload = wp_upload_bits($_FILES["file"]["name"], null, file_get_contents($_FILES["file"]["tmp_name"]));
	        //$upload['url'] will gives you uploaded file path
	    }
	    if( !empty($upload['url']) ){
	    	echo json_encode( array( 'status' => 'success', 'path' => $upload['url'] ) );
	    }else{
	    	echo json_encode( array( 'status' => 'error' ) );
	    }
		wp_die();
	}
	



?>