<?php foreach( $neon_addon_data as $addon_id => $val ) { ?>
	<tr id="field_<?=$addon_id?>"  data-product-id="<?=$product_id?>" data-id="<?=$addon_id?>" >
		<td>
			<div class="neonAddonSort"></div>
			<?=$val['addon_label']?>
		</td>
		<td>
			<span><?=$val['addon_name']?></span>
		</td>	
		<td>
			<?php
					$edit_url = add_query_arg( array(
				    'action'     => 'edit_addon_modal_box',
				    'product_id'  => $product_id,
				    'addon_id'  => $addon_id,
				    'TB_iframe' => 'true',
				    'width'     => '600',
				    'height'    => '400',
				), admin_url( 'admin.php' ) );

			?>

			<a href="<?=$edit_url?>" class="button button-primary thickbox"><?= __( 'Edit', 'neon' )?></a>
	        <button class="btnAddonRemove" data-product-id="<?=$product_id?>" data-id="<?=$addon_id?>"  type="button">×</button>
		</td>
</tr>
	
<?php } ?>