<?php
/**
 * Primary sidebar output.
 *
 * @package WordPress
 * @subpackage Controlled_Chaos_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;
do_action( 'amcd_before_sidebar' ); ?>
<aside class="sidebar primary">
    <?php do_action( 'amcd_before_sidebar_content' ); ?>
    <div class="sidebar-content">
        <?php do_action( 'amcd_before_sidebar_widgets' ); ?>
        <div class="sidebar-widgets">
            <?php dynamic_sidebar( 'primary-sidebar' ); ?>
        </div>
        <?php do_action( 'amcd_after_sidebar_widgets' ); ?>
    </div><!-- sidebar-content -->
    <?php do_action( 'amcd_after_sidebar_content' ); ?>
</aside>
<?php do_action( 'amcd_after_sidebar' ); ?>