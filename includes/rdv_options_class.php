<?php

require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvOptionsClass' ) ):
	class RdvOptionsClass {

		/**
		 * Constructor for init RdvOptionsClass.
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'rdv_options_page' ) );
			add_action('admin_enqueue_scripts', array($this, 'load_ressources'));
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
			$rdvId          = 'rdv_id';
			$rdvFirstname   = 'rdv_firstname';
			$rdvLastname    = 'rdv_lastname';
			$rdvEmail       = 'rdv_email';
			$rdvPhone       = 'rdv_phone';
			$rdvDate        = 'rdv_date';
			$rdvIsConfirmed = 'rdv_isConfirmed';
			$rdvSentDate    = 'rdv_sentDate';
			$rdvSchedule    = 'rdv_schedule';
			$rdvMessage     = 'rdv_message';

			$query  = new RdvQueriesClass();//Class instantiation
			$select = $query->rdv_select_function();//Get result of select query (array type)

			include_once 'rdv_options_header_form.php';
			if ( count( $select ) == 0 ) {
				echo '<h3>Vous n\'avez pas demande de rendez-vous pour le moment.</h3>';
			}
			foreach ( $select as $col ) {
				$sentDateObject = date_create( $col->$rdvSentDate );
				$dateObject     = date_create( $col->$rdvDate );

				if ( $col->$rdvIsConfirmed == 0 ) {
					echo '<div style="background-color: darkorange">';
				} else {
					echo '<div style="background-color: cornflowerblue">';
				}

				echo '
				<h3> ' . $col->$rdvFirstname . ' ' . $col->$rdvLastname . '</h3>
				<em>Demande reçue le : ' . date_format( $sentDateObject, "d/m/y" ) . '</em>
				<p><strong>Message :</strong> ' . $col->$rdvMessage . '</p>
				<ul>
					<li><strong>Email :</strong> ' . $col->$rdvEmail . '</li>
					<li><strong>Téléphone :</strong> ' . $col->$rdvPhone . '</li>
					<li><strong>Horaire et date souhaités :</strong> le ' . date_format( $dateObject, "d/m/y" ) . ' entre ' . $col->$rdvSchedule . '</li>
				</ul>
				<input type="checkbox" id="' . $col->$rdvId . '" name="' . $col->$rdvId . '">
				<label for="' . $col->$rdvId . '">Supprimer</label>
				</div>
				<hr>
				';
				if ( isset( $_POST['submit'] ) ) {
					if ( ! empty( $_POST[ $col->$rdvId ] ) ) {
						$query->rdv_delete_function( $col->$rdvId );
					}
					echo '<meta http-equiv="REFRESH" content="0">';//For refresh the page
				}
			}
			include_once 'rdv_options_footer_form.php';
		}

		public function load_ressources() {
			if (!defined('PLUGIN_URL')){
				define('PLUGIN_URL', plugin_dir_url(__FILE__));
			}

			wp_register_style('admin_form_style', PLUGIN_URL .'admin/css/admin_form_style.css');
			wp_enqueue_style('admin_form_style');
		}
	}
endif;