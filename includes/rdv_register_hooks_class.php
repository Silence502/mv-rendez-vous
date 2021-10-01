<?php

require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvRegisterHooksClass' ) ):
	class RdvRegisterHooksClass {
		/**
		 * Used for activation plugin actions.
		 */
		public static function register_activation() {
			RdvQueriesClass::rdv_create_table_message_function();
			RdvQueriesClass::rdv_create_table_function();
			RdvQueriesClass::rdv_create_table_email_function();
			register_activation_hook( __FILE__, array( 'RdvQueriesClass', 'rdv_create_table_function' ) );
			register_activation_hook( __FILE__, array( 'RdvQueriesClass', 'rdv_create_table_message_function' ) );
			register_activation_hook( __FILE__, array( 'RdvQueriesClass', 'rdv_create_table_email_function' ) );
		}

		/**
		 * Used for deactivation plugin actions.
		 */
		public static function register_deactivation() {
			RdvQueriesClass::rdv_drop_table_function();
			register_deactivation_hook( __FILE__, array( 'RdvQueriesClass', 'rdv_drop_table_function' ) );
		}

		/**
		 * Used for uninstall plugin actions.
		 */
		public static function register_uninstall() {
			RdvQueriesClass::rdv_drop_table_function();
			register_uninstall_hook( __FILE__, array( 'RdvQueriesClass', 'rdv_drop_table_function' ) );
		}
	}
endif;