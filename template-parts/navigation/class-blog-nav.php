<?php
/**
 * Blog pages navigation.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Blog pages navigation.
 */
class Blog_Nav {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {
		
		add_action( 'amcd_before_footer', [ $this, 'nav' ], 20 );

	}
	
	/**
	 * Get navigation style.
	 */
	public function nav() {

		if ( 'numeric' == amcd_sanitize_blog_navigation_format( get_theme_mod( 'amcd_blog_navigation_format' ) ) ) {
			get_template_part( 'template-parts/navigation/partials/numeric-nav' );
		} else {
			get_template_part( 'template-parts/navigation/partials/posts-nav' );
		}

	}

}

new Blog_Nav;