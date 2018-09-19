<?php
/**
 * Standard meta tags.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

global $post; ?>

<meta name="title" content="<?php do_action( 'controlled_chaos_meta_title' ); ?>" />
<meta name="description" content="<?php do_action( 'controlled_chaos_meta_description' ); ?>" />
<meta name="author" content="<?php do_action( 'controlled_chaos_meta_author' ); ?>" />
