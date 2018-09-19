<?php
/**
 * Footer opening tags and before footer actions.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

do_action( 'amcd_before_footer' );

echo '<footer>', "\r";