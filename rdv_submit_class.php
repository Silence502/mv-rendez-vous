<?php
require_once 'includes/managers/rdv_settings_manager.php';

if ( ! class_exists( 'RdvSubmitClass' ) ):
	class RdvSubmitClass {

		/**
		 * Used for call the insert function and the form creation.
		 * Sanitize the fields for improve security sql injections.
		 * Add the content of the fields in the insert function.
		 * @throws Exception
		 */
		public function rdv_submit_function() {
			$dateObject = date_create( $_POST['date'] );
			$emailCol   = 'rdv_msg_email';

			$firstname = sanitize_text_field( $_POST['firstname'] );
			$lastname  = sanitize_text_field( $_POST['lastname'] );
			$email     = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );
			$message   = sanitize_text_field( $_POST['message'] );
			$phone     = sanitize_text_field( $_POST['phone'] );
			$date      = $_POST['date'];
			$schedule  = $_POST['schedule'];
			$adminMail = RdvMessageManager::select()->$emailCol;


			if ( isset( $_POST['submit'] ) ) {
				RdvManagerClass::insert(
					$firstname,
					$lastname,
					$email,
					$phone,
					$date,
					$schedule,
					$message,
				);


				$rdvReceiving = 'rdv_receiving';

				if ( RdvSettingsManager::select()->$rdvReceiving ) {
					self::email_to_send( $adminMail, $firstname, $lastname, $dateObject, $schedule, $message, $email );
				}
			}

			include_once 'includes/rdv_generate_form.php';
		}

		public static function email_to_send( $adminMail, $firstname, $lastname, $dateObject, $schedule, $message, $email ) {
			$to      = $adminMail;
			$subject = 'Demande de rendez-vous';
			$body    = '<h1>Rendez-vous</h1>';
			$body    .= '<p>' . $firstname . ' ' . $lastname . ' souhaite un rendez-vous le ' . date_format( $dateObject, 'd/m/y' ) . ' entre ' . $schedule . '.</p>';
			$body    .= '<hr>';
			$body    .= '<p>' . $message . '</p>';
			$header  = 'Content-Type: text/html' . "\r\n" . 'From:' . $email;

			mail(
				$to,
				$subject,
				$body,
				$header
			);
		}
	}
endif;