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

	public static function rdv_select_admins();

	/**
	 * ********************************************
	 * UPDATE METHODS
	 * ********************************************
	 */

	public static function rdv_update_settings_function( $id, $email, $subject, $title, $body );

	/**
	 * ********************************************
	 * INSERT QUERIES SECTION
	 * ********************************************
	 */

	public static function rdv_insert_message();

}