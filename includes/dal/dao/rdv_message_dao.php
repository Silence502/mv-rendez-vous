<?php

interface RdvMessageDAO {

	/**
	 * ********************************************
	 * CREATE TABLE METHODS
	 * ********************************************
	 */

	public static function rdv_create_table_message_function();

	/**
	 * ********************************************
	 * DROP TABLE METHODS
	 * ********************************************
	 */

	public static function rdv_drop_table_message_function();

	/**
	 * ********************************************
	 * SELECT METHODS
	 * ********************************************
	 */

	public static function rdv_select_message();

	/**
	 * ********************************************
	 * UPDATE METHODS
	 * ********************************************
	 */

	public static function rdv_update_settings_function($id, $subject, $body);

	/**
	 * ********************************************
	 * INSERT QUERIES SECTION
	 * ********************************************
	 */

	public static function rdv_insert_message();

}