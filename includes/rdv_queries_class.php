<?php

if ( ! class_exists( 'RdvQueriesClass' ) ):
	class RdvQueriesClass {

		/**
		 * Used for select all data.
		 */
		public static function rdv_select_function() {
			global $wpdb;
			$rdv_table = $wpdb->prefix . 'rendez_vous';
			$rdv_sql   = "SELECT * FROM $rdv_table";

			return $wpdb->get_results( $rdv_sql );
		}

		/**
		 * @return array|object|null
		 * Used for select confirmed rendez-vous.
		 */
		public static function rdv_select_confirmed_function() {
			global $wpdb;
			$rdv_table = $wpdb->prefix . 'rendez_vous';
			$rdv_sql   = "SELECT * FROM $rdv_table WHERE rdv_isConfirmed=0";

			return $wpdb->get_results( $rdv_sql );
		}

		/**
		 * @return array|object|null
		 * Used for select unconfirmed rendez-vous.
		 */
		public static function rdv_select_to_confirm_function() {
			global $wpdb;
			$rdv_table = $wpdb->prefix . 'rendez_vous';
			$rdv_sql   = "SELECT * FROM $rdv_table WHERE rdv_isConfirmed=1";

			return $wpdb->get_results( $rdv_sql );
		}

		/**
		 * @param $id
		 * Used for delete data by id.
		 */
		public static function rdv_delete_function( $id ) {
			global $wpdb;
			$rdv_table = $wpdb->prefix . 'rendez_vous';
			$wpdb->delete( $rdv_table, array( 'rdv_id' => $id ) );

			$rdv_sql_alter_table = "ALTER TABLE $rdv_table AUTO_INCREMENT = 1";
			$wpdb->query( $rdv_sql_alter_table );
		}

		/**
		 * Used for adding a new table _rendez_vous in the database.
		 */
		public static function rdv_create_table_function() {
			global $wpdb, $rdv_table;
			$charset_collate = $wpdb->get_charset_collate();
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$rdv_table = $wpdb->prefix . 'rendez_vous';
			$rdv_sql   = "CREATE TABLE IF NOT EXISTS $rdv_table (
    			rdv_id INTEGER NOT NULL AUTO_INCREMENT,
    			rdv_firstname varchar(45) NOT NULL,
    			rdv_lastname varchar (45) NOT NULL,
    			rdv_email varchar(50) NOT NULL,
    			rdv_phone varchar(13) NOT NULL,
    			rdv_date datetime NOT NULL,
    			rdv_schedule varchar(20) NOT NULL,
    			rdv_message varchar(255) NOT NULL,
    			rdv_sentDate datetime NOT NULL,
    			rdv_isConfirmed tinyint NOT NULL,
    			PRIMARY KEY (rdv_id)
			)$charset_collate;";

			dbDelta( $rdv_sql );
		}

		/**
		 * Used for adding a new table _rendez_vous_msg in the database.
		 */
		public static function rdv_create_table_message_function() {
			global $wpdb, $rdv_table_msg;
			$charset_collate = $wpdb->get_charset_collate();
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$rdv_table_msg = $wpdb->prefix . 'rendez_vous_msg';
			$rdv_sql       = "CREATE TABLE IF NOT EXISTS $rdv_table_msg (
    			rdv_msg_id INTEGER NOT NULL AUTO_INCREMENT,
    			rdv_message varchar(255) NOT NULL,
    			PRIMARY KEY (rdv_msg_id)
			)$charset_collate;";

			dbDelta( $rdv_sql );
		}

		public static function rdv_create_table_email_function() {
			global $wpdb, $rdv_table_email;
			$charset_collate = $wpdb->get_charset_collate();
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$rdv_table_email = $wpdb->prefix . 'rendez_vous_email';
			$rdv_sql         = "CREATE TABLE IF NOT EXISTS $rdv_table_email (
    			rdv_email_id INTEGER NOT NULL AUTO_INCREMENT,
    			rdv_email varchar(255) NOT NULL,
    			PRIMARY KEY (rdv_email_id)
			)$charset_collate;";

			dbDelta( $rdv_sql );
		}

		/**
		 * Used for remove the table _rdv from the database.
		 */
		public static function rdv_drop_table_function() {
			global $wpdb, $rdv_table, $rdv_table_msg;
			$rdv_table     = $wpdb->prefix . 'rendez_vous';
			$rdv_table_msg = $wpdb->prefix . 'rendez_vous_msg';
			$rdv_drop      = "DROP TABLE IF EXISTS $rdv_table";
			$rdv_drop_msg  = "DROP TABLE IF EXISTS $rdv_table_msg";
			$wpdb->query( $rdv_drop );
			$wpdb->query( $rdv_drop_msg );
		}

		/**
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 * @param $phone
		 * @param $date
		 * @param $schedule
		 * @param $message
		 * Used for insert the fields content in the table _rdv.
		 */
		public static function rdv_insert_function( $firstname, $lastname, $email, $phone, $date, $schedule, $message ) {
			global $wpdb, $rdv_table;
			$rdv_table = $wpdb->prefix . 'rendez_vous';

			$dateTime = new DateTime();

			$table_array = array(
				'rdv_id'          => null,
				'rdv_firstname'   => $firstname,
				'rdv_lastname'    => $lastname,
				'rdv_email'       => $email,
				'rdv_phone'       => $phone,
				'rdv_date'        => $date,
				'rdv_isConfirmed' => false,
				'rdv_sentDate'    => $dateTime->format( 'Y-m-d' ),
				'rdv_schedule'    => $schedule,
				'rdv_message'     => $message
			);

			$table_format = array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d',
				'%s',
				'%s',
				'%s'
			);

			if ( $firstname || $lastname || $email || $phone || $date || $schedule || $message ) {
				$wpdb->insert(
					$rdv_table,
					$table_array,
					$table_format
				);
			}
		}

		/**
		 * @param $id
		 * @param $checked
		 * Used for update query by id.
		 */
		public static function rdv_update_function( $id, $checked ) {
			global $wpdb, $rdv_table;
			$rdv_table = $wpdb->prefix . 'rendez_vous';
			$wpdb->update(
				$rdv_table,
				array( 'rdv_isConfirmed' => $checked ),
				array( 'rdv_id' => $id ),
				array( '%d', '%d' ),
				array( '%d' )
			);
		}
	}
endif;