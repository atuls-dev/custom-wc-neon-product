<style>
	.neon-hide {
		display: none;
	}
	.neon-show {
		display: block;
	}

	.neon-option-field{
		display: flex;
    	align-items: center;
	}

</style>
<form class="neon-form" action="" method="post" >
	<input type="hidden" name="product_id" id="product_id" value="<?=$product_id?>" >
	<input type="hidden" name="addon_id" value="<?=$addon_id?>" >
	<div class="neon-form-heading">Edit AddOn</div>
	<div class="neon-field-panel">
		<div class="form-field">
			<div class="input-label">
				<label>Field Type</label>
			</div>
			<div class="input-field">
				<select id="addonFieldType" name="addon_field_type">
					<option <?php echo ($addon_data['field_type'] == 'text') ? 'selected':''; ?> value="text">Text</option>
					<option <?php echo ($addon_data['field_type'] == 'select') ? 'selected':''; ?> value="select">Select</option>
				<!--	<option <?php echo ($addon_data['field_type'] == 'checkbox') ? 'selected':''; ?> value="checkbox">Checkbox</option>-->
					<option <?php echo ($addon_data['field_type'] == 'checkbox-group') ? 'selected':''; ?> value="checkbox-group">Checkbox group</option>
					<option <?php echo ($addon_data['field_type'] == 'radio') ? 'selected':''; ?> value="radio">Radio</option>
					<option <?php echo ($addon_data['field_type'] == 'radio-img') ? 'selected':''; ?> value="radio-img">Image-Radio</option>
					<option <?php echo ($addon_data['field_type'] == 'textarea') ? 'selected':''; ?> value="textarea">Textarea</option>
				</select>
			</div>
		</div>
		<div class="form-field">
			<div class="input-label">
				<label>Name*</label>
				<span class="name-error"></span>
			</div>
			<div class="input-field">
				<input type="text" name="addon_name" value="<?=$addon_data['addon_name']?>" required>
			</div>
		</div>
		<div class="form-field">
			<div class="input-label">
				<label>Label*</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_label" value="<?=$addon_data['addon_label']?>" >
			</div>
		</div>
		<div class="form-field">
			<div class="input-label">
				<label>Description</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_desc" value="<?=$addon_data['addon_desc']?>" >
			</div>
		</div>
		<?php $neonStyle = ( $addon_data['field_type'] != 'text' && $addon_data['field_type'] != 'textarea' ) ? 'display:none;' : ''; ?>
		<div class="form-field form-placeholder" style="<?=$neonStyle?>">
			<div class="input-label">
				<label>Placeholder</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_place" value="<?=$addon_data['addon_place']?>" >
			</div>
		</div>
		<?php $neonClass = ( $addon_data['field_type'] != 'checkbox' ) ? 'neon-hide' : ''; ?>
		<div class="form-field form-field-extra <?=$neonClass?>">
			<div class="input-label">
				<label>Value</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_value" value="<?=$addon_data['addon_value']?>" >
			</div>
		</div>
		<div class="form-field form-field-extra neon-hide">
			<div class="input-label">
				<label>Price</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_price" value="<?=$addon_data['addon_price']?>" >
			</div>
		</div>

	</div>
	<?php $neonClass = ( $addon_data['field_type'] == 'text' || $addon_data['field_type'] == 'checkbox' || $addon_data['field_type'] == 'textarea' ) ? 'neon-hide' : ''; ?>

	<div class="neon-panel neonPanelOption <?=$neonClass?>" >

		<p class="neon-panel-option-heading">Option</p>
		<div class="neon-option-group neonOptionGroup">
			<?php 
				 $imgClass = ( $addon_data['field_type'] != 'radio-img' ) ? 'style="display:none;"' : '';

				if( !empty($addon_data['field_option']) ) {
					
					foreach( $addon_data['field_option'] as $option ) { 

						?>
						<div class="neon-option-field">
							<div class="exp-option-box">
								<input type="text" name="neon_option_label[]" value="<?=$option['label']?>" placeholder="Label" >
							</div>
							<div class="exp-option-box">
								<input type="text" name="neon_option_value[]" value="<?=$option['value']?>" placeholder="Value" >
							</div>
							<div class="exp-option-box">
								<input type="number" name="neon_option_price[]" value="<?=$option['price']?>" placeholder="Price" >
							</div>
							<div class="exp-option-box option-image" <?=$imgClass?> >
								<input type="file" class="neon_option_file" name="neon_option_file[]" accept='image/*' value="" >
								<input type="text" class="neon_option_img" name="neon_option_img[]" value="<?=$option['img']?>" >
							</div>
							<div class="input-group-btn"> 
				              	<button class="btnAdd" type="button">+</button>
					            <button class="btnRemove" type="button">??</button>
				            </div>
						</div>
			<?php 
					
					} 
				}else{
			?>
				<div class="neon-option-field">
					<div class="exp-option-box">
						<input type="text" name="neon_option_label[]" value="" placeholder="Label" >
					</div>
					<div class="exp-option-box">
						<input type="text" name="neon_option_value[]" value="" placeholder="Value" >
					</div>
					<div class="exp-option-box">
						<input type="number" name="neon_option_price[]" value="" placeholder="Price" >
					</div>
					<div class="exp-option-box option-image" <?=$imgClass?> >
						<input type="file" class="neon_option_file" name="neon_option_file[]" accept='image/*' value="" >
						<input type="text" class="neon_option_img" name="neon_option_img[]" value="" >
					</div>
					<div class="input-group-btn"> 
		              	<button class="btnAdd" type="button">+</button>
			            <button class="btnRemove" type="button">??</button>
		            </div>
				</div>
			<?php
				}
			?>
		</div>

	</div>
	<div class="neon-btn">
		<input class="neonFormSave" data-product-id="<?=$product_id?>" type="submit" name="neonSave" value="Save">
	</div>
</form>
<!-- repeater content starts -->
<div id="option-html" style="display:none;">
	<div class="neon-option-field">
		<div class="exp-option-box">
			<input type="text" name="neon_option_label[]" value="" placeholder="Label" >
		</div>
		<div class="exp-option-box">
			<input type="text" name="neon_option_value[]" value="" placeholder="Value" >
		</div>
		<div class="exp-option-box">
			<input type="number" name="neon_option_price[]" value="" placeholder="Price" >
		</div>
		<div class="exp-option-box option-image">
			<input type="file" class="neon_option_file" name="neon_option_file[]" accept='image/*' value="" >
			<input type="text" class="neon_option_img" name="neon_option_img[]" value="" >
		</div>
		<div class="input-group-btn"> 
	      	<button class="btnAdd" type="button">+</button>
	        <button class="btnRemove" type="button">??</button>
	    </div>
	</div>
</div>
<!-- repeater content ends -->