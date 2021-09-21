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

new RdvOptionsClass();

add_action('init', array('RdvRegisterHooksClass', 'register_activation'));
add_action('deactivate_plugin', array('RdvRegisterHooksClass', 'register_deactivation'));

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