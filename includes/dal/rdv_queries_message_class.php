<?php
require_once 'dao/rdv_message_dao.php';

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
    			rdv_msg_subject varchar (50) NOT NULL,
    			rdv_msg_title varchar(50) NOT NULL,
    			rdv_msg_body TEXT NOT NULL,
    			PRIMARY KEY (rdv_msg_id)
			)$charset_collate;";

		dbDelta( $rdv_sql_msg );

		self::rdv_insert_message();
	}

	/**
	 * Used for remove the tables _rendre_vous_* from the database.
	 */
	public static function rdv_drop_table_message_function() {
		global $wpdb, $rdv_table_msg;

		$rdv_table_msg = "DROP TABLE IF EXISTS $rdv_table_msg";
		$wpdb->query( $rdv_table_msg );
	}

	public static function rdv_select_message() {
		global $wpdb, $rdv_table_msg;
		$rdv_table_msg = $wpdb->prefix . 'rendez_vous_msg';

		$rdv_sql = "SELECT * FROM $rdv_table_msg WHERE rdv_msg_id = 1";

		return $wpdb->get_row( $rdv_sql );
	}

	public static function rdv_update_settings_function( $id, $subject, $body ) {
		// TODO: Implement rdv_update_settings_function() method.
	}

	public static function rdv_insert_message() {
		global $wpdb, $rdv_table_msg;
		$rdv_table_msg = $wpdb->prefix . 'rendez_vous_msg';

		$body = 'Bonjour, je vous confirme votre demande de rendez-vous.';

		$default_message_array = array(
			'rdv_msg_id'      => null,
			'rdv_msg_subject' => 'Confirmation rendez-vous - Je Croque Bio',
			'rdv_msg_title'   => 'Confirmation de votre demande de rendez-vous',
			'rdv_msg_body'    => $body,
		);

		$wpdb->insert( $rdv_table_msg, $default_message_array );
	}

}