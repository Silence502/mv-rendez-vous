<?php
require_once 'rdv_submit_class.php';

if ( ! class_exists( 'RdvShortCode' ) ):
	class RdvShortCode {
		/**
		 * @return false|string
		 * Used for adding a new shortcode to insert the form.
		 */
		public function rdv_shortcode() {
			ob_start();
			$validation = new RdvSubmitClass();
			$validation->rdv_submit_function();

			return ob_get_clean();
		}
	}
endif;