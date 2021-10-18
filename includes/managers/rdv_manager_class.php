<?php
require_once plugin_dir_path( __DIR__ ) . 'dal/rdv_dao_factory.php';

if ( ! class_exists( 'RdvManagerClass' ) ):
	class RdvManagerClass {

		/**
		 * @param $firstname
		 * @param $lastname
		 * @param $email
		 * @param $phone
		 * @param $date
		 * @param $schedule
		 * @param $message
		 * Used for the 'insert' query through the DAO factory.
		 *
		 * @throws Exception
		 */
		public static function insert( $firstname, $lastname, $email, $phone, $date, $schedule, $message ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			global $validation_errors;
			$validation_errors = new WP_Error();

			if ( empty( $firstname ) || empty( $lastname ) || empty( $email ) || empty( $message ) || empty( $phone ) || empty( $date ) || empty( $schedule ) ) {
				$validation_errors->add( 'field', 'Veuillez remplir tous les champs du formulaire' );
			}

			if ( ! is_email( $email ) && $email === false ) {
				$validation_errors->add( 'email_valid', 'L\'email saisie est invalide' );
			}

			if ( date_create( $date ) <= new DateTime() ) {
				$validation_errors->add('date_valid', 'Date invalide. Veuillez sélectionner une date supérieure à celle d\'aujourd\'hui');
			}

			if ( strlen($message) > 255 ) {
			    $validation_errors->add('message_valid', 'Vous avez dépassé le nombre de caractères autorisé');
            }

			if ( is_wp_error( $validation_errors ) ) {
				foreach ( $validation_errors->get_error_messages() as $error ) {
					echo '<div style="color: red"><strong>Il y a un problème</strong>:<br>';
					echo $error . '<br></div>';
				}
			}

			if ( count( $validation_errors->get_error_messages() ) < 1 ) {
				echo '<div><strong>Message envoyé ! Voulez-vous retourner à l\'<a href="' . get_site_url() . '">accueil</a> ?</strong></div>';
				$rdvDAO->rdv_insert_function( $firstname, $lastname, $email, $phone, $date, $schedule, $message );
			}
		}

		/**
		 * @return array|mixed|object|null
		 * Used for the 'select' query for all data through the DAO factory.
		 * @throws Exception
		 */
		public static function selectAll() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_function();
		}

		/**
		 * @return array|object|null
		 * Used for the 'select' query through isConfirmed=true through the DAO factory.
		 * @throws Exception
		 */
		public static function selectByConfirmed() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_confirmed_function();
		}

		/**
		 * @return array|object|null
		 * Used for the 'select' query through isConfirmed=false through the DAO factory.
		 * @throws Exception
		 */
		public static function selectByToConfirm() {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();

			return $rdvDAO->rdv_select_to_confirm_function();
		}

		/**
		 * @param $id
		 * @param $checked
		 * Used for the 'update' query through the DAO factory.
		 *
		 * @throws Exception
		 */
		public static function update( $id, $checked ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_update_function( $id, $checked );
		}

		/**
		 * @param $id
		 * Used for the 'delete' query through the DAO factory.
		 *
		 * @throws Exception
		 */
		public static function delete( $id ) {
			$rdvDAO = RdvDAOFactory::getRdvQueriesClass();
			$rdvDAO->rdv_delete_function( $id );
		}
	}
endif;