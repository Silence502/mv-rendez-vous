<?php

require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvOptionsClass' ) ):
	class RdvOptionsClass {

		/**
		 * Constructor for init RdvOptionsClass.
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
				4
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

				global $cardColor;
				global $checked;
				global $confirm;

				if ( $col->$rdvIsConfirmed == 0 ) {
					$cardColor  = 'background-color: #e5d0d0';
					$checked    = '';
					$confirm    = 'Confirmer le rendez-vous';
					$labelColor = 'color: black';
					$confirmed   = '';
				} else {
					$cardColor  = 'background-color: #d1dfe6';
					$checked    = 'checked';
					$confirm    = 'Rendez-vous confirmé';
					$disabled   = 'disabled';
					$labelColor = 'color: teal';
					$confirmed   = 'disabled';
				}

				echo '
				<hr>
				<div style="' . $cardColor . '" class="card card-style">
				<h3> ' . $col->$rdvFirstname . ' ' . $col->$rdvLastname . '</h3>
				<em>Demande reçue le : ' . date_format( $sentDateObject, "d/m/y" ) . '</em>
				<ul>
					<li><strong>Email :</strong> ' . $col->$rdvEmail . '</li>
					<li><strong>Téléphone :</strong> ' . $col->$rdvPhone . '</li>
					<li><strong>Horaire et date souhaités :</strong> le ' . date_format( $dateObject, "d/m/y" ) . ' entre ' . $col->$rdvSchedule . '</li>
				</ul>
				<div class="card card-style">
				<p>' . $col->$rdvMessage . '</p>
				</div>
				<hr>
				<div class="options-card-style">
				<div>
				<input type="checkbox" id="' . $col->$rdvId . '-to-delete" name="' . $col->$rdvId . '-to-delete">
				<label for="' . $col->$rdvId . '-to-delete" class="to-delete"><strong>Supprimer</strong></label>
				</div>
				<input ' . $confirmed . ' type="submit" name="' . $col->$rdvId . '-to-confirm" id="' . $col->$rdvId . '-to-confirm" class="button-primary" value="' . $confirm . '">
				</div>
				
				';
				if ( isset( $_POST[ $col->$rdvId . '-to-confirm' ] ) ) {
					$this->rdv_confirm( $dateObject, $col->$rdvSchedule, $col->$rdvFirstname, $col->$rdvLastname, $col->$rdvEmail );
					$query->rdv_update_function( $col->$rdvId, true );
					echo '<meta http-equiv="REFRESH" content="0">';
				}

				if ( isset( $_POST['submit'] ) ) {
					if ( ! empty( $_POST[ $col->$rdvId . '-to-delete' ] ) && $col->$rdvIsConfirmed == 1 ) {
						$query->rdv_delete_function( $col->$rdvId );
						echo '<meta http-equiv="REFRESH" content="0">';
					} elseif ( ! empty( $_POST[ $col->$rdvId . '-to-delete' ] ) && $col->$rdvIsConfirmed == 0 ) {
						echo '
						<div style="color: red; margin-top: 10px; display: flex; align-items: center; flex-direction: column;" class="alert-delete-style">
						Vous n\'avez pas confirmé ce rendez-vous<br>
						Voulez-vous quand même le supprimer ?
						<div><input style="margin-top: 10px;" type="submit" id="' . $col->$rdvId . '-to-delete-alert" name="' . $col->$rdvId . '-to-delete-alert" class="button-secondary" value="Confirmer la suppression"></div>
						</div>
						';
					}
				}

				if ( isset( $_POST[ $col->$rdvId . '-to-delete-alert' ] ) ) {
					$query->rdv_delete_function( $col->$rdvId );
					echo '<meta http-equiv="REFRESH" content="0">';
				}

				echo '</div>';
			}
			include_once 'rdv_options_footer_form.php';
		}

		/**
		 * @param $dateObject
		 * @param $schedule
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 */
		public function rdv_confirm( $dateObject, $schedule, $firstname, $lastname, $email ) {
			$to      = $email;
			$subject = 'Confirmation de rendez-vous';
			$body    = '<h1>Confirmation de rendez-vous</h1>';
			$body    .= '<p>Bonjour, ' . $firstname . ' ' . $lastname . '.<br><br>';
			$body    .= 'Je vous confirme votre demande de rendez-vous pour le ' . date_format( $dateObject, 'd/m/y' ) . ' entre ' . $schedule . '.<br>';
			$body    .= 'Je vous contacterai via le numéro que vous avez communiqué(e) lors de votre demande.<br>';
			$body    .= 'Cordialement,</p>';
			$body    .= '<hr>';
			$body    .= '<p>' . $_POST['message'] . '</p>';
			$header  = 'Content-Type: text/html' . "\r\n" . 'From: admin@admin.com';

			mail(
				$to,
				$subject,
				$body,
				$header
			);
		}

	}
endif;