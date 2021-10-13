<?php
require_once 'includes/dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvSettingsManager' ) ):
	class RdvSettingsManager {

		/**
		 * Used for the 'insert' query through the DAO factory.
		 */
		public static function insert() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_insert_settings();
		}

		/**
		 * @param $id
		 * @param $sending
		 * @param $receiving
		 * Used for the 'update' query through the DAO factory.
		 */
		public static function update( $id, $sending, $receiving ) {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();
			$rdvSettingsDAO->rdv_update_settings_function( $id, $sending, $receiving );
		}

		/**
		 * @return array|object|void|null
		 * Used for the 'select' query for all data through the DAO factory.
		 */
		public static function select() {
			global $rdvSettingsDAO;
			$rdvSettingsDAO = RdvDAOFactory::getRdvQueriesSettingsClass();

			return $rdvSettingsDAO->rdv_select_settings();
		}
	}
endif;