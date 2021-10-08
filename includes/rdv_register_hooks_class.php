<?php

if ( ! class_exists( 'RdvRegisterHooksClass' ) ):
	class RdvRegisterHooksClass {

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
//			RdvQueriesClass::rdv_create_table_message_function();
//			RdvQueriesClass::rdv_create_table_function();
			RdvTablesManager::createTableRendezVous();
//			RdvQueriesClass::rdv_create_table_email_function();
//			RdvQueriesClass::rdv_create_table_settings_function();
			RdvTablesManager::createTableSettings();
		}

		/**
		 * Used for deactivation plugin actions.
		 */
		public function register_deactivation() {
//			RdvQueriesClass::rdv_drop_table_function();
			RdvTablesManager::dropTableRendezVous();
			RdvTablesManager::dropTableSettings();
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