<?php

require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvRegisterHooksClass' ) ):
	class RdvRegisterHooksClass {

		public function register_activation() {
			$queriesClass = new RdvQueriesClass();
			$queriesClass->rdv_create_table_function();
			register_activation_hook( __FILE__, 'rdv_create_table_function' );
		}

		public function register_deactivation() {
			$queriesClass = new RdvQueriesClass();
			$queriesClass->rdv_drop_table_function();
			register_deactivation_hook( __FILE__, 'rdv_drop_table_function' );
		}

		public function register_uninstall() {
			$queriesClass = new RdvQueriesClass();
			$queriesClass->rdv_drop_table_function();
			register_uninstall_hook( __FILE__, 'rdv_drop_table_function' );
		}

	}
endif;