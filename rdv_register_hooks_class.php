<?php
require_once 'includes/managers/rdv_tables_manager.php';

if ( ! class_exists( 'RdvRegisterHooksClass' ) ):
	class RdvRegisterHooksClass {

		/**
		 * Used for initiate the class.
		 */
		public function __construct() {
			$this->register_activation();
			$this->register_deactivation();
			add_action( 'activate_plugin', array( $this, 'register_activation' ) );
			add_action( 'deactivate_plugin', array( $this, 'register_deactivation' ) );
		}

		/**
		 * Used for activation plugin actions.
		 */
		public function register_activation() {
			RdvTablesManager::createTableRendezVous();
			RdvTablesManager::createTableSettings();
			RdvTablesManager::createTableMessage();
		}

		/**
		 * Used for deactivation plugin actions.
		 */
		public function register_deactivation() {
			RdvTablesManager::dropTableRendezVous();
			RdvTablesManager::dropTableSettings();
			RdvTablesManager::dropTableMessages();
		}

//		/**
//		 * Used for uninstall plugin actions.
//		 */
//		public static function register_uninstall() {
//			RdvQueriesClass::rdv_drop_table_function();
//			register_uninstall_hook( __FILE__, array( 'RdvQueriesClass', 'rdv_drop_table_function' ) );
//		}
	}
endif;