<?php

include_once 'rdv_queries_class.php';

if ( ! class_exists( 'RdvSettingsClass' ) ):
	class RdvSettingsClass {
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

		public static function rdv_settings() {
			$sending   = 'rdv_sending';
			$receiving = 'rdv_receiving';

			include_once 'rdv_header_form.php';

			echo '
			<div class="div-setting-style">
			    <div>
			        <p>Je souhaite recevoir par email les demandes de rendez-vous :</p>';
			if ( RdvQueriesClass::rdv_select_settings()->$sending = '1' && RdvQueriesClass::rdv_select_settings()->$receiving = '1' ) {
				echo '
							        <div>
			            <input checked type="radio" id="yes-01" name="yes-no-01" class="radio-input">
			            <label for="yes-01">Oui</label>
			        </div>
			        <div>
			            <input type="radio" id="no-01" name="yes-no-01" class="radio-input">
			            <label for="no-01">Non</label>
			        </div>
				';
			} else {
				echo '
							        <div>
			            <input type="radio" id="yes-01" name="yes-no-01" class="radio-input">
			            <label for="yes-01">Oui</label>
			        </div>
			        <div>
			            <input checked type="radio" id="no-01" name="yes-no-01" class="radio-input">
			            <label for="no-01">Non</label>
			        </div>
				';
			}
			echo '
			    </div>
			    <div>
			        <p>Je souhaite envoyer un email automatique lorsque je valide un rendez-vous :</p>';
			if (RdvQueriesClass::rdv_select_settings()->$receiving = '1' && RdvQueriesClass::rdv_select_settings()->$receiving = '1'){
				echo '
			        <div>
			            <input checked type="radio" id="yes-02" name="yes-no-02" class="radio-input">
			            <label for="yes-02">Oui</label>
			        </div>
			        <div>
			            <input type="radio" id="no-02" name="yes-no-02" class="radio-input">
			            <label for="no-02">Non</label>
			        </div>
				';
			} else {
				echo '
							    </div>
			    <div>
			        <p>Je souhaite envoyer un email automatique lorsque je valide un rendez-vous :</p>
			        <div>
			            <input type="radio" id="yes-02" name="yes-no-02" class="radio-input">
			            <label for="yes-02">Oui</label>
			        </div>
			        <div>
			            <input checked type="radio" id="no-02" name="yes-no-02" class="radio-input">
			            <label for="no-02">Non</label>
			        </div>
				';
			}
			echo '
			        <br>
			        <hr>
			    </div>
			    <h3>Modifier le message d\'envoie par défaut</h3>
			    <table class="form-table-style">
			        <tbody>
			            <tr height="30">
			                <th scope="row">
			                    <label for="subject">Objet du message</label>
			                </th>
			                <td>
			                    <input type="text" id="subject" name="subject" class="large-text">
			                </td>
			            </tr>
			            <tr>
			                <th scope="row">
			                    <label for="title">Titre du message</label>
			                </th>
			                <td>
			                    <input type="text" id="title" name="title" class="large-text">
			                </td>
			            </tr>
			            <tr>
			                <th scope="row">
			                    <label for="body">Corps du message</label>
			                </th>
			                <td>
			                    <textarea id="body" name="body" rows="10" cols="50" class="large-text">
			
			                    </textarea>
			                </td>
			            </tr>
			        </tbody>
			    </table>
			</div>
			';

			include_once 'rdv_footer_form.php';
		}
	}
endif;