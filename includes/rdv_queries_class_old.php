<?php

if ( ! class_exists( 'RdvQueriesClassModif' ) ):
	class RdvQueriesClassModif{

		/**
		 * ********************************************
		 * CREATE TABLE QUERIES SECTION
		 * ********************************************
		 */

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
		 * ********************************************
		 * DROP TABLE QUERIES SECTION
		 * ********************************************
		 */


		/**
		 * ********************************************
		 * SELECT QUERIES SECTION
		 * ********************************************
		 */

		/**
		 * ********************************************
		 * DELETE QUERIES SECTION
		 * ********************************************
		 */

		/**
		 * ********************************************
		 * UPDATE QUERIES SECTION
		 * ********************************************
		 */

		/**
		 * ********************************************
		 * INSERT QUERIES SECTION
		 * ********************************************
		 */

	}
endif;