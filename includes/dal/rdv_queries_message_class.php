<?php
require_once 'dao/rdv_message_dao.php';

if ( ! class_exists( 'RdvQueriesMessageClass' ) ):
	class RdvQueriesMessageClass implements RdvMessageDAO {

		/**
		 * Used for adding a new table _rendez_vous_msg in the database.
		 */
		public static function rdv_create_table_message_function() {
			global $wpdb, $rdv_table_msg;

			$charset_collate = $wpdb->get_charset_collate();
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$rdv_table_msg = $wpdb->prefix . 'rendez_vous_msg';
			$rdv_sql_msg   = "CREATE TABLE IF NOT EXISTS $rdv_table_msg (
    			rdv_msg_id INTEGER NOT NULL AUTO_INCREMENT,
    			rdv_msg_user_id varchar(80) NOT NULL,
    			rdv_msg_subject varchar(50) NOT NULL,
    			rdv_msg_title varchar(50) NOT NULL,
    			rdv_msg_body TEXT NOT NULL,
    			PRIMARY KEY (rdv_msg_id)
			)$charset_collate;";

			dbDelta( $rdv_sql_msg );

			self::rdv_insert_message();
			self::rdv_alter_table();
		}

		/**
		 * Used for remove the tables _rendre_vous_msg from the database.
		 */
		public static function rdv_drop_table_message_function() {
			global $wpdb, $rdv_table_msg;

			$rdv_table_msg = "DROP TABLE IF EXISTS $rdv_table_msg";
			$wpdb->query( $rdv_table_msg );
		}

		/**
		 * @return array|object|void|null
		 * Used for return all data in the row by id = 1.
		 * @throws Exception
		 */
		public static function rdv_select_message() {
			global $wpdb, $rdv_table_msg;
			$rdv_table_msg = $wpdb->prefix . 'rendez_vous_msg';
            $users_table         = $wpdb->prefix . 'users';

			try {
				$rdv_sql = "
				SELECT rdv_msg_id, rdv_msg_subject, rdv_msg_title, rdv_msg_body, $users_table.display_name
				FROM $rdv_table_msg as msg_table
                INNER JOIN $users_table
				";

				return $wpdb->get_row( $rdv_sql );
			} catch ( Exception $e ) {
				throw new Exception('Erreur de la requête SELECT dans la base de données');
			}
		}

        /**
         * @param $id
         * @param $userId
         * @param $subject
         * @param $title
         * @param $body
         *
         * @return void
         * Used for update message row.
         * @throws Exception
         */
		public static function rdv_update_message_function( $id, $userId, $subject, $title, $body ) {
			global $wpdb, $rdv_table_msg;

			try {
				$wpdb->update(
					$rdv_table_msg,
					array(
					    'rdv_msg_user_id' => $userId,
						'rdv_msg_subject' => $subject,
						'rdv_msg_title'   => $title,
						'rdv_msg_body'    => $body
					),
					array( 'rdv_msg_id' => $id ),
					array( '%d', '%s', '%s', '%s' ),
					array( '%d' )
				);
			} catch (Exception $e) {
				throw new Exception('Erreur de la requête UPDATE dans la base de données');
			}
		}

		/**
		 * @return void
		 * Used for insert default message.
		 */
		public static function rdv_insert_message() {
			global $wpdb, $rdv_table_msg;
			$rdv_table_msg = $wpdb->prefix . 'rendez_vous_msg';
			$current_user   = wp_get_current_user();

			$body = 'Bonjour, je vous confirme votre demande de rendez-vous.';

			$default_message_array = array(
				'rdv_msg_id'       => null,
				'rdv_msg_user_id'  => $current_user->ID,
				'rdv_msg_subject'  => 'Confirmation rendez-vous - Je Croque Bio',
				'rdv_msg_title'    => 'Confirmation de votre demande de rendez-vous',
				'rdv_msg_body'     => $body,
			);

			$wpdb->insert( $rdv_table_msg, $default_message_array );
		}

		public static function rdv_alter_table() {
            global $wpdb, $rdv_table_msg, $users_table;
            $rdv_table_msg = $wpdb->prefix . 'rendez_vous_msg';
            $users_table         = $wpdb->prefix . 'users';

            $alter_table = "
			ALTER TABLE $rdv_table_msg ADD CONSTRAINT users_user_id_fk FOREIGN KEY(rdv_msg_user_id) REFERENCES $users_table({$wpdb->users}.ID);
			";

            $wpdb->query( $alter_table );
        }

		/**
		 * @return array|object|null
		 * Used for select all administrators.
		 */
		public static function rdv_select_admins() {
			global $wpdb, $users_table;

			$users_table         = $wpdb->prefix . 'users';
			$capabilities        = $wpdb->prefix . 'capabilities';
			$administratorStatus = 'a:1:{s:13:\"administrator\";b:1;}';

			$sql = "
			SELECT *, nickname.meta_value as nickname, $capabilities.meta_value as $capabilities FROM $users_table
			INNER JOIN (SELECT user_id, meta_value FROM {$wpdb->usermeta} 
						WHERE meta_key = 'nickname') as nickname ON {$wpdb->users}.ID = nickname.user_id
			INNER JOIN (SELECT user_id, meta_value FROM {$wpdb->usermeta} 
						WHERE meta_key = '$capabilities') as $capabilities ON {$wpdb->users}.ID = $capabilities.user_id
			WHERE $capabilities.meta_value = '$administratorStatus'
			";

			return $wpdb->get_results( $sql );
		}
	}
endif;