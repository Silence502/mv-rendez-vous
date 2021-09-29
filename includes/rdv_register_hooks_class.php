<?php

require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvRegisterHooksClass' ) ):
	class RdvRegisterHooksClass {
		/**
		 * Used for activation plugin actions.
		 */
		public static function register_activation() {
			$queriesClass = new RdvQueriesClass();
			$queriesClass->rdv_create_table_function();
			register_activation_hook( __FILE__, 'rdv_create_table_function' );
		}

		/**
		 * Used for deactivation plugin actions.
		 */
		public static function register_deactivation() {
			$queriesClass = new RdvQueriesClass();
			$queriesClass->rdv_drop_table_function();
			register_deactivation_hook( __FILE__, 'rdv_drop_table_function' );
		}

		/**
		 * Used for uninstall plugin actions.
		 */
		public static function register_uninstall() {
			$queriesClass = new RdvQueriesClass();
			$queriesClass->rdv_drop_table_function();
			register_uninstall_hook( __FILE__, 'rdv_drop_table_function' );
		}
	}
endif;