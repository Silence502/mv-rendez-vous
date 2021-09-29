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
require_once 'includes/rdv_shortcode_class.php';

if ( ! class_exists( 'MvRendezVous' ) ):
	class MvRendezVous {
		public static function init() {
			new RdvOptionsClass();
			add_action( 'init', array( 'RdvRegisterHooksClass', 'register_activation' ) );
			add_action( 'deactivate_plugin', array( 'RdvRegisterHooksClass', 'register_deactivation' ) );
			add_action( 'admin_enqueue_scripts', 'load_ressources' );
		}

		public static function load_shortcode() {
			add_shortcode( 'rdv_form_shortcode', array( 'RdvShortCode', 'rdv_shortcode' ) );
		}
	}
endif;

function load_ressources() {
	if ( ! defined( 'PLUGIN_URL' ) ) {
		define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}

	wp_register_style( 'admin_form_style.css', PLUGIN_URL . 'admin/css/admin_form_style.css' );
	wp_enqueue_style( 'admin_form_style.css' );

	wp_register_script( 'rdv_options_class_js.js', PLUGIN_URL . 'admin/js/rdv_options_class_js.js' );
	wp_enqueue_script( 'rdv_options_class_js.js' );
}

MvRendezVous::init();
MvRendezVous::load_shortcode();