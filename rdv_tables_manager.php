<?php
require_once 'includes/dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvTablesManager' ) ):
	class RdvTablesManager {
		/**
		 * Used for get create query : rendez-vous table.
		 */
		public static function createTableRendezVous() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_create_table_function();
		}

		/**
		 * Used for get create query : settings table.
		 */
		public static function createTableSettings() {
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_create_table_settings_function();
		}

		/**
		 * Used for get create query : message table.
		 */
		public static function createTableMessage() {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();
			$rdvMessageDAO->rdv_create_table_message_function();
		}

		/**
		 * Used for get drop query : rendez-vous table.
		 */
		public static function dropTableRendezVous() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_drop_table_function();
		}

		/**
		 * Used for get drop query : settings table.
		 */
		public static function dropTableSettings() {
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_drop_table_settings_function();
		}

		/**
		 * Used for get drop query : settings table.
		 */
		public static function dropTableMessages() {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();
			$rdvMessageDAO->rdv_drop_table_message_function();
		}

	}
endif;