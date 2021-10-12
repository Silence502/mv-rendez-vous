<?php

if ( ! class_exists( 'RdvMessageManager' ) ):
	class RdvMessageManager {
		public static function select() {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();

			return $rdvMessageDAO->rdv_select_message();
		}

		public static function update( $id, $email, $subject, $title, $body ) {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();
			$rdvMessageDAO->rdv_update_settings_function( $id, $email, $subject, $title, $body );
		}

		public static function selectAdmins() {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();

			return $rdvMessageDAO->rdv_select_admins();
		}
	}
endif;