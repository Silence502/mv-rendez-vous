<?php

if ( ! class_exists( 'RdvShortCode' ) ):
	class RdvShortCode {
		/**
		 * @return false|string
		 * Add a new shortcode to insert the form.
		 */
		public function rdv_shortcode() {
			ob_start();
			$validation = new RdvValidationClass();
			$validation->rdv_submit_function();

			return ob_get_clean();
		}
	}
endif;