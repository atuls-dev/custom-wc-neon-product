<?php
	
	add_meta_box(

			'image_uploader_metabox', // Unique ID of metabox

			esc_html__('Image Uploader Metabox', 'textdomain'), //Title of metabox

			'image_uploader_metaboxes', // Callback function

			'post', //name of your custom post type (here post is for wordpress posts.)

			'normal', //Context

			'default' //Priority

		);
	
	function add_image_uploader_metabox()

	{	

		add_meta_box(

			'image_uploader_metabox', // Unique ID of metabox

			esc_html__('Image Uploader Metabox', 'textdomain'), //Title of metabox

			'image_uploader_metaboxes', // Callback function

			'post', //name of your custom post type (here post is for wordpress posts.)

			'normal', //Context

			'default' //Priority

		);

	}



     
    //Generate the HTML for uploader links

    function image_uploader_metaboxes($object, $box)

    {

    	wp_nonce_field ( basename ( __FILE__ ), 'image_uploader_metaboxes' );

     

    	global $post;

     

    	// Get WordPress' media upload URL

    	$upload_link = esc_url( get_upload_iframe_src() );

     

    	// See if there's a media id already saved as post meta

    	$your_img_id = get_post_meta( get_the_ID(), '_your_img_id', true );

     

    	// Get the image src

    	$your_img_src = wp_get_attachment_image_src( $your_img_id, 'full' );

     

    	// For convenience, see if the array is valid

    	$you_have_img = is_array( $your_img_src );

     

     

    ?>

    	<div id="custom-images">

     

    		<div class="custom-img-container">

     

    			<?php 

    				$meta_values = get_post_meta( get_the_ID(), 'image_src', false );

     

    				foreach ($meta_values as $value){

    			?>

     

     

    				<div class="image-wrapper">

    					<input type="text" name="image_src[]" value="<?php echo $value;?>">

    					<a class="delete-custom-img" href="#">Remove this image</a>

    				</div>

     

    			<?php }?>

     

    		</div>

     

    	</div>

     

    	<p>

     

    	    <a class="upload-custom-img <?php if ( $you_have_img  ) { echo 'hidden'; } ?>" href="<?php echo $upload_link; ?>">

    	        <?php _e('Add custom image'); ?>

    		</a>

     

    	</p>

    <?php }  /*<!-- End image_uploader_metaboxes Function -->*/



    //Save Metadata

 

function save_image_uploader_metadata( $post_id, $post )

{

 

	/* Verify the nonce before proceeding. */

		if ( !isset( $_POST['image_uploader_metaboxes'] ) || !wp_verify_nonce( $_POST['image_uploader_metaboxes'], basename( __FILE__ ) ) )

			return $post_id;

 

	/* Get the post type object. */

		$post_type = get_post_type_object( $post->post_type );

 

	/* Check if the current user has permission to edit the post. */

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )

			return $post_id;

 

	/* Get the meta key. */

		$meta_key = 'image_src';

 

	/* Get the meta value of the custom field key. */

		$meta_value = get_post_meta( $post_id, $meta_key, false );

 

	/* For looping all meta values */

		foreach ($meta_value as $value){

			delete_post_meta( $post_id, $meta_key, $value );

		}

 

	/* Get the posted data and sanitize it for use as an HTML class. */

		foreach($_POST['image_src'] as $value){	

			add_post_meta( $post_id, $meta_key, $value, false );

		}

 

}

	//For Custom Image Uploader

 

	function enqueue_media(){

		wp_enqueue_media();

	}


	//JavaScript Code for opening uploader and copying the link of the uploaded image to a textbox

 

function include_js_code_for_uploader(){

?>

 

<!-- ****** JS CODE ******  -->

<script>

	jQuery(function($){

 

	  // Set all variables to be used in scope

	  var frame,

		  metaBox = $('#image_uploader_metabox.postbox'); // Your meta box id here

		  addImgLink = metaBox.find('.upload-custom-img');

		  imgContainer = metaBox.find( '.custom-img-container');

		  imgIdInput = metaBox.find( '.custom-img-id' );

		  customImgDiv = metaBox.find( '#custom-images' );

 

 

 

	  // ADD IMAGE LINK

	  addImgLink.on( 'click', function( event ){

 

		event.preventDefault();

 

		// If the media frame already exists, reopen it.

		if ( frame ) {

		  frame.open();

		  return;

		}

 

		// Create a new media frame

		frame = wp.media({

		  title: 'Select or Upload Media Of Your Chosen Persuasion',

		  button: {

			text: 'Use this media'

		  },

		  multiple: false  // Set to true to allow multiple files to be selected

		});

 

 

		// When an image is selected in the media frame...

		frame.on( 'select', function() {

 

		  // Get media attachment details from the frame state

		  var attachment = frame.state().get('selection').first().toJSON();

 

		  // Send the attachment URL to our custom image input field.

		  imgContainer.append( '<div class="image-wrapper"><input type="text" name="image_src[]" value="'+attachment.url+'"> <a class="delete-custom-img" href="#">Remove this image</a></div>' );

 

		});

 

		// Finally, open the modal on click

		frame.open();

	  });

 

 

		customImgDiv.on ( 'click', '.delete-custom-img', function (event){		

			event.preventDefault();

			jQuery(event.target).parent().remove();		

 

		});

 

 

	});

 

</script>

 

<?php }



add_action ( 'admin_enqueue_scripts', 'enqueue_media' );

add_action( 'admin_head', 'include_js_code_for_uploader' );

add_action( 'add_meta_boxes', 'add_image_uploader_metabox' );

add_action( 'save_post', 'save_image_uploader_metadata', 10, 2 );

?>