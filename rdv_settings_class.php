<?php

if ( ! class_exists( 'RdvSettingsClass' ) ):
	class RdvSettingsClass {

		/**
		 *
		 */
		public static function rdv_submenu_page() {
			add_submenu_page(
				'rdv-management',
				'Paramètres',
				'Paramètres',
				'manage_options',
				'rdv-settings',
				array( 'RdvSettingsClass', 'rdv_settings' ),
				1
			);
		}

		/**
		 *
		 */
		public static function rdv_settings() {
			require_once 'rdv_settings_manager.php';
			require_once 'includes/rdv_message_manager.php';
			$selectSettings  = RdvSettingsManager::select();
			$selectMessage   = RdvMessageManager::select();
			$sending         = 'rdv_sending';
			$receiving       = 'rdv_receiving';
			$rdvSettingsId   = 'rdv_settings_id';
			$sending_param   = 1;
			$receiving_param = 1;
			$rdvMsgId        = 'rdv_msg_id';
			$rdvMsgSubject   = 'rdv_msg_subject';
			$rdvMsgTitle     = 'rdv_msg_title';
			$rdvMsgBody      = 'rdv_msg_body';

			include_once 'includes/rdv_header_form.php';

			echo '
			<div class="div-setting-style">
			    <div>
			        <p>Je souhaite recevoir par email les demandes de rendez-vous :</p>';
			if ( $selectSettings->$receiving ) {
				echo '
							        <div>
			            <input checked type="radio" id="yes-01" name="yes-no-01" class="radio-input" value="yes"> Oui
			        </div>
			        <div>
			            <input type="radio" id="no-01" name="yes-no-01" class="radio-input" value="no"> Non
			        </div>
				';
			} else {
				echo '
							        <div>
			            <input type="radio" id="yes-01" name="yes-no-01" class="radio-input" value="yes"> Oui
			        </div>
			        <div>
			            <input checked type="radio" id="no-01" name="yes-no-01" class="radio-input" value="no"> Non
			        </div>
				';
			}
			echo '
			    </div>
			    <div>
			        <p>Je souhaite envoyer un email automatique lorsque je valide un rendez-vous :</p>';
			if ( $selectSettings->$sending ) {
				echo '
			        <div>
			            <input checked type="radio" id="yes-02" name="yes-no-02" class="radio-input" value="yes"> Oui
			        </div>
			        <div>
			            <input type="radio" id="no-02" name="yes-no-02" class="radio-input" value="no"> Non
			        </div>
				';
			} else {
				echo '
			        <div>
			            <input type="radio" id="yes-02" name="yes-no-02" class="radio-input" value="yes"> Oui
			        </div>
			        <div>
			            <input checked type="radio" id="no-02" name="yes-no-02" class="radio-input" value="no"> Non
			        </div>
				';
			}
			echo '
			        <br>
			        <hr>
			    </div>
			    <h3>Modifier le message automatique par défaut</h3>
			    <table class="form-table-style">
			        <tbody>
			            <tr height="30">
			                <th scope="row">
			                    <label for="subject">Objet du message</label>
			                </th>
			                <td>
			                    <input type="text" id="subject" name="subject" class="large-text"
			                    value="' . $selectMessage->$rdvMsgSubject . '"
			                </td>
			            </tr>
			            <tr>
			                <th scope="row">
			                    <label for="title">Titre du message</label>
			                </th>
			                <td>
			                    <input type="text" id="title" name="title" class="large-text"
			                    value="' . $selectMessage->$rdvMsgTitle . '">
			                </td>
			            </tr>
			            <tr>
			                <th scope="row">
			                    <label for="body">Corps du message</label>
			                </th>
			                <td>
			                    <textarea id="body" name="body" rows="10" cols="50" class="large-text">' . $selectMessage->$rdvMsgBody . '</textarea>
			                </td>
			            </tr>
			        </tbody>
			    </table>
			</div>
			';

			include_once 'includes/rdv_footer_form.php';

			if ( isset( $_POST['submit'] ) ) {
				if ( $_POST['yes-no-01'] === 'yes' && $_POST['yes-no-02'] === 'yes' ) {
					RdvSettingsManager::update( $selectSettings->$rdvSettingsId, true, true );
				} elseif ( $_POST['yes-no-01'] === 'yes' && $_POST['yes-no-02'] === 'no' ) {
					RdvSettingsManager::update( $selectSettings->$rdvSettingsId, false, true );
				} elseif ( $_POST['yes-no-01'] === 'no' && $_POST['yes-no-02'] === 'yes' ) {
					RdvSettingsManager::update( $selectSettings->$rdvSettingsId, true, false );
				} elseif ( $_POST['yes-no-01'] === 'no' && $_POST['yes-no-02'] === 'no' ) {
					RdvSettingsManager::update( $selectSettings->$rdvSettingsId, false, false );
				}

				//TODO: Faire l'update pour la table message.
				echo '<meta http-equiv="REFRESH" content="0">';
			}
		}
	}
endif;