<?php
/**
 * @package MVRendezVous
 * Plugin Name:       MV Rendez-vous
 * Description:       Module de prise de rendez-vous.
 * Version:           1.1.0
 * Author:            Mickael VIDAL
 * License:           GPL v2 or later
 * Text Domain:       MV Rendez-vous
 * Domain Path:       /languages
 */

require_once 'rdv_management_class.php';
require_once 'rdv_register_hooks_class.php';
require_once 'includes/rdv_validation_class.php';
require_once 'rdv_shortcode_class.php';
require_once 'rdv_settings_class.php';

add_action( 'admin_menu', array( 'RdvManagementClass', 'rdv_management_page' ) );
add_action( 'admin_menu', array( 'RdvSettingsClass', 'rdv_submenu_page' ) );
add_action( 'admin_enqueue_scripts', 'load_ressources' );
add_shortcode( 'rdv_form_shortcode', array( 'RdvShortCode', 'rdv_shortcode' ) );

/**
 * Used for run certain processes at the activation.
 */
function activate_mv_rendezvous() {
	$activation = new RdvRegisterHooksClass();
	$activation->register_activation();
}

/**
 * Used for shutdown certain processes at deactivation.
 */
function deactivate_mv_rendezvous() {
	$deactivation = new RdvRegisterHooksClass();
	$deactivation->register_deactivation();
}

register_activation_hook( __FILE__, 'activate_mv_rendezvous' );
register_deactivation_hook( __FILE__, 'deactivate_mv_rendezvous' );

/**
 * Used for load ressources files.
 */
function load_ressources() {
	if ( ! defined( 'PLUGIN_URL' ) ) {
		define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}

	wp_register_style( 'admin_form_style.css', PLUGIN_URL . 'admin/css/admin_form_style.css' );
	wp_enqueue_style( 'admin_form_style.css' );
}