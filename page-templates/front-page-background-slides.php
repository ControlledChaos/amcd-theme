<?php
/**
 * Front page with background slides
 *
 * Template Name: Background Slides
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since 1.0.0
 */
namespace AMCD_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

class Background_Slides {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

		// Begin HTML and get <head> section.
		get_header();

		// Content templates.
		require get_theme_file_path( '/template-parts/content/content.php' );

		// Load scripts and close HTML.
		get_footer();

	}

}

// Run the Background_Slides class.
new Background_Slides;