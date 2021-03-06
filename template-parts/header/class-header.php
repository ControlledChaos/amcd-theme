<?php
/**
 * Header HTML template.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Header HTML template.
 */
class Header {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {

        add_action( 'amcd_header', [ $this, 'partials' ] );

    }

    /**
	 * Header partials.
     *
     * @since  1.0.0
	 */
    public function partials() {

        // Site branding and before/after header content actions.
        get_template_part( 'template-parts/header/partials/site-branding' );

        // Main navigation menu.
        get_template_part( 'template-parts/navigation/partials/navigation', 'main' );

    }

}

// Run the Header class.
new Header;