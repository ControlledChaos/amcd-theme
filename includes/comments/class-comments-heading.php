<?php
/**
 * Post comments form heading.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Post comments form heading.
 */
class AMCD_Theme_Comments_Heading {

    /**
	 * Constructor magic method.
	 */
    public function __construct() {

        // Heading text.
        $this->heading();

    }

    /**
     * Heading text.
     * 
     * @since  1.0.0
     */
    public static function heading() {

        $comments_number = get_comments_number();
        
        if ( 1 === $comments_number ) {
            $comments_heading = sprintf( _x( 'One comment on %1s', 'comments title', 'amcd-theme' ), get_the_title() );
        } else {
            $comments_heading = sprintf(
                _nx(
                    '%1s Comment on %2s',
                    '%1s Comments on %2s',
                    $comments_number,
                    'comments title',
                    'amcd-theme'
                ),
                number_format_i18n( $comments_number ),
                get_the_title()
            );
        }

        return $comments_heading;

    }

}

$controlled_chaos_comments_heading = new AMCD_Theme_Comments_Heading;