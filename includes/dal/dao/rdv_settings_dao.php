<?php

if ( ! interface_exists( 'RdvSettingsDAO' ) ):
	interface RdvSettingsDAO {

		/*
		 * ********************************************
		 * CREATE TABLE METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for create table.
		 */
		public static function rdv_create_table_settings_function();

		/*
		 * ********************************************
		 * DROP TABLE METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for drop table.
		 */
		public static function rdv_drop_table_settings_function();

		/*
		 * ********************************************
		 * SELECT METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for select settings.
		 */
		public static function rdv_select_settings();

		/*
		 * ********************************************
		 * UPDATE METHODS
		 * ********************************************
		 */

		/**
		 * @param $id
		 * @param $sending
		 * @param $receiving
		 *
		 * @return mixed
		 */
		public static function rdv_update_settings_function( $id, $sending, $receiving );

		/*
		 * ********************************************
		 * INSERT QUERIES SECTION
		 * ********************************************
		 */

		/**
		 * @return mixed
		 */
		public static function rdv_insert_settings();

	}
endif;