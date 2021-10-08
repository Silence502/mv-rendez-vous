<?php
require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvDeactivator' ) ):
	class RdvDeactivator {

		/**
		 * Used for deactivation plugin actions.
		 */
		public static function deactivate() {
			RdvQueriesClass::rdv_drop_table_function();
		}
	}
endif;