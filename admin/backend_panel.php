
<?php  add_thickbox(); ?>

<input type="hidden" id="product_id" name="product_id" value="<?=$product_id?>" >
<div class='exp-custom-option'>
	<?php		
	    woocommerce_wp_text_input(
			array(
			  'id' => 'neon_price_per_character',
			  'label' => __( 'Price per character', 'exp_product' ),
			  'placeholder' => '',
			  'desc_tip' => 'true',
			  'description' => __( 'Enter Neon product Price per character.', 'exp_product' ),
			  'type' => 'number'
			)
	    );
	    
	 ?>
</div>
<div class='exp-custom-option'>
	<?php		
	    woocommerce_wp_checkbox( 
			array( 
				'id'            => 'neon_custom_design', 
				'label'         => __('Allow user to upload custom designs', 'woocommerce' ), 
				'description'   => __( 'If checked it will allow user to upload their custom designs', 'woocommerce' ),
				'desc_tip' => true,
				//'value'         => get_post_meta( $variation->ID, '_checkbox', true ), 
				)
			);
	 ?>
</div>
<div class='exp-custom-option'>
	<?php		
	    woocommerce_wp_text_input(
			array(
			  'id' => 'custom_design_product_price',
			  'label' => __( 'Custom Design Product Price', 'exp_product' ),
			  'placeholder' => '',
			  'desc_tip' => 'true',
			  'description' => __( 'Enter Neon product Price if customer uploads custom design.', 'exp_product' ),
			  'type' => 'number'
			)
	    );
	    
	 ?>
</div>

<?php

$url = add_query_arg( array(
    'action'    => 'add_addon_modal_box',
    'product_id'    => $product_id,
    'TB_iframe' => 'true',
    'width'     => '600',
    'height'    => '400',
), admin_url( 'admin.php' ) );

?>

<a href="<?=$url?>" class="button button-primary thickbox"><?= __( 'Add New AddOn', 'neon' )?></a>
<?php if($neon_addon_data) { ?>
<table id="neonSortable" class="neon-table">
	<thead>
		<tr>
			<th>Label</th>
	        <th>Name</th>
	        <th>Action</th>
		</tr>
	</thead>
	<tbody id="panelData">
	<?php include( plugin_dir_path( __FILE__ ) . 'backend_panel_fields.php' ); ?>
	</tbody>
</table>
<?php } ?>

<?php $neon_size = json_decode( get_post_meta( $product_id, 'neon_size', true ), true ); ?>
<div class='exp-custom-option'>
	<p class="exp-custom-option-heading">Size</p>
	<div class="exp-custom-option-Group">
		
		<p class="sub-heading">Small</p>
		<div class="exp-option-box">
			<label for="size_s_length">Length</label>
			<input id="size_s_length" type="text" name="neon_size[s][length]" value="<?= $neon_size['s']['length'] ?>" >
		</div>
		<div class="exp-option-box">
			<label for="size_s_height">Height</label>
			<input type="text" id="size_s_height" name="neon_size[s][height]" value="<?= $neon_size['s']['height'] ?>" >
		</div>
		<div class="exp-option-box">
			<label for="size_s_price">Price</label>
			<input type="number" id="size_s_price" name="neon_size[s][price]" value="<?= $neon_size['s']['price'] ?>" >
		</div>
	
	</div>
	<div class="exp-custom-option-Group">
		<p class="sub-heading">Medium</p>
		<div class="exp-option-box">
			<label for="size_m_length">Length</label>
			<input id="size_m_length" type="text" name="neon_size[m][length]" value="<?= $neon_size['m']['length'] ?>" >
		</div>
		<div class="exp-option-box">
			<label for="size_m_height">Height</label>
			<input type="text" id="size_m_height" name="neon_size[m][height]" value="<?= $neon_size['m']['height'] ?>" >
		</div>
		<div class="exp-option-box">
			<label for="size_m_price">Price</label>
			<input type="number" id="size_m_price" name="neon_size[m][price]" value="<?= $neon_size['m']['price'] ?>" >
		</div>
	</div> 
	<div class="exp-custom-option-Group">
		<p class="sub-heading">Large</p>
		<div class="exp-option-box">
			<label for="size_l_length">Length</label>
			<input id="size_l_length" type="text" name="neon_size[l][length]" value="<?= $neon_size['l']['length'] ?>" >
		</div>
		<div class="exp-option-box">
			<label for="size_l_height">Height</label>
			<input type="text" id="size_l_height" name="neon_size[l][height]" value="<?= $neon_size['l']['height'] ?>" >
		</div>
		<div class="exp-option-box">
			<label for="size_m_price">Price</label>
			<input type="number" id="size_l_price" name="neon_size[l][price]" value="<?= $neon_size['l']['price'] ?>" >
		</div>
	</div> 
	<div class="exp-custom-option-Group">
		<p class="sub-heading">Extra Large</p>
		<div class="exp-option-box">
			<label for="size_xl_length">Length</label>
			<input id="size_xl_length" type="text" name="neon_size[xl][length]" value="<?= $neon_size['xl']['length'] ?>" >
		</div>
		<div class="exp-option-box">
			<label for="size_xl_height">Height</label>
			<input type="text" id="size_xl_height" name="neon_size[xl][height]" value="<?= $neon_size['xl']['height'] ?>" >
		</div>
		<div class="exp-option-box">
			<label for="size_m_price">Price</label>
			<input type="number" id="size_xl_price" name="neon_size[xl][price]" value="<?= $neon_size['xl']['price'] ?>" >
		</div>
	</div> 
</div>
<!--
<?php $neon_support = json_decode( get_post_meta( $product_id, 'neon_support', true ), true ); ?>
<div class='exp-custom-option'>
	<p class="exp-custom-option-heading">Support</p>
	<div class="exp-custom-option-Group-radio">
		<p class="form-field">
			<label for="support_1">Rectangle</label>
			<input id="support_1" type="number" name="neon_support[rectangle]" value="<?= $neon_support['rectangle'] ?>" > $
		</p>
		<p class="form-field">
			<label for="support_2">Cut out around the letters</label>
			<input  id="support_2" type="number" name="neon_support[cut_out_around]" value="<?= $neon_support['cut_out_around'] ?>" >$
		</p>
		<p class="form-field">
			<label for="support_3"> Acrylic box</label>
			<input  id="support_3" type="number" name="neon_support[acrylic_box]" value="<?= $neon_support['acrylic_box'] ?>" >$
		</p>
	</div>
</div>-->
