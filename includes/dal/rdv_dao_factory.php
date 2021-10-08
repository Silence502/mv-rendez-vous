<?php
require_once __DIR__ . '/../../rdv_config.php';
include RDV_DIR . 'includes/rdv_queries_class.php';
include RDV_DIR . 'includes/rdv_queries_settings_class.php';

abstract class RdvDAOFactory {

	/**
	 * @return RdvQueriesClass
	 * Used for getting RdvQueriesClass queries.
	 */
	public static function getRdvQueriesClass(): RdvQueriesClass {
		return new RdvQueriesClass();
	}

	/**
	 * @return RdvQueriesSettingsClass
	 * Used for getting RdvQueriesClass queries.
	 */
	public static function getRdvQueriesSettingsClass(): RdvQueriesSettingsClass {
		return new RdvQueriesSettingsClass();
	}

}