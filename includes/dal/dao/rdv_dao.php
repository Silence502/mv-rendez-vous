<?php

interface RdvDAO {

	/**
	 * ********************************************
	 * CREATE TABLE METHODS
	 * ********************************************
	 */

	public static function rdv_create_table_function();

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

	public static function rdv_select_function();
	public static function rdv_select_confirmed_function();
	public static function rdv_select_to_confirm_function();

	/**
	 * ********************************************
	 * DELETE METHODS
	 * ********************************************
	 */

	public static function rdv_delete_function( $id );

	/**
	 * ********************************************
	 * UPDATE METHODS
	 * ********************************************
	 */

	public static function rdv_update_function( $id, $checked );

	/**
	 * ********************************************
	 * INSERT METHODS
	 * ********************************************
	 */

	public static function rdv_insert_function( $firstname, $lastname, $email, $phone, $date, $schedule, $message );

}