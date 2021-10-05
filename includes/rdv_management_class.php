<?php

require_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvManagementClass' ) ):
	class RdvManagementClass {
		/**
		 * Used for displaying the management page.
		 */
		public static function rdv_management_page() {
			add_menu_page(
				'Rendez-vous',
				'Rendez-vous',
				'manage_options',
				'rdv-management',
				array( 'RdvManagementClass', 'rdv_management' ),
				null,
				4
			);
		}

		/**
		 * Used to retrieve all appointments in the administration page.
		 * Get columns name.
		 * Implement the form with a foreach condition for display the selection query.
		 * Condition for updating the display cards by the boolean confirmation value.
		 * Two other conditions for validating deletion and update queries.
		 */
		public static function rdv_management() {
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

			$selectCount          = count( RdvQueriesClass::rdv_select_function() );
			$selectCountConfirmed = count( RdvQueriesClass::rdv_select_confirmed_function() );
			$selectCountToConfirm = count( RdvQueriesClass::rdv_select_to_confirm_function() );

			include_once 'rdv_header_form.php';
			if ( $selectCount < 1 ) {
				echo '<h3>Vous n\'avez pas demande de rendez-vous pour le moment.</h3>';
			} else {
				echo '<h3>Vous avez ' . $selectCount . ' demande de rendez-vous</h3>';
				echo '<p class="count-to-confirm-style">Dont <span class="validated-style"><strong>' . $selectCountConfirmed . '</strong></span> 
				rendez-vous validé(s) et <span class="unvalidated-style"><strong>' . $selectCountToConfirm . '</strong></span> non validés</p><hr>';
			}
			foreach ( RdvQueriesClass::rdv_select_function() as $row ) {
				$sentDateObject = date_create( $row->$rdvSentDate );
				$dateObject     = date_create( $row->$rdvDate );

				global $cardColor;
				global $checked;
				global $confirm;

				if ( $row->$rdvIsConfirmed == 0 ) {
					$cardColor  = 'background-color: #e5d0d0';
					$checked    = '';
					$confirm    = 'Valider le rendez-vous';
					$labelColor = 'color: black';
					$confirmed  = '';
				} else {
					$cardColor  = 'background-color: #d1dfe6';
					$checked    = 'checked';
					$confirm    = 'Rendez-vous validé';
					$disabled   = 'disabled';
					$labelColor = 'color: teal';
					$confirmed  = 'disabled';
				}

				echo '
				<div style="' . $cardColor . '" class="card card-style">
					<h3> ' . $row->$rdvFirstname . ' ' . $row->$rdvLastname . '</h3>
					<em>Demande reçue le : ' . date_format( $sentDateObject, "d/m/y" ) . '</em>
					<ul>
						<li><strong>Email :</strong> ' . $row->$rdvEmail . '</li>
						<li><strong>Téléphone :</strong> ' . $row->$rdvPhone . '</li>
						<li><strong>Horaire et date souhaités :</strong> le ' . date_format( $dateObject, "d/m/y" ) . ' entre ' . $row->$rdvSchedule . '</li>
					</ul>
					<div class="card card-style">
						<p>' . $row->$rdvMessage . '</p>
					</div>
					<hr>
					<div class="options-card-style">
						<div>
							<input type="checkbox" id="' . $row->$rdvId . '-to-delete" name="' . $row->$rdvId . '-to-delete">
							<label for="' . $row->$rdvId . '-to-delete" class="to-delete"><strong>Supprimer</strong></label>
						</div>
						<input ' . $confirmed . ' type="submit" name="' . $row->$rdvId . '-to-confirm" id="' . $row->$rdvId . '-to-confirm" class="button-primary" value="' . $confirm . '">
					</div>
				';

				if ( isset( $_POST[ $row->$rdvId . '-to-confirm' ] ) ) {
					self::rdv_confirm(
						$dateObject,
						$row->$rdvSchedule,
						$row->$rdvFirstname,
						$row->$rdvLastname,
						$row->$rdvEmail,
						$row->$rdvPhone,
					);
					RdvQueriesClass::rdv_update_function( $row->$rdvId, true );
					echo '<meta http-equiv="REFRESH" content="0">';
				}

				if ( isset( $_POST['submit'] ) ) {
					if ( ! empty( $_POST[ $row->$rdvId . '-to-delete' ] ) && $row->$rdvIsConfirmed == 1 ) {
						RdvQueriesClass::rdv_delete_function( $row->$rdvId );
						echo '<meta http-equiv="REFRESH" content="0">';
					} elseif ( ! empty( $_POST[ $row->$rdvId . '-to-delete' ] ) && $row->$rdvIsConfirmed == 0 ) {
						echo '
						<hr>
						<div class="alert-delete-style">
						Vous n\'avez pas confirmé ce rendez-vous<br>
						Voulez-vous quand même le supprimer ?
							<div class="btn-alert-style">
								<input class="button-secondary" type="submit" id="' . $row->$rdvId . '-to-delete-alert" name="' . $row->$rdvId . '-to-delete-alert" value="Confirmer la suppression">
							</div>
						</div>
						';
					}
				}

				if ( isset( $_POST[ $row->$rdvId . '-to-delete-alert' ] ) ) {
					RdvQueriesClass::rdv_delete_function( $row->$rdvId );
					echo '<meta http-equiv="REFRESH" content="0">';
				}

				echo '</div>';
			}
			include_once 'rdv_footer_form.php';
		}

		/**
		 * @param $dateObject
		 * @param $schedule
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 * @param $phone
		 * Used for send the email confirmation.
		 */
		public static function rdv_confirm( $dateObject, $schedule, $firstname, $lastname, $email, $phone ) {
			$to      = $email;
			$subject = 'Confirmation de rendez-vous';
			$body    = '<h1>Confirmation de rendez-vous</h1>';
			$body    .= '<p>Bonjour, ' . $firstname . ' ' . $lastname . '.<br><br>';
			$body    .= 'Je vous confirme votre demande de rendez-vous pour le <i>' . date_format( $dateObject, 'd/m/y' ) . '</i> entre <i>' . $schedule . '.</i><br>';
			$body    .= 'Je vous contacterai via le numéro de téléphone suivant : <i>' . $phone . '</i>  lors de votre demande.</p><br>';
			$body    .= '<p>Cordialement,</p>';
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