<?php

if ( ! class_exists( 'RdvValidationClass' ) ):
	class RdvValidationClass {

		/**
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 * @param $message
		 * Validate the fields.
		 */
		public function validation_rdv( $firstname, $lastname, $email, $message ) {
			global $validation_errors;
			$validation_errors = new WP_Error();

			if ( empty( $firstname ) || empty( $lastname ) || empty( $email ) || empty( $message ) ) {
				$validation_errors->add( 'field', 'Veuillez remplir tous les champs du formulaire' );
			}

			if ( ! is_email( $email ) ) {
				$validation_errors->add( 'email_valid', 'L\'email saisie est invalide' );
			}

			if ( is_wp_error( $validation_errors ) ) {
				foreach ( $validation_errors->get_error_messages() as $error ) {
					echo '<div><strong>Erreur</strong>:<br>';
					echo $error . '<br></div>';
				}
			}

			if ( count( $validation_errors->get_error_messages() ) < 1 ) {
				echo '<p>Message envoyé ! Voulez-vous retourner à l\'<a href="' . get_site_url() . '">accueil</a> ?</p>';
			}
		}

		/**
		 * Call the insert function and the form creation.
		 * Add the fields content in the insert function.
		 */
		public function rdv_submit_function() {
			if ( isset( $_POST['submit'] ) ) {
				$this->validation_rdv(
					$_POST['firstname'],
					$_POST['lastname'],
					$_POST['email'],
					$_POST['message']
				);

				$insert = new RdvQueriesClass();
				$insert->rdv_insert_function(
					$_POST['firstname'],
					$_POST['lastname'],
					$_POST['email'],
					$_POST['message']
				);
			}

			include_once 'rdv_generate_form.php';
		}
	}
endif;