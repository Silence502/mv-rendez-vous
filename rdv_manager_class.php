<?php
require_once 'includes/dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvManagerClass' ) ):
	class RdvManagerClass {
		//TODO: Voir pour mettre la variable en protected.
		public static function insert( $firstname, $lastname, $email, $phone, $date, $schedule, $message ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			RdvValidationClass::validation_rdv( $firstname, $lastname, $email, $phone, $date, $schedule, $message );
			$rdvDAO->rdv_insert_function( $firstname, $lastname, $email, $phone, $date, $schedule, $message );
		}

		public static function selectAll() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_function();
		}

		public static function selectByConfirmed() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_confirmed_function();
		}

		public static function selectByToConfirm() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_to_confirm_function();
		}

		public static function update( $id, $checked ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_update_function( $id, $checked );
		}

		public static function delete( $id ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_delete_function( $id );
		}
	}
endif;