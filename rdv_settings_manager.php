<?php
require_once 'includes/dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvSettingsManager' ) ):
	class RdvSettingsManager {

		public static function insert() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_insert_settings();
		}

		public static function update( $id, $sending, $receiving ) {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_update_settings_function( $id, $sending, $receiving );
		}

		public static function select() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();

			return $rdvSettingsDAO->rdv_select_settings();
		}
	}
endif;