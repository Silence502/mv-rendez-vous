<?php

abstract class RdvDAOFactory {

	/**
	 * @return RdvQueriesClass
	 * Used for getting RdvQueriesClass queries.
	 */
	public static function getRdvQueriesClass(): RdvQueriesClass {
		require_once 'rdv_queries_class.php';
		return new RdvQueriesClass();
	}

	/**
	 * @return RdvQueriesSettingsClass
	 * Used for getting RdvQueriesClass queries.
	 */
	public static function getRdvQueriesSettingsClass(): RdvQueriesSettingsClass {
		require_once 'rdv_queries_settings_class.php';
		return new RdvQueriesSettingsClass();
	}

	/**
	 * @return RdvQueriesMessageClass
	 * Used for getting RdvQueriesClass queries.
	 */
	public static function getRdvQueriesMessageClass(): RdvQueriesMessageClass {
		require_once 'rdv_queries_message_class.php';
		return new RdvQueriesMessageClass();
	}
}