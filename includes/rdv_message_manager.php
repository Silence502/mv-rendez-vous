<?php

if ( ! class_exists( 'RdvMessageManager' ) ):
	class RdvMessageManager {
		public static function select() {
			$rdvMessageDAO = RdvDAOFactory::getRdvQueriesMessageClass();
			return $rdvMessageDAO->rdv_select_message();
		}
	}
endif;