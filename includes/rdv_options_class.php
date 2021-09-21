<?php

require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvOptionsClass' ) ):
	class RdvOptionsClass {

		/**
		 * Constructor for RdvOptionsClass.
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'rdv_options_page' ) );
		}

		/**
		 * Setting for admin page.
		 */
		public function rdv_options_page() {
			add_menu_page(
				'Rendez-vous',
				'Rendez-vous',
				'manage_options',
				'rdv_options',
				array( $this, 'rdv_options_queries' ),
				null,
				20
			);
		}

		/**
		 * Use for get rendez-vous inside admin page.
		 */
		public function rdv_options_queries() {
			//Get columns name
			$rdvId        = 'ID';
			$rdvFirstname = 'rdv_firstname';
			$rdvLastname  = 'rdv_lastname';
			$rdvEmail     = 'rdv_email';
			$rdvMessage   = 'rdv_message';

			$result = new RdvQueriesClass();//Class instantiation
			$print  = $result->rdv_select_function();//Get result of select query (array type)

			include_once 'rdv_options_header_form.php';
			if ( count( $print ) == 0 ) {
				echo '<h3>Vous n\'avez pas demande de rendez-vous pour le moment.</h3>';
			}
			foreach ( $print as $res ) {
				echo '<h3> ' . $res->$rdvFirstname . ' ' . $res->$rdvLastname . '</h3>';
				echo '<p><strong>Message :</strong> ' . $res->$rdvMessage . '</p>';
				echo '<p><strong>Email :</strong> ' . $res->$rdvEmail . '</p>';
				echo '<input type="checkbox" id="' . $res->$rdvId . '" name="' . $res->$rdvId . '"><label for="' . $res->$rdvId . '">Supprimer</label>';
				echo '<hr>';
				if ( isset( $_POST['submit'] ) ) {
					if ( ! empty( $_POST[ $res->$rdvId ] ) ) {
						$result->rdv_delete_function( $res->$rdvId );
					}
					echo '<meta http-equiv="REFRESH" content="0">';//For refresh the page
				}
			}
			include_once 'rdv_options_footer_form.php';
		}
	}
endif;