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
		 * @return array|object|null
		 * Used for select users.
		 */
		public static function rdv_select_administrators() {
			global $wpdb;

			$administratorStatus = 'a:1:{s:13:\"administrator\";b:1;}';

			$sql = "
			SELECT *, nickname.meta_value as nickname, wp_capabilities.meta_value as wp_capabilities FROM wp_users
			INNER JOIN (SELECT user_id, meta_value FROM {$wpdb->usermeta} 
						WHERE meta_key = 'nickname') as nickname ON {$wpdb->users}.ID = nickname.user_id
			INNER JOIN (SELECT user_id, meta_value FROM {$wpdb->usermeta} 
						WHERE meta_key = 'wp_capabilities') as wp_capabilities ON {$wpdb->users}.ID = wp_capabilities.user_id
			WHERE wp_capabilities.meta_value = '$administratorStatus'
			";

			return $wpdb->get_results( $sql );
		}

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