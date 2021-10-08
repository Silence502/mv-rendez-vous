<?php

class RdvQueriesSettingsClass implements RdvSettingsDAO {

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

		//TODO: Réaliser l'insertion des données par défauts.
	}

	/**
	 * Used for remove the tables _rendre_vous_* from the database.
	 */
	public static function rdv_drop_table_settings_function() {
		global $wpdb, $rdv_table_settings;

		$rdv_drop_settings = "DROP TABLE IF EXISTS $rdv_table_settings";
		$wpdb->query( $rdv_drop_settings );
	}

	/**
	 * @return array|object|void|null
	 * Used for selecting settings.
	 */
	public static function rdv_select_settings() {
		global $wpdb, $rdv_table_settings;
		$rdv_table_settings = $wpdb->prefix . 'rendez_vous_settings';

		$rdv_sql = "SELECT * FROM $rdv_table_settings WHERE rdv_settings_id = 1";

		return $wpdb->get_row( $rdv_sql );
	}

	/**
	 * @param $id
	 * @param $sending
	 * @param $receiving
	 * Used for update settings.
	 */
	public static function rdv_update_settings_function( $id, $sending, $receiving ) {
		global $wpdb, $rdv_table_settings;

		$wpdb->update(
			$rdv_table_settings,
			array(
				'rdv_sending'   => $sending,
				'rdv_receiving' => $receiving
			),
			array( 'rdv_settings_id' => $id ),
			array( '%d', '%d' ),
			array('%d')
		);
	}

	/**
	 * Used for insert default settings.
	 */
	public static function rdv_insert_settings() {
		global $wpdb, $rdv_table_settings;
		$rdv_table_settings = $wpdb->prefix . 'rendez_vous_settings';

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
		global $wpdb, $rdv_table_settings;

		$rdv_drop_settings = "DROP TABLE IF EXISTS $rdv_table_settings";
		$wpdb->query( $rdv_drop_settings );
	}
}