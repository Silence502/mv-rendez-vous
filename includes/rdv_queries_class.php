<?php

if ( ! class_exists( 'RdvQueriesClass' ) ):
	global $rdv_db_version;
	$rdv_db_version = '1.0';

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

		public static function rdv_select_settings() {
			global $wpdb, $rdv_table_settings;

			$rdv_table_settings = $wpdb->prefix . 'rendez_vous_settings';
			$rdv_sql = "SELECT * FROM $rdv_table_settings WHERE rdv_settings_id = 1";

			return $wpdb->get_row($rdv_sql);
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
    			rdv_user_id int NOT NULL,
    			PRIMARY KEY (rdv_id),
    			CONSTRAINT fk_user FOREIGN KEY (rdv_user_id) REFERENCES {$wpdb->users}(user_id)
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
    			rdv_msg_title varchar(50) NOT NULL,
    			rdv_msg_body varchar(255) NOT NULL,
    			PRIMARY KEY (rdv_msg_id),
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

		public static function rdv_create_table_settings_function() {
			global $wpdb, $rdv_table_settings;
			$charset_collate = $wpdb->get_charset_collate();
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$rdv_table_settings = $wpdb->prefix . 'rendez_vous_settings';
			$rdv_sql            = "CREATE TABLE IF NOT EXISTS $rdv_table_settings (
    			rdv_settings_id INTEGER NOT NULL AUTO_INCREMENT,
    			rdv_sending tinyint DEFAULT 1 NOT NULL,
    			rdv_receiving tinyint DEFAULT 1 NOT NULL,
    			PRIMARY KEY (rdv_settings_id)
			)$charset_collate;";

			dbDelta( $rdv_sql );

			self::rdv_insert_settings();
		}

		public static function rdv_insert_settings() {
			global $wpdb, $rdv_table_settings;

			$default_query_array = array(
				'rdv_settings_id' => null,
				'rdv_sending'     => 1,
				'rdv_receiving'   => 1
			);

			$wpdb->insert( $rdv_table_settings, $default_query_array );
		}

		/**
		 * Used for remove the tables _rendre_vous_* from the database.
		 */
		public static function rdv_drop_table_function() {
			global $wpdb, $rdv_table, $rdv_table_msg, $rdv_table_email, $rdv_table_settings;

			$rdv_drop          = "DROP TABLE IF EXISTS $rdv_table";
			$rdv_drop_msg      = "DROP TABLE IF EXISTS $rdv_table_msg";
			$rdv_drop_email    = "DROP TABLE IF EXISTS $rdv_table_email";
			$rdv_drop_settings = "DROP TABLE IF EXISTS $rdv_table_settings";
			$wpdb->query( $rdv_drop );
			$wpdb->query( $rdv_drop_msg );
			$wpdb->query( $rdv_drop_email );
			$wpdb->query( $rdv_drop_settings );
		}

		public static function rdv_select_user() {
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
				//TODO: Rajouter la relation avec l'user.
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