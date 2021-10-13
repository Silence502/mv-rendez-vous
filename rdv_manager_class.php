<?php
require_once 'includes/dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvManagerClass' ) ):
	class RdvManagerClass {
		//TODO: Voir pour mettre la variable en protected.
		/**
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 * @param $phone
		 * @param $date
		 * @param $schedule
		 * @param $message
		 * Used for the 'insert' query through the DAO factory.
		 */
		public static function insert( $firstname, $lastname, $email, $phone, $date, $schedule, $message ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			RdvValidationClass::validation_rdv( $firstname, $lastname, $email, $phone, $date, $schedule, $message );
			$rdvDAO->rdv_insert_function( $firstname, $lastname, $email, $phone, $date, $schedule, $message );
		}

		/**
		 * @return array|mixed|object|null
		 * Used for the 'select' query for all data through the DAO factory.
		 */
		public static function selectAll() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_function();
		}

		/**
		 * @return array|object|null
		 * Used for the 'select' query through isConfirmed=true through the DAO factory.
		 */
		public static function selectByConfirmed() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_confirmed_function();
		}

		/**
		 * @return array|object|null
		 * Used for the 'select' query through isConfirmed=false through the DAO factory.
		 */
		public static function selectByToConfirm() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_to_confirm_function();
		}

		/**
		 * @param $id
		 * @param $checked
		 * Used for the 'update' query through the DAO factory.
		 */
		public static function update( $id, $checked ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_update_function( $id, $checked );
		}

		/**
		 * @param $id
		 * Used for the 'delete' query through the DAO factory.
		 */
		public static function delete( $id ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_delete_function( $id );
		}
	}
endif;