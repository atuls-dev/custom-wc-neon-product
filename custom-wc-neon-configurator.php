<?php
/**
 * Plugin Name: Custom Woocommerce Neon Configurator
 * Description: Custom JavaScript configurator product for WooCommerce website.
 * Version: 1.0.0
 * Author: Atul
**/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


function neon_plugin_path() {
         return untrailingslashit( plugin_dir_path( __FILE__ ) );
}
function neon_locate_wc_template( $template, $template_name, $template_path ) {
    global $woocommerce;
    $_template = $template;
    if ( ! $template_path ) $template_path = $woocommerce->template_url;

    $plugin_path  = neon_plugin_path() . '/woocommerce/';
    $template = locate_template(

        array(
            $template_path . $template_name,
            $template_name
        )
    );
    // Modification: Get the template from this plugin, if it exists
    if ( ! $template && file_exists( $plugin_path . $template_name ) )
        $template = $plugin_path . $template_name;
    if ( ! $template )
        $template = $_template;
    //echo $template;
    return $template;
}

//add_filter( 'woocommerce_locate_template', 'neon_locate_wc_template', 99, 3 );
add_filter( 'wc_get_template', 'neon_locate_wc_template', 99, 3 );



/**
 * Backend related functionality
 */
require_once( plugin_dir_path( __FILE__ ) . 'admin/backend.php' );

/**
 * frontend related functionality
 */
require_once( plugin_dir_path( __FILE__ ) . 'admin/frontend.php' );

