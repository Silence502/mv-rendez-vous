<?php
require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvActivator' ) ):
	class RdvActivator {

		/**
		 * Used for activation plugin actions.
		 */
		public static function activate() {
			RdvQueriesClass::rdv_create_table_message_function();
			RdvQueriesClass::rdv_create_table_function();
			RdvQueriesClass::rdv_create_table_email_function();
			RdvQueriesClass::rdv_create_table_settings_function();
			RdvQueriesClass::rdv_insert_settings();
		}
	}
endif;