<?php
/**
 * Plugin Name: Mailtrain WordPress Gutenberg Block 
 * Plugin URI: https://github.com/p-w/mailtrain-wordpress-gutenberg-block
 * Description:  WordPress Gutenberg Block Subscription Form For Mailtrain (Self Hosted Newsletter App)
 * Author: PW
 * Author URI: https://github.com/p-w/
 * Version: 0.1
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package mailtrain-wordpress-gutenberg-block
 */

/**
 * Exit if accessed directly.
*/
defined( 'ABSPATH' ) || exit;


/**
 * Load all translations for our plugin from the MO file.
*/
add_action( 'init', 'mailtrain_wordpress_gutenberg_block_load_textdomain' );

function mailtrain_wordpress_gutenberg_block_load_textdomain() {
  load_plugin_textdomain( 'mailtrain-wordpress-gutenberg-block', false, basename( __DIR__ ) . '/languages' );
}


/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function mailtrain_wordpress_gutenberg_block_register_block() {
	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}

	wp_register_script(
		'mailtrain-wordpress-gutenberg-block',
		plugins_url( 'block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);

	register_block_type( 'mailtrain-wordpress-gutenberg-block/mailtrain-wordpress-gutenberg-block', array(
		'editor_script' => 'mailtrain-wordpress-gutenberg-block',
	) );

	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'mailtrain-wordpress-gutenberg-block', 'mailtrain-wordpress-gutenberg-block' );
	}
}
add_action( 'init', 'mailtrain_wordpress_gutenberg_block_register_block' );
