<?php
/**
 * SSF update class
 *
 * @since  1.2.2
 * @package Swap Snow Fall
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * SSF_Update initial setup
 *
 * @since 1.2.2
 */
class SSF_Update {

	/**
	 * Option key for stored version number.
	 *
	 * @var instance
	 */
	private $db_version_key = '_swap_snow_fall_db_version';

	/**
	 * Constructor
	 */
	public function __construct() {

		// Plugin updates.
		if ( is_admin() ) {
			add_action( 'admin_init', array( $this, 'init' ), 5 );
		} else {
			add_action( 'wp', array( $this, 'init' ), 5 );
		}
	}

	/**
	 * Implement plugin update logic.
	 *
	 * @since 1.2.2
	 */
	public function init() {
		do_action( 'ssf_update_before' );

		if ( ! $this->needs_db_update() ) {
			return;
		}

		$this->update_db_version();

		do_action( 'ssf_update_after' );
	}

	/**
	 * Check if db upgrade is required.
	 *
	 * @since 1.2.2
	 * @return true|false True if stored database version is lower than constant; false if otherwise.
	 */
	private function needs_db_update() {
		$db_version = get_option( $this->db_version_key, false );

		if ( false === $db_version || version_compare( $db_version, SSF_VER, '!=' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Update DB version.
	 *
	 * @since 1.2.2
	 * @return void
	 */
	private function update_db_version() {
		update_option( '_swap_snow_fall_db_version', SSF_VER );
	}

}

new SSF_Update();
