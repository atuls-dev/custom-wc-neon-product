<?php
	$font_type = array( 
		array('name' => 'Robot', 'class' => 'i-robot'),
		array('name' => 'Qahiri', 'class' => 'i-qahiri'),
		array('name' => 'Zen Loop', 'class' => 'i-Zen-Loop'),
		array('name' => 'Anime Ace', 'class' => 'i-animac'),
		array('name' => 'LEMON MILK', 'class' => 'i-lemon'),
		array('name' => 'Billion Dreams', 'class' => 'i-billion'),
		array('name' => 'Beauty', 'class' => 'i-beauty'),
		array('name' => 'Birds of Paradise', 'class' => 'i-bird-Paradise'),
		array('name' => 'Candyful', 'class' => 'i-Candyful'),
		array('name' => 'Cheri Liney', 'class' => 'i-Cheri-Liney'),
		array('name' => 'Cheri', 'class' => 'i-Cheri'),
		array('name' => 'Lobster', 'class' => 'i-Lobster'),
		array('name' => 'Heaters', 'class' => 'i-Heaters'),
		array('name' => 'Peach', 'class' => 'i-Peach'),
		array('name' => 'glimmer of', 'class' => 'i-glimmer-of'),
		array('name' => 'Learning Curve', 'class' => 'i-Learning-Curve'),
		array('name' => 'Zen Tokyo Zoo', 'class' => 'i-zen-tokyo-zoo'),
		array('name' => 'Raleway', 'class' => 'i-Raleway'),
		array('name' => 'Uchen', 'class' => 'i-Uchen'),
		array('name' => 'WindSong', 'class' => 'i-WindSong'),
		array('name' => 'Palette', 'class' => 'i-Palette'),
		array('name' => 'MonteCarlo', 'class' => 'i-montecarlo'),
		array('name' => 'Dancing', 'class' => 'i-Dancing'),
		array('name' => 'Indie Flower', 'class' => 'i-Indie'),
		array('name' => 'Freckle Face', 'class' => 'i-freckle'),
		array('name' => 'Montez', 'class' => 'i-montez'),
		array('name' => 'Mansalva', 'class' => 'i-Mansalva'),
		array('name' => 'Macondo', 'class' => 'i-Macondo'),
		array('name' => 'Finger Paint', 'class' => 'i-finger-paint'),
		array('name' => 'Caveat', 'class' => 'i-caveat'),
		array('name' => 'Allison', 'class' => 'i-Allison'),
		array('name' => 'Architects', 'class' => 'i-Architects'),
		array('name' => 'Cookie', 'class' => 'i-Cookie'),
		array('name' => 'Ma Shan Zheng', 'class' => 'i-MaShanZhang'),
		array('name' => 'Pacifico', 'class' => 'i-Pacifico'),
		array('name' => 'Permanent Marker', 'class' => 'i-Permanent'),
		array('name' => 'Satisfy', 'class' => 'i-Satisfy'),
		array('name' => 'Great Vibes', 'class' => 'i-GreatVibes'),
		array('name' => 'Kaushan Script', 'class' => 'i-Kaushan'),
		array('name' => 'Barrio', 'class' => 'i-Barrio'),
		array('name' => 'Eater', 'class' => 'i-Eater'),
		array('name' => 'Fontdiner', 'class' => 'i-Fontdiner'),
		array('name' => 'Molle', 'class' => 'i-Molle'),
		array('name' => 'Mystery Quest', 'class' => 'i-MysteryQuest'),
		array('name' => 'Nosifer', 'class' => 'i-Nosifer'),
		
	);

	$font_type = apply_filters('neon_fonts',$font_type);

	$img_path =  plugin_dir_url( __FILE__ ).'/images/'; 
	$background_img = array( 
		$img_path.'background1.jpg',
		$img_path.'background2.jpg',
		$img_path.'background3.jpg',
		$img_path.'background4.jpg',
		$img_path.'background5.jpg',
		$img_path.'background6.jpg',
		$img_path.'background7.jpg',
		$img_path.'background8.jpg',
		$img_path.'background9.jpg',
		$img_path.'background10.jpg',
		$img_path.'background11.jpg',
		$img_path.'background12.jpg',
	);
	$background_img = apply_filters('background_img',$background_img);

 ?>
