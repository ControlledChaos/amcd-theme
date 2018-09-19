<?php
/**
 * Site name meta
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'controlled_chaos_name_meta' ) ) :

	function controlled_chaos_name_meta() {
		bloginfo( 'name' );
	}

endif;