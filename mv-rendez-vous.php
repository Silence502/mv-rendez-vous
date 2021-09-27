<?php
/**
 * Plugin Name:       MV Rendez-vous
 * Description:       Module de prise de rendez-vous.
 * Version:           1.0.0
 * Author:            Mickael VIDAL
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

require_once 'includes/rdv_options_class.php';
require_once 'includes/rdv_register_hooks_class.php';
require_once 'includes/rdv_queries_class.php';
require_once 'includes/rdv_validation_class.php';

$rdvOption = new RdvOptionsClass();

add_action('init', array('RdvRegisterHooksClass', 'register_activation'));
add_action('deactivate_plugin', array('RdvRegisterHooksClass', 'register_deactivation'));


add_action('admin_enqueue_scripts', 'load_ressources');

function load_ressources() {
	if (!defined('PLUGIN_URL')){
		define('PLUGIN_URL', plugin_dir_url(__FILE__));
	}

	wp_register_style('admin_form_style.css', PLUGIN_URL .'admin/css/admin_form_style.css');
	wp_enqueue_style('admin_form_style.css');

	wp_register_script('rdv_options_class_js.js', PLUGIN_URL . 'admin/js/rdv_options_class_js.js');
	wp_enqueue_script('rdv_options_class_js.js');
}


add_shortcode( 'rdv_form_shortcode', 'rdv_shortcode' );

/**
 * @return false|string
 * Add a new shortcode to insert the form.
 */
function rdv_shortcode() {
	ob_start();
	$validation = new RdvValidationClass();
	$validation->rdv_submit_function();

	return ob_get_clean();
}