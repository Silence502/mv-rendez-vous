<?php

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
			include_once 'rdv_header_form.php';

			echo '<div class="div-setting-style"><div>';
			echo '<p>Je souhaite recevoir par email les demandes de rendez-vous :</p>';
			echo '<div><input type="radio" id="yes-01" name="yes-no-01" class="radio-input">';
			echo '<label for="yes-0">Oui</label></div>';
			echo '<div><input type="radio" id="no-01" name="yes-no-01" class="radio-input">';
			echo '<label for="no-01">Non</label></div>';
			echo '</div>';
			echo '<div>';
			echo '<p>Je souhaite envoyer un email automatique lorsque je valide un rendez-vous :</p>';
			echo '<div><input type="radio" id="yes-02" name="yes-no-02" class="radio-input">';
			echo '<label for="yes-02">Oui</label></div>';
			echo '<div><input type="radio" id="no-02" name="yes-no-02" class="radio-input">';
			echo '<label for="no-02">Non</label></div>';
			echo '</div>';
			echo '<div>';
			echo '<p>Message d\'envoie par défaut :</p>';
			echo '<textarea 
			id="default-message-to-send" 
			name="default-message-to-send" rows="8" cols="50"></textarea>';
			echo '</div></div>';

			include_once 'rdv_footer_form.php';
		}
	}
endif;