<?php

if ( ! class_exists( 'RdvValidationClass' ) ):
	class RdvValidationClass {

		/**
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 * @param $message
		 * @param $phone
		 * @param $date
		 * @param $schedule
		 * Used for validate the fields.
		 */
		public static function validation_rdv( $firstname, $lastname, $email, $message, $phone, $date, $schedule ) {
			global $validation_errors;
			$validation_errors = new WP_Error();

			if ( empty( $firstname ) || empty( $lastname ) || empty( $email ) || empty( $message ) || empty( $phone ) || empty( $date ) || empty( $schedule ) ) {
				$validation_errors->add( 'field', 'Veuillez remplir tous les champs du formulaire' );
			}

			if ( ! is_email( $email ) && $email === false ) {
				$validation_errors->add( 'email_valid', 'L\'email saisie est invalide' );
			}

			if ( is_wp_error( $validation_errors ) ) {
				foreach ( $validation_errors->get_error_messages() as $error ) {
					echo '<div><strong>Erreur</strong>:<br>';
					echo $error . '<br></div>';
				}
			}

			if ( count( $validation_errors->get_error_messages() ) < 1 ) {
				echo '<div><p>Message envoyé ! Voulez-vous retourner à l\'<a href="' . get_site_url() . '">accueil</a> ?</p></div>';
			}
		}

		/**
		 * Used for call the insert function and the form creation.
		 * Sanitize the fields for improve security sql injections.
		 * Add the content of the fields in the insert function.
		 */
		public function rdv_submit_function() {
			$dateObject = date_create( $_POST['date'] );

			$firstname = sanitize_text_field( $_POST['firstname'] );
			$lastname  = sanitize_text_field( $_POST['lastname'] );
			$email     = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );
			$message   = sanitize_text_field( $_POST['message'] );
			$phone     = sanitize_text_field( $_POST['phone'] );
			$date      = $_POST['date'];
			$schedule  = $_POST['schedule'];
			$adminMail = 'admin@admin.fr';


			$to      = $adminMail;
			$subject = 'Demande de rendez-vous';
			$body    = '<h1>Rendez-vous</h1>';
			$body    .= '<p>' . $firstname . ' ' . $lastname . ' souhaite un rendez-vous le ' . date_format( $dateObject, 'd/m/y' ) . ' entre ' . $schedule . '.</p>';
			$body    .= '<hr>';
			$body    .= '<p>' . $message . '</p>';
			$header  = 'Content-Type: text/html' . "\r\n" . 'From:' . $email;

			if ( isset( $_POST['submit'] ) ) {
				self::validation_rdv(
					$firstname,
					$lastname,
					$email,
					$phone,
					$date,
					$schedule,
					$message
				);

				RdvQueriesClass::rdv_insert_function(
					$firstname,
					$lastname,
					$email,
					$phone,
					$date,
					$schedule,
					$message,
				);

				mail(
					$to,
					$subject,
					$body,
					$header
				);
			}

			include_once 'rdv_generate_form.php';
		}
	}
endif;