<?php

if (! class_exists('RdvValidationClass')):
class RdvValidationClass {

	/**
	 * @param $firstname
	 * @param $lastname
	 * @param $email
	 * @param $message
	 * @param $phone
	 * @param $date
	 * @param $schedule
	 * Used for validating the fields.
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
}
endif;