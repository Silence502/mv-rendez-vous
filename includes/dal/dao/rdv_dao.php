<?php

if ( ! interface_exists( 'RdvDAO' ) ):
	interface RdvDAO {

		/*
		 * ********************************************
		 * CREATE TABLE METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for create table.
		 */
		public static function rdv_create_table_function();

		/*
		 * ********************************************
		 * DROP TABLE METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for drop table.
		 */
		public static function rdv_drop_table_function();

		/*
		 * ********************************************
		 * SELECT METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for select all data.
		 */
		public static function rdv_select_function();

		/**
		 * @return mixed
		 * Used for select by isConfirmed true.
		 */
		public static function rdv_select_confirmed_function();

		/**
		 * @return mixed
		 * Used for select by isConfirmed false.
		 */
		public static function rdv_select_to_confirm_function();

		/*
		 * ********************************************
		 * DELETE METHODS
		 * ********************************************
		 */

		/**
		 * @param $id
		 *
		 * @return mixed
		 * Used for delete by id.
		 */
		public static function rdv_delete_function( $id );

		/*
		 * ********************************************
		 * UPDATE METHODS
		 * ********************************************
		 */

		/**
		 * @param $id
		 * @param $checked
		 *
		 * @return mixed
		 * Used for update by id. Data to update : isConfirmed.
		 */
		public static function rdv_update_function( $id, $checked );

		/*
		 * ********************************************
		 * INSERT METHODS
		 * ********************************************
		 */

		/**
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 * @param $phone
		 * @param $date
		 * @param $schedule
		 * @param $message
		 *
		 * @return mixed
		 * Used for insert query.
		 */
		public static function rdv_insert_function( $firstname, $lastname, $email, $phone, $date, $schedule, $message );

	}
endif;