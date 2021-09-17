<?php
/**
 * SSF Frontend.
 *
 * @package SSF
 */

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

if ( ! class_exists( 'SSF_Frontend' ) ) {

	/**
	 * Class SSF_Frontend.
	 */
	class SSF_Frontend {

		/**
		 * Holds the values to be used in the fields callbacks
		 *
		 * @var array
		 * @since 1.1.0
		 */
		private $options;

		/**
		 * Constructor
		 *
		 * @since 1.1.0
		 * @return void
		 */
		function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_ssf_frontend_scripts' ) );
		}

		/**
		 * Enqueue style/script to fontend.
		 *
		 * @since 1.1.0
		 * @return void
		 */
		function enqueue_ssf_frontend_scripts() {
			$this->options = get_option( 'ssf_settings' );

			if ( isset( $this->options['ssf_disable_checkbox'] ) && 1 === (int) $this->options['ssf_disable_checkbox'] ) {
				return;
			}

			if ( isset( $this->options['ssf_display_rules_ids'] ) ) {

				$display = false;

				switch ( $this->options['ssf_display_rules'] ) {
					case 'select':
						$display = true;
						break;

					case 'basic-global':
						$display = true;
						break;

					case 'basic-singulars':
						$display = is_singular() ? true : false;
						break;

					case 'basic-archives':
						$display = is_archive() ? true : false;
						break;

					case 'special-404':
						$display = is_404() ? true : false;
						break;

					case 'special-search':
						$display = is_search() ? true : false;
						break;

					case 'special-front':
						$display = is_front_page() ? true : false;
						break;

					case 'special-date':
						$display = is_date() ? true : false;

						break;

					case 'special-author':
						$display = is_author() ? true : false;
						break;

					case 'post|all':
						$display = is_single() && 'post' === get_post_type() ? true : false;
						break;

					case 'post|all|archive':
						$display = is_archive() && 'post' === get_post_type() ? true : false;
						break;

					case 'post|all|taxarchive|category':
						$display = is_category() && 'post' === get_post_type() ? true : false;
						break;

					case 'post|all|taxarchive|post_tag':
						$display = is_tag() && 'post' === get_post_type() ? true : false;
						break;

					case 'page|all':
						$display = is_page() ? true : false;
						break;

					case 'specifics':
						if ( false !== $this->options['ssf_display_rules_ids'] ) {
							global $post;

							if ( strpos( $this->options['ssf_display_rules_ids'], ',' ) !== false ) {
								$ids_arr = explode( ',', $this->options['ssf_display_rules_ids'] );
								if ( in_array( $post->ID, $ids_arr ) ) { // // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
									$display = true;
								}
							} else {
								if ( (int) $this->options['ssf_display_rules_ids'] === $post->ID ) {
									$display = true;
								}
							}
						}
						break;

					default:
						break;
				}

				if ( false === $display ) {
					return;
				}
			}

			/**
			 * Compatibility of options with Plain Snow Fall JS.
			 *
			 * @since 1.3.1
			 */
			$particle_shape = isset( $this->options['ssf_particle_shape'] ) ? $this->options['ssf_particle_shape'] : 'circle';

			if ( isset( $this->options['ssf_select_position_dropdown'] ) && 'above-content' === $this->options['ssf_select_position_dropdown'] ) {
				switch ( $particle_shape ) {
					case 'circle':
						$particle_shape = '&bull;';
						break;
					case 'star':
						$particle_shape = '&sstarf;';
						break;
					case 'triangle':
						$particle_shape = '&blacktriangle;';
						break;
					case 'polygon':
						$particle_shape = '&#x2B20;';
						break;
					case 'edge':
						$particle_shape = '&#9632;';
						break;

					default:
						$particle_shape = '&bull;';
						break;
				}
			}

			$config_array = array(
				'ssf_url' => SSF_URL,
				'color'   => isset( $this->options['ssf_particle_color'] ) ? $this->options['ssf_particle_color'] : '#FFFFFF',
				'shape'   => $particle_shape,
				'number'  => isset( $this->options['ssf_particle_number'] ) ? $this->options['ssf_particle_number'] : '100',
			);

			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';

			$file_rtl = ( is_rtl() ) ? '-rtl' : '';
			$css_uri  = SSF_URL . 'assets/css/' . $dir_name . '/';

			if ( isset( $this->options['ssf_select_position_dropdown'] ) && 'above-content' === $this->options['ssf_select_position_dropdown'] ) {
				// Enqeue SSF Frontend JS.
				if ( SCRIPT_DEBUG ) {
					wp_enqueue_script( 'ssf-frontend-script', SSF_URL . 'assets/js/' . $dir_name . '/above-text-script' . $file_prefix . '.js', array(), SSF_VER );
				} else {
					wp_enqueue_script( 'ssf-frontend-script', SSF_URL . 'assets/js/' . $dir_name . '/frontend-above-content' . $file_prefix . '.js', array(), SSF_VER );
				}

				// Localize SSF JS.
				wp_localize_script( 'ssf-frontend-script', 'ssf_script', $config_array );

			} else {

				if ( SCRIPT_DEBUG ) {
					// Enqeue SSF Frontend CSS.
					wp_enqueue_style( 'ssf-frontend-style' . $file_rtl, $css_uri . 'style' . $file_prefix . $file_rtl . '.css', array(), SSF_VER, 'all' );
					// Enqeue Particle JS.
					wp_enqueue_script( 'ssf-frontend-particle-script', SSF_URL . 'assets/js/' . $dir_name . '/particles' . $file_prefix . '.js', array(), SSF_VER );
					// Enqeue SSF Frontend JS.
					wp_enqueue_script( 'ssf-frontend-script', SSF_URL . 'assets/js/' . $dir_name . '/background-script' . $file_prefix . '.js', array(), SSF_VER );
				} else {
					// Enqeue SSF Frontend CSS.
					wp_enqueue_style( 'ssf-frontend-style' . $file_rtl, $css_uri . 'style' . $file_prefix . $file_rtl . '.css', array(), SSF_VER, 'all' );
					// Enqeue SSF Frontend JS.
					wp_enqueue_script( 'ssf-frontend-script', SSF_URL . 'assets/js/' . $dir_name . '/frontend-particle' . $file_prefix . '.js', array(), SSF_VER );
				}
				// Localize SSF JS.
				wp_localize_script( 'ssf-frontend-script', 'ssf_script', $config_array );
			}
		}
	}
	/**
	 *  Kick off the class - SSF_Frontend.
	 */
	new SSF_Frontend;
}
