<?php
include __DIR__ . '/../rdv_config.php';
include RDV_DIR . '/includes/dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvManager' ) ):
	class RdvManager {
		//TODO: Voir pour mettre la variable en protected.
		public static function insert( $firstname, $lastname, $email, $phone, $date, $schedule, $message ) {
			global $rdvDAO;
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			RdvValidation::validation_rdv( $firstname, $lastname, $email, $phone, $date, $schedule, $message );
			$rdvDAO->rdv_insert_function( $firstname, $lastname, $email, $phone, $date, $schedule, $message );
		}

		public static function selectAll() {
			global $rdvDAO;
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_function();
		}

		public static function selectByConfirmed() {
			global $rdvDAO;
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_confirmed_function();
		}

		public static function selectByToConfirm() {
			global $rdvDAO;
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_to_confirm_function();
		}

		public static function update( $id, $checked ) {
			global $rdvDAO;
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_update_function( $id, $checked );
		}

		public static function delete( $id ) {
			global $rdvDAO;
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_delete_function( $id );
		}
	}
endif;