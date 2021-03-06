<?php
require_once plugin_dir_path( __DIR__ ) . 'dal/rdv_queries_class.php';
require_once plugin_dir_path( __DIR__ ) . 'dal/rdv_queries_settings_class.php';
require_once plugin_dir_path( __DIR__ ) . 'dal/rdv_queries_message_class.php';

if ( ! class_exists( 'RdvDAOFactory' ) ):
	abstract class RdvDAOFactory {

		/**
		 * @return RdvQueriesClass
		 * Used for getting RdvQueriesClass queries.
		 */
		public static function getRdvQueriesClass(): RdvQueriesClass {
			require_once 'rdv_queries_class.php';

			return new RdvQueriesClass();
		}

		/**
		 * @return RdvQueriesSettingsClass
		 * Used for getting RdvQueriesSettingsClass queries.
		 */
		public static function getRdvQueriesSettingsClass(): RdvQueriesSettingsClass {
			require_once 'rdv_queries_settings_class.php';

			return new RdvQueriesSettingsClass();
		}

		/**
		 * @return RdvQueriesMessageClass
		 * Used for getting RdvQueriesMessageClass queries.
		 */
		public static function getRdvQueriesMessageClass(): RdvQueriesMessageClass {
			require_once 'rdv_queries_message_class.php';

			return new RdvQueriesMessageClass();
		}
	}
endif;