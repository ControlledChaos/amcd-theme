<?php
/**
 * Body element tag.
 *
 * @package WordPress
 * @subpackage Controlled_Chaos_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit; ?>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="<?php do_action( 'amcd_body_schema' ); ?>">
