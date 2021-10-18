<?php

if ( ! interface_exists( 'RdvMessageDAO' ) ):
	interface RdvMessageDAO {

		/*
		 * ********************************************
		 * CREATE TABLE METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for create table.
		 */
		public static function rdv_create_table_message_function();

		/*
		 * ********************************************
		 * DROP TABLE METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for drop table.
		 */
		public static function rdv_drop_table_message_function();

		/*
		 * ********************************************
		 * SELECT METHODS
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for select all data.
		 */
		public static function rdv_select_message();

		/**
		 * @return mixed
		 * Used for select all administrators.
		 */
		public static function rdv_select_admins();

		/*
		 * ********************************************
		 * UPDATE METHODS
		 * ********************************************
		 */

        /**
         * @param $id
         * @param $firstname
         * @param $lastname
         * @param $email
         * @param $subject
         * @param $title
         * @param $body
         *
         * @return mixed
         * Used for update message by id.
         */
		public static function rdv_update_message_function( $id, $userId, $subject, $title, $body );

		/*
		 * ********************************************
		 * INSERT QUERIES SECTION
		 * ********************************************
		 */

		/**
		 * @return mixed
		 * Used for insert the default values.
		 */
		public static function rdv_insert_message();

	}
endif;