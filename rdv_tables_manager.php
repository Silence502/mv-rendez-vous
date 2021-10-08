<?php
require_once 'includes/dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvTablesManager' ) ):
	class RdvTablesManager {
		/**
		 * Used for get create query : rendez-vous table.
		 */
		public static function createTableRendezVous() {
			global $rdvDAO;
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_create_table_function();
		}

		/**
		 * Used for get create query : settings and message tables.
		 */
		public static function createTableSettings() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_create_table_settings_function();
			$rdvSettingsDAO->rdv_create_table_message_function();
		}

		/**
		 * Used for get drop query : rendez-vous table.
		 */
		public static function dropTableRendezVous() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvSettingsDAO->rdv_drop_table_function();
		}

		/**
		 * Used for get drop query : settings tables.
		 */
		public static function dropTableSettings() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_drop_table_settings_function();
		}


	}
endif;