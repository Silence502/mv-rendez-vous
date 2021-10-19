<?php
require_once plugin_dir_path( __DIR__ ) . 'dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvMessageManager' ) ):
	class RdvMessageManager {

		/**
		 * @return array|object
         * Used for the 'select' query through the DAO factory.
		 * @throws Exception
		 */
		public static function select() {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();

			return $rdvMessageDAO->rdv_select_message();
		}

        /**
         * @param $id
         * @param $userId
         * @param $subject
         * @param $title
         * @param $body
         * Used for get 'update' query through the DAO factory.
         *
         * @throws Exception
         */
		public static function update( $id, $userId, $subject, $title, $body ) {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();
			$rdvMessageDAO->rdv_update_message_function( $id, $userId, $subject, $title, $body );
		}

		/**
		 * @return array|object|null
		 * Used for get 'select' query for all administrators through DAO factory.
		 */
		public static function selectAdmins() {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();

			return $rdvMessageDAO->rdv_select_admins();
		}
	}
endif;