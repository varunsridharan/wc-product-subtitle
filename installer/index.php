<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\WC_Product_Subtitle\Installer' ) ) {
	/**
	 * Class Installer
	 *
	 * @package WC_Product_Subtitle
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 4.0
	 */
	class Installer {
		/**
		 * Triggers V4.0 Installer.
		 *
		 * @static
		 * @return bool
		 */
		public static function run_v4() {
			require_once __DIR__ . '/v4-installer.php';
			return \WC_Product_Subtitle\Installer\Version_4::run();
		}
	}
}
