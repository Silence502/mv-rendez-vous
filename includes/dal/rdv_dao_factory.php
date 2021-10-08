<?php
require_once 'rdv_queries_class.php';
require_once 'rdv_queries_settings_class.php';

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