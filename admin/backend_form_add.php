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
	<div class="neon-form-heading"> Add New AddOn</div>
	<div class="neon-field-panel">
		<div class="form-field">
			<div class="input-label">
				<label>Field Type</label>
			</div>
			<div class="input-field">
				<select id="addonFieldType" name="addon_field_type">
					<option value="text">Text</option>
					<option value="select">Select</option>
				<!--     <option value="checkbox">Checkbox</option> -->
					<option value="checkbox-group">Checkbox group</option>
					<option value="radio">Radio</option>
					<option value="radio-img">Image-Radio</option>
					<option value="textarea">Textarea</option>
				</select>
			</div>
		</div>
		<div class="form-field">
			<div class="input-label">
				<label>Name*</label>
				<span class="name-error"></span>
			</div>
			<div class="input-field">
				<input type="text" name="addon_name" value="" required>
			</div>
			

		</div>
		<div class="form-field">
			<div class="input-label">
				<label>Label*</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_label" value="" required>
			</div>
		</div>
		<div class="form-field">
			<div class="input-label">
				<label>Description</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_desc" value="" >
			</div>
		</div>
		<div class="form-field form-placeholder">
			<div class="input-label">
				<label>Placeholder</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_place" value="" >
			</div>
		</div>
		<div class="form-field form-field-extra neon-hide">
			<div class="input-label">
				<label>Value</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_value" value="" >
			</div>
		</div>
		<div class="form-field form-field-extra neon-hide">
			<div class="input-label">
				<label>Price</label>
			</div>
			<div class="input-field">
				<input type="text" name="addon_price" value="" >
			</div>
		</div>

	</div>
	<div class="neon-panel neonPanelOption" style="display:none;" >
		<p class="neon-panel-option-heading">Option</p>
		<div class="neon-option-group neonOptionGroup">
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
		            <button class="btnRemove" type="button">×</button>
	            </div>
			</div>
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
	        <button class="btnRemove" type="button">×</button>
	    </div>
	</div>
</div>
<!-- repeater content ends -->