<div class="neon-options">
	<div class="options neon">
		<label class="option-label">Write Text For Your Neon? 
			<i class="fa fa-question-circle tooltip" aria-hidden="true">
			<span class="tooltiptext">Max 21 Letters Per Neon</span>
			</i>
		</label>
		<div class="option-box">
			<textarea id="neon_input_text" class="neon_option" name="neon_text" rows="2" maxlength="21" ></textarea>
		</div>
		<span class="neon_text_error"></span>
	</div>
	<div class="options neon font-choose">
		<label class="option-label">Choose the font of your choice
			<i class="fa fa-question-circle tooltip" aria-hidden="true">
			<span class="tooltiptext">Choose your font style of your choice</span>
			</i>
		</label>
		<div class="font-type-option">
			<?php foreach($font_type as $key => $font ) { ?>
				<span class="inp-text <?php echo $font['class']; ?>">
					<input id="font_type<?php echo $key; ?>" class="neon_option font-type" data-class="<?php echo $font['class']; ?>" type ="radio" name="font_type" value="<?php echo $font['name'] ?>">
					<label class="<?= $font['class']; ?>" for="font_type<?php echo $key; ?>" ><?php echo $font['name'] ?></label>
				</span>
			<?php } ?>

		</div>
	</div>
	<div class="options neon choice">
		<label class="option-label">Choose the color of your choice
			<i class="fa fa-question-circle tooltip" aria-hidden="true">
			<span class="tooltiptext">Choose your color of your choice</span>
			</i>
		</label>
		<div class="font-shadow-option">

			<input id="font_shadow_1" type ="radio" class="neon_option" name="font_shadow" value="Yellow Lemon" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(241, 233, 46) 0px 0px 20px, rgb(241, 233, 46) 0px 0px 30px, rgb(241, 233, 46) 0px 0px 40px, rgb(241, 233, 46) 0px 0px 55px, rgb(241, 233, 46) 0px 0px 75px">
			<label for="font_shadow_1"><i class="fas fa-bolt i-Yellow"></i><span>Yellow Lemon</span></label>

			<input id="font_shadow_2" type ="radio" class="neon_option" name="font_shadow" value="Orange" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(255, 95, 7) 0px 0px 20px, rgb(255, 95, 7) 0px 0px 30px, rgb(255, 95, 7) 0px 0px 40px, rgb(255, 95, 7) 0px 0px 55px, rgb(255, 95, 7) 0px 0px 75px">
			<label for="font_shadow_2"><i class="fas fa-bolt i-Orange"></i><span>Orange</span></label>

			<input id="font_shadow_3" type ="radio" class="neon_option" name="font_shadow" value="White cold" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(87, 116, 149) 0px 0px 20px, rgb(87, 116, 149) 0px 0px 30px, rgb(87, 116, 149) 0px 0px 40px, rgb(87, 116, 149) 0px 0px 55px, rgb(87, 116, 149) 0px 0px 75px">
			<label for="font_shadow_3"><i class="fas fa-bolt i-cold"></i><span>White cold</span></label>

			<input id="font_shadow_4" type ="radio" class="neon_option" name="font_shadow" value="White hot" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(252, 228, 180) 0px 0px 20px, rgb(252, 228, 180) 0px 0px 30px, rgb(252, 228, 180) 0px 0px 40px, rgb(252, 228, 180) 0px 0px 55px, rgb(252, 228, 180) 0px 0px 75px">
			<label for="font_shadow_4"><i class="fas fa-bolt i-hot"></i><span>White hot</span></label>

			<input id="font_shadow_5" type ="radio" class="neon_option" name="font_shadow" value="Vert" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(3, 220, 115) 0px 0px 20px, rgb(3, 220, 115) 0px 0px 30px, rgb(3, 220, 115) 0px 0px 40px, rgb(3, 220, 115) 0px 0px 55px, rgb(3, 220, 115) 0px 0px 75px">
			<label for="font_shadow_5"><i class="fas fa-bolt i-vert"></i><span>Vert</span></label>
			
			<input id="font_shadow_6" type ="radio" class="neon_option" name="font_shadow" value="Light green" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(100, 233, 211) 0px 0px 20px, rgb(100, 233, 211) 0px 0px 30px, rgb(100, 233, 211) 0px 0px 40px, rgb(100, 233, 211) 0px 0px 55px, rgb(100, 233, 211) 0px 0px 75px">
			<label for="font_shadow_6"><i class="fas fa-bolt i-green"></i><span>Light green</span></label>

			<input id="font_shadow_7" type ="radio" class="neon_option" name="font_shadow" value="Rouge" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(236, 41, 45) 0px 0px 20px, rgb(236, 41, 45) 0px 0px 30px, rgb(236, 41, 45) 0px 0px 40px, rgb(236, 41, 45) 0px 0px 55px, rgb(236, 41, 45) 0px 0px 75px">
			<label for="font_shadow_7" ><i class="fas fa-bolt i-rough"></i><span>Rouge</span></label>

			<input id="font_shadow_8" type ="radio" class="neon_option" name="font_shadow" value="Blue" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(31, 83, 201) 0px 0px 20px, rgb(31, 83, 201) 0px 0px 30px, rgb(31, 83, 201) 0px 0px 40px, rgb(31, 83, 201) 0px 0px 55px, rgb(31, 83, 201) 0px 0px 75px">
			<label for="font_shadow_8" ><i class="fas fa-bolt i-blue"></i><span>Blue</span></label>

			<input id="font_shadow_9" type ="radio" class="neon_option" name="font_shadow" value="Ice Blue" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(39, 167, 192) 0px 0px 20px, rgb(39, 167, 192) 0px 0px 30px, rgb(39, 167, 192) 0px 0px 40px, rgb(39, 167, 192) 0px 0px 55px, rgb(39, 167, 192) 0px 0px 75px">
			<label for="font_shadow_9" ><i class="fas fa-bolt i-ice-blue"></i><span>Ice Blue</span></label>

			<input id="font_shadow_10" type ="radio" class="neon_option" name="font_shadow" value="Violet" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(157, 97, 211) 0px 0px 20px, rgb(157, 97, 211) 0px 0px 30px, rgb(157, 97, 211) 0px 0px 40px, rgb(157, 97, 211) 0px 0px 55px, rgb(157, 97, 211) 0px 0px 75px">
			<label for="font_shadow_10" ><i class="fas fa-bolt i-violet"></i><span>Violet</span></label>

			<input id="font_shadow_11" type ="radio" class="neon_option" name="font_shadow" value="Candy pink" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(247, 72, 167) 0px 0px 20px, rgb(247, 72, 167) 0px 0px 30px, rgb(247, 72, 167) 0px 0px 40px, rgb(247, 72, 167) 0px 0px 55px, rgb(247, 72, 167) 0px 0px 75px">
			<label for="font_shadow_11" ><i class="fas fa-bolt i-candy-pink"></i><span>Candy pink</span></label>

			<input id="font_shadow_12" type ="radio" class="neon_option" name="font_shadow" value="Pink white" data-shadow="white 0px 0px 5px, white 0px 0px 10px, rgb(235, 30, 204) 0px 0px 20px, rgb(235, 30, 204) 0px 0px 30px, rgb(235, 30, 204) 0px 0px 40px, rgb(235, 30, 204) 0px 0px 55px, rgb(235, 30, 204) 0px 0px 75px">
			<label for="font_shadow_12" ><i class="fas fa-bolt i-pink-white"></i><span>Pink white</span></label>

		</div>
	</div>

	<div class="options neon">
		<label class="option-label">Preview Background
			<i class="fa fa-question-circle tooltip" aria-hidden="true">
			<span class="tooltiptext">Choose the background for the preview image</span>
			</i>
		</label>
		<div class="options-box background-part">
			

			<div class="bg_section">
				<?php
				if( !empty($background_img) ){ 
					foreach($background_img as $img) { ?>
				<div class="bg-img">
					<img class="bg_change" src="<?=$img?>" />
				</div>
				<?php } 
				}  ?>
			</div>
		</div>
	</div>

	<!-- <div><img class="bg_custom_image" width="100px" src="<?=$img_path?>default-image-620x600.jpg" /></div>
	<input type="file" id="bg_image" name='bg_image' accept='image/*'> -->

	<?php $neon_size = json_decode( get_post_meta( $product->get_id(), 'neon_size', true ), true ); ?>
	<div class="options neon size-part">
		<label class="option-label">Cut
		</label>
		<div class="cut-option-box">
			<?php foreach($neon_size as $key => $val) { ?>
				<input id="size-<?=$key?>" type="radio" class="neon_option" data-price="<?=$val['price']?>" name="cut" value="S">
			<label for="size-<?=$key?>">
				<span class="button"><?=strtoupper($key)?></span>
				<p>Length: <?=$val['length']?></p>
				<p>Possible height: <?=$val['height']?></p>
			</label>

			<?php } ?>
			
		</div>
	</div>

	<!-- <?php $neon_support = json_decode( get_post_meta( $product->get_id(), 'neon_support', true ), true ); ?>
	<div class="options neon Support-part">
		<label class="option-label">Choose Your Backing
			<i class="fa fa-question-circle tooltip" aria-hidden="true">
			<span class="tooltiptext">Choose the style you want your acrylic backing</span>
			</i>
		</label>
		<div class="support-option-box">
			<input id="support-1" type ="radio" class="neon_option" name="support" data-price="<?=$neon_support['rectangle']?>" value="Rectangle">
			<label for="support-1"><img src="<?php echo plugin_dir_url( __FILE__ ).'/images/'; ?>rectangle.jpg" alt="Rectangle cut" width="80px" height="60px" style="border-radius:1px;border:1px solid black;"/>Rectangle</label>

			<input id="support-2" type ="radio" class="neon_option" name="support" data-price="<?=$neon_support['cut_out_around']?>" value="Cut out around the letters">
			<label for="support-2"><img src="<?php echo plugin_dir_url( __FILE__ ).'/images/'; ?>cut-to-text.jpg" alt="Rectangle cut" width="80px" height="60px" style="border-radius:1px;border:1px solid black;"/>Cut out around the letters 
			</label>

			<input id="support-3" type ="radio" class="neon_option" name="support" data-price="<?=$neon_support['acrylic_box']?>" value="Acrylic box">
			<label for="support-3"><img src="<?php echo plugin_dir_url( __FILE__ ).'/images/'; ?>box-acrilique-new.jpg" alt="Rectangle cut" width="80px" height="60px" style="border-radius:1px;border:1px solid black;"/>
			Acrylic box</label>
		</div>
	</div> -->

	<?php $neon_addon_data = get_post_meta( $product->get_id(), 'neon_addon_data', true ); 

		if( $neon_addon_data ) {

			foreach( $neon_addon_data as $key => $addon) {

				if( $addon['field_type'] == 'radio' ) {
	?>
				<div class="options neon Interior-part">
					<label class="option-label"><?php echo strtoupper($addon['addon_label']); ?>
						<i class="fa fa-question-circle tooltip" aria-hidden="true">
						<span class="tooltiptext"><?=$addon['addon_desc']?></span>
						</i>
					</label>
					<div class="option-box">
						<?php foreach( $addon['field_option'] as $oKey => $opt ) {  ?>
							<input id="<?php echo 'opt_'.$key.$oKey;?>" class="neon_option neonCustomAddon" type="radio" name="neon_addon[<?=$addon['addon_name']?>]" data-price="<?= $opt['price']?>" value="<?= $opt['value']?>" >
							<label for="<?php echo 'opt_'.$key.$oKey;?>" > <?= $opt['label']?></label><br>

						<?php } ?>
					</div>
				</div>

		<?php } else if( $addon['field_type'] == 'checkbox-group' ) { ?>
				
			<div class="options neon Access-part">
				<label class="option-label"><?php echo strtoupper($addon['addon_label']); ?>
					<i class="fa fa-question-circle tooltip" aria-hidden="true">
						<span class="tooltiptext"><?=$addon['addon_desc']?></span>
					</i>
				</label>
				<div class="option-box">
					<?php foreach( $addon['field_option'] as $oKey => $opt ) {  ?>
					<input id="<?php echo 'opt_'.$key.$oKey;?>" class="neon_option neonCustomAddon " type="checkbox" name="neon_addon[<?=$addon['addon_name']?>][]" data-price="<?=$opt['price']?>" value="<?= $opt['value']?>" >
					<label for="<?php echo 'opt_'.$key.$oKey;?>" ><?= $opt['label']?></label><br>
					<?php } ?>
				</div>
			</div>

		<?php } else if( $addon['field_type'] == 'radio-img' ) { ?>

			<div class="options neon Support-part">
				<label class="option-label"><?php echo strtoupper($addon['addon_label']); ?>
					<i class="fa fa-question-circle tooltip" aria-hidden="true">
					<span class="tooltiptext"><?=$addon['addon_desc']?></span>
					</i>
				</label>
				<div class="support-option-box">
					<?php foreach( $addon['field_option'] as $oKey => $opt ) {  ?>
					<input id="<?php echo 'opt_'.$key.$oKey;?>" type ="radio" class="neon_option neonCustomAddon" name="neon_addon[<?=$addon['addon_name']?>][]" data-price="<?=$opt['price']?>" value="<?= $opt['value']?>" >
					<label for="<?php echo 'opt_'.$key.$oKey;?>">
						<?php if ($opt['img']) { ?>
							<img src="<?= $opt['img'] ?>" alt="image not found..." width="80px" height="60px" style="border-radius:1px;border:1px solid black;"/> 
						<?php } ?>
						<?= ucfirst($opt['label'])?></label>
					<?php } ?>
				</div>
			</div>

		<?php  }else if( $addon['field_type'] == 'select' ) { ?>

				<div class="options neon media-part">
					<label class="option-label"><?php echo strtoupper($addon['addon_label']); ?>
						<i class="fa fa-question-circle tooltip" aria-hidden="true">
						<span class="tooltiptext"><?=$addon['addon_desc']?></span>
						</i>
					</label>
					<div class="option-box">
						<select class="neon_option neonCustomAddon" name="neon_addon[<?=$addon['addon_name']?>]">
						  <?php foreach( $addon['field_option'] as $oKey => $opt ) {  ?>
							<option value="<?= $opt['value']?>" data-price="<?=$opt['price']?>"><?= $opt['label']?></option>
					      <?php } ?>
						</select>
					</div>
				</div>

		<?php 	}else if( $addon['field_type'] == 'textarea' ){ ?>

				<div class="options neon comment-part">
					<label class="option-label"><?php echo strtoupper($addon['addon_label']); ?>
						<i class="fa fa-question-circle tooltip" aria-hidden="true">
						<span class="tooltiptext"><?=$addon['addon_desc']?></span>
						</i>
					</label>
					<textarea name="neon_addon[<?=$addon['addon_name']?>]" placeholder="<?=$addon['addon_place']?>"></textarea>
				</div>
		<?php   }else{ ?>
				<div class="options neon text-comment">
					<label class="option-label"><?php echo strtoupper($addon['addon_label']); ?>
						<i class="fa fa-question-circle tooltip" aria-hidden="true">
						<span class="tooltiptext"><?=$addon['addon_desc']?></span>
						</i>
					</label>
					<input type="text" name="neon_addon[<?=$addon['addon_name']?>]" placeholder="<?=$addon['addon_place']?>">
				</div>
		<?php  } 
			}
		}
	?>

	<?php $neon_custom_design = get_post_meta( $product->get_id(), 'neon_custom_design', true ); 
		if($neon_custom_design) { ?>
	<div class="options neon comment-part">
		<label class="option-label">Upload Custom Design
			<i class="fa fa-question-circle tooltip" aria-hidden="true">
			<span class="tooltiptext">Upload your custom design</span>
			</i>
		</label>
		
		<input type="file" id="custom_design" name='custom_design' accept='image/*'>
			
	</div>
	<?php } ?>

	<div class="options neon comment-part">
		<label class="option-label">COMMENTS</label>
		<textarea name="comments" placeholder="Location of the cable, deadline, ... Have your say!"></textarea>
	</div>
	<?php $price_per_character = get_post_meta( $product->get_id(), 'neon_price_per_character', true ); ?>
	<input type="hidden" id="price_per_character" name="price_per_character" value="<?=$price_per_character?>" >
	<?php $custom_design_product_price = get_post_meta( $product->get_id(), 'custom_design_product_price', true ); ?>
	<input type="hidden" id="custom_design_product_price" name="custom_design_product_price" value="<?=$custom_design_product_price?>" >
	<input type="hidden" id="base_price" name="base_price" value="<?=$product->get_price()?>" >
	<input type="hidden" id="product_price" name="product_price" value="" >
	<input type="hidden" id="product_image" name="product_image" value="" >

	<!-- The Modal -->
	<div id="myPrevModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
	    <span class="close">&times;</span>
	    <p><img id="previewProImg" src="<?php echo plugin_dir_url( __FILE__ ).'/images/'; ?>background1.jpg"></p>
	  </div>

	</div>

</div> <!-- .neon-options ends -->