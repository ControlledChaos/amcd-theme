<?php
/**
 * Site branding.
 *
 * @package WordPress
 * @subpackage Controlled_Chaos_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

echo '</footer>', "\r";

do_action( 'amcd_after_footer' );