<?php
require_once 'includes/dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvTablesManager' ) ):
	class RdvTablesManager {
		public static function createTableRendezVous() {
			global $rdvDAO;
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_create_table_function();
		}

		public static function createTableSettings() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_create_table_settings_function();
		}

		public static function dropTableRendezVous() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvSettingsDAO->rdv_drop_table_function();
		}

		public static function dropTableSettings() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_drop_table_settings_function();
		}
	}
endif;