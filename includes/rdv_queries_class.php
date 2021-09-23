<?php

if ( ! class_exists( 'RdvQueriesClass' ) ):
	class RdvQueriesClass {

		/**
		 * Use for select sql.
		 */
		public function rdv_select_function() {
			global $wpdb;
			$rdv_table = $wpdb->prefix . 'rdv';
			$rdv_sql   = "SELECT * FROM $rdv_table";

			return $wpdb->get_results( $rdv_sql );
		}

		/**
		 * @param $id
		 * Use for delete sql by id.
		 */
		public function rdv_delete_function( $id ) {
			global $wpdb;
			$rdv_table = $wpdb->prefix . 'rdv';
			$wpdb->delete( $rdv_table, array( 'rdv_id' => $id ) );

			$rdv_sql_alter_table = "ALTER TABLE $rdv_table AUTO_INCREMENT = 1";
			$wpdb->query( $rdv_sql_alter_table );
		}

		/**
		 * Add a new table _rdv in the database.
		 */
		function rdv_create_table_function() {
			global $wpdb, $rdv_table;
			$charset_collate = $wpdb->get_charset_collate();
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			$rdv_table = $wpdb->prefix . 'rdv';
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
		 * Remove the table _rdv from the database.
		 */
		function rdv_drop_table_function() {
			global $wpdb, $rdv_table;
			$rdv_table = $wpdb->prefix . 'rdv';
			$rdv_sql   = "DROP TABLE IF EXISTS $rdv_table";

			$wpdb->query( $rdv_sql );
		}

		/**
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 * @param $phone
		 * @param $date
		 * @param $schedule
		 * @param $message
		 * Insert the fields content in the table _rdv.
		 */
		function rdv_insert_function( $firstname, $lastname, $email, $phone, $date, $schedule, $message ) {

			global $wpdb, $rdv_table;
			$rdv_table = $wpdb->prefix . 'rdv';

			$dateTime = new DateTime();

			$table_array = array(
				'rdv_id'          => null,
				'rdv_firstname'   => $firstname,
				'rdv_lastname'    => $lastname,
				'rdv_email'       => $email,
				'rdv_phone'       => $phone,
				'rdv_date'        => $date,
				'rdv_isConfirmed' => 0,
				'rdv_sentDate'    => $dateTime->format( 'Y-m-d' ),
				'rdv_schedule'    => $schedule,
				'rdv_message'     => $message
			);

			if ( $firstname || $lastname || $email || $phone || $date || $schedule || $message ) {
				$wpdb->insert( $rdv_table, $table_array );
			}

		}
	}
endif;

/*
rdv_schedule varchar(20) NOT NULL,
 */