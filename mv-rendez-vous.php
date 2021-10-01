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

require_once 'includes/rdv_management_class.php';
require_once 'includes/rdv_register_hooks_class.php';
require_once 'includes/rdv_queries_class.php';
require_once 'includes/rdv_validation_class.php';
require_once 'includes/rdv_shortcode_class.php';
require_once 'includes/rdv_settings_class.php';

if ( ! class_exists( 'MvRendezVous' ) ):
	class MvRendezVous {
		/**
		 * Used for initiate the plugin first actions.
		 */
		public static function init() {
			add_action( 'admin_menu', array( 'RdvManagementClass', 'rdv_management_page' ) );
			add_action( 'admin_menu', array( 'RdvSettingsClass', 'rdv_submenu_page' ) );
			add_action( 'init', array( 'RdvRegisterHooksClass', 'register_activation' ) );
			add_action( 'deactivate_plugin', array( 'RdvRegisterHooksClass', 'register_deactivation' ) );
			add_action( 'admin_enqueue_scripts', array( 'MvRendezVous', 'load_ressources' ) );
		}

		/**
		 * Used for load ressources files.
		 */
		public static function load_ressources() {
			if ( ! defined( 'PLUGIN_URL' ) ) {
				define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			wp_register_style( 'admin_form_style.css', PLUGIN_URL . 'admin/css/admin_form_style.css' );
			wp_enqueue_style( 'admin_form_style.css' );

			wp_register_script( 'rdv_options_class_js.js', PLUGIN_URL . 'admin/js/rdv_options_class_js.js' );
			wp_enqueue_script( 'rdv_options_class_js.js' );
		}

		/**
		 * Used for load shortcode for the form.
		 */
		public static function load_shortcode() {
			add_shortcode( 'rdv_form_shortcode', array( 'RdvShortCode', 'rdv_shortcode' ) );
		}
	}
endif;

MvRendezVous::init();
MvRendezVous::load_ressources();
MvRendezVous::load_shortcode();
