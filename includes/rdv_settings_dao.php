<?php

interface RdvSettingsDAO {
	/**
	 * ********************************************
	 * CREATE TABLE METHODS
	 * ********************************************
	 */

	public static function rdv_create_table_settings_function();

	/**
	 * ********************************************
	 * DROP TABLE METHODS
	 * ********************************************
	 */

	public static function rdv_drop_table_function();

	/**
	 * ********************************************
	 * SELECT METHODS
	 * ********************************************
	 */

	public static function rdv_select_settings();

	/**
	 * ********************************************
	 * UPDATE METHODS
	 * ********************************************
	 */

	public static function rdv_update_settings_function($id, $sending, $receiving);

	/**
	 * ********************************************
	 * INSERT QUERIES SECTION
	 * ********************************************
	 */

	public static function rdv_insert_settings();

}