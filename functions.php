<?php
/**
 * Controlled Chaos Theme functions.
 *
 * @package    WordPress
 * @subpackage AMCD_Theme
 * @author     Greg Sweet <greg@ccdzine.com>
 * @copyright  Copyright (c) 2017 - 2018, Greg Sweet
 * @link       https://github.com/ControlledChaos/amcd-theme-theme
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 * @since      Controlled Chaos 1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Controlled Chaos functions class.
 *
 * @since  1.0.0
 * @access public
 */
final class Functions {

	/**
	 * Return the instance of the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {

			$instance = new self;

			// Class hook functions.
			$instance->hooks();

			// Class filter functions.
			$instance->filters();

			// Theme dependencies.
			$instance->dependencies();

		}

		return $instance;
	}

	/**
	 * Constructor magic method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {}

	/**
	 * Hooks and filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function hooks() {

		// Swap html 'no-js' class with 'js'.
		add_action( 'wp_head', [ $this, 'js_detect' ], 0 );

		// Controlled Chaos theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Disable custom colors in the editor.
		add_action( 'after_setup_theme', [ $this, 'editor_custom_color' ] );

		// Remove unpopular meta tags.
		add_action( 'init', [ $this, 'head_cleanup' ] );

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Admin scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );

		/**
		 * Admin styles.
		 *
		 * Call late to override plugin styles.
		 */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ], 99 );

		// Login styles.
		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );

	}

	/**
	 * Hooks and filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function filters() {

		// jQuery UI fallback for HTML5 Contact Form 7 form fields.
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

		// Remove WooCommerce styles.
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	}

	/**
	 * Replace 'no-js' class with 'js' in the <html> element when JavaScript is detected.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function js_detect() {

		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

	}

	/**
	 * Theme setup.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {

		/**
		 * Load domain for translation.
		 *
		 * @since 1.0.0
		 */
		load_theme_textdomain( 'amcd-theme' );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// Background color & image support.
		add_theme_support( 'custom-background' );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// HTML 5 tags support.
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gscreenery',
			'caption'
		 ] );

		// Register post formats.
		add_theme_support( 'post-formats', [
			'aside',
			'gscreenery',
			'video',
			'image',
			'audio',
			'link',
			'quote',
			'status',
			'chat'
		 ] );

		/**
		 * Add editor support.
		 *
		 * @since 1.0.0
		 */

		/**
		 * Color arguments.
		 *
		 * Some WordPress admin colors used here for demonstration.
		 */
		$color_args = [
			[
				'name'  => __( 'WordPress Dark Gray', 'amcd-theme' ),
				'slug'  => 'amcd-wp-dark-gray',
				'color' => '#23282d',
			],
			[
				'name'  => __( 'WordPress Gray', 'amcd-theme' ),
				'slug'  => 'amcd-wp-gray',
				'color' => '#32373c',
			],
			[
				'name'  => __( 'WordPress Pale Gray', 'amcd-theme' ),
				'slug'  => 'amcd-wp-pale-gray',
				'color' => '#edeff0',
			],
			[
				'name'  => __( 'White', 'amcd-theme' ),
				'slug'  => 'amcd-white',
				'color' => '#fff',
			],
			[
				'name'  => __( 'WordPress Medium Blue', 'amcd-theme' ),
				'slug'  => 'amcd-wp-medium-blue',
				'color' => '#0085ba',
			],
			[
				'name'  => __( 'WordPress Light Blue', 'amcd-theme' ),
				'slug'  => 'amcd-wp-light-blue',
				'color' => '#00a0d2',
			],
			[
				'name'  => __( 'WordPress Success Green', 'amcd-theme' ),
				'slug'  => 'amcd-wp-success-green',
				'color' => '#46b450',
			],
			[
				'name'  => __( 'WordPress Error Red', 'amcd-theme' ),
				'slug'  => 'amcd-wp-error-red',
				'color' => '#dc3232',
			],
			[
				'name'  => __( 'WordPress Warning Yellow', 'amcd-theme' ),
				'slug'  => 'amcd-wp-warning-yellow',
				'color' => '#ffb900',
			]
		];

		// Apply a filter to editor arguments.
		$colors = apply_filters( 'amcd_editor_colors', $color_args );

		// Add color support.
		add_theme_support( 'editor-color-palette', $colors );

		add_theme_support( 'align-wide' );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */

		// Customizer widget refresh support.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		// TODO: add Fancybox to WC products.
		// add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Beaver Builder support.
		add_theme_support( 'fl-theme-builder-headers' );
		add_theme_support( 'fl-theme-builder-footers' );
		add_theme_support( 'fl-theme-builder-parts' );

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add image sizes.
		 *
		 * Three sizes per aspect ratio so that WordPress
		 * will use srcset for responsive images.
		 *
		 * @since 1.0.0
		 */

		// 16:9 HD Video.
		add_image_size( __( 'video', 'amcd-theme' ), 1280, 720, true );
		add_image_size( __( 'video-md', 'amcd-theme' ), 960, 540, true );
		add_image_size( __( 'video-sm', 'amcd-theme' ), 640, 360, true );

		// 21:9 Cinemascope.
		add_image_size( __( 'banner', 'amcd-theme' ), 1280, 549, true );
		add_image_size( __( 'banner-md', 'amcd-theme' ), 960, 411, true );
		add_image_size( __( 'banner-sm', 'amcd-theme' ), 640, 274, true );

		// Add image size for meta tags if companion plugin is not activated.
		if ( ! is_plugin_active( 'amcd-theme-plugin/amcd-theme-plugin.php' ) ) {
			add_image_size( __( 'Meta Image', 'amcd-theme' ), 1200, 630, true );
		}

		/**
		 * Add header image support.
		 *
		 * @since 1.0.0
		 */

		// Header arguments.
		$header_args = [
			'default-image'          => '',
			'width'                  => 1280,
			'height'                 => 549,
			'flex-height'            => true,
			'flex-width'             => true,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => '',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		];

		// Apply a filter to header arguments.
		$header = apply_filters( 'amcd_header_image', $header_args );

		// Add header support.
		add_theme_support( 'custom-header', $header );

		/**
		 * Add logo support.
		 *
		 * @since 1.0.0
		 */

		// Custom logo support.
		$logo_args = [
			'width'       => 180,
			'height'      => 180,
			'flex-width'  => true,
			'flex-height' => true
		];

		// Apply a filter to logo arguments.
		$logo = apply_filters( 'amcd_header_image', $logo_args );

		// Add logo support.
		add_theme_support( 'custom-logo', $logo );

		 /**
		 * Set content width.
		 *
		 * @since 1.0.0
		 */

		if ( ! isset( $content_width ) ) {
			$content_width = 1280;
		}

		/**
		 * Register theme menus.
		 *
		 * @since  1.0.0
		 */
		register_nav_menus( [
			'main'   => __( 'Main Menu', 'amcd-theme' ),
			'footer' => __( 'Footer Menu', 'amcd-theme' ),
			'social' => __( 'Social Menu', 'amcd-theme' )
		] );

		/**
		 * Add stylesheet for the content editor.
		 *
		 * @since 1.0.0
		 */
		add_editor_style( '/assets/css/editor-style.css', [ 'amcd-admin' ], '', 'screen' );

		/**
		 * Disable Jetpack open graph. We have the open graph tags in the theme.
		 *
		 * @since 1.0.0
		 */
		if ( class_exists( 'Jetpack' ) ) {
			add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );
		}

	}

	/**
	 * Theme support for disabling custom colors in the editor.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool Returns true for the color picker.
	 */
	public function editor_custom_color() {

		$disable = add_theme_support( 'disable-custom-colors', [] );

		// Apply a filter for conditionally disabling the picker.
		$custom_colors = apply_filters( 'amcd_editor_custom_colors', '__return_false' );

		return $custom_colors;

	}

	/**
	 * Clean up meta tags from the <head>.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function head_cleanup() {

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_site_icon', 99 );
	}

	/**
	 * Frontend scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {

		wp_enqueue_script( 'jquery' );

		// HTML 5 support.
		wp_enqueue_script( 'amcd-html5',  get_theme_file_uri( '/assets/js/html5.min.js' ), [], '' );
		wp_script_add_data( 'amcd-html5', 'conditional', 'lt IE 9' );

		// Comments scripts.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	/**
	 * Admin scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {}

	/**
	 * Frontend styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {

		// Theme sylesheet.
		wp_enqueue_style( 'amcd-style',      get_stylesheet_uri(), [], '', 'screen' );

		$google = checkdnsrr( 'google.com' );

		if ( $google ) {
			wp_enqueue_style( 'amcd-fonts', 'https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Source+Code+Pro:200,300,400,500,600,700,900', [], '', 'screen' );
		}

	}

	/**
	 * Admin styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_styles() {}

	/**
	 * Login styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function login_styles() {

		wp_enqueue_style( 'amcd-theme-login', get_theme_file_uri( '/assets/css/login.css' ), [], '', 'screen' );

	}

	/**
	 * Theme dependencies.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// Set up the <head> element.
		require_once get_theme_file_path( '/includes/head/class-head.php' );

		// Set up Scema attributes for the <body> element.
		require_once get_theme_file_path( '/includes/template-tags/class-body-schema.php' );

		// Get template tags.
		require_once get_theme_file_path( '/includes/template-tags/template-tags.php' );

		// Get template filters.
		include get_theme_file_path( '/includes/filters/class-template-filters.php' );

		// Blog navigation.
		if ( ! is_singular() ) {
			require get_theme_file_path( '/template-parts/navigation/class-blog-nav.php' );
		}

	}

}

/**
 * Gets the instance of the Functions class.
 *
 * This function is useful for quickly grabbing data
 * used throughout the theme.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function amcd_theme() {

	$amcd_theme = Functions::get_instance();

	return $amcd_theme;

}

// Run the Functions class.
amcd_theme();