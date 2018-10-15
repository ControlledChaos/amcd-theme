<?php
/**
 * Main site navigation.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;
$before = apply_filters( 'amcd_main_nav_item_before', '<span class="main-nav-item-before"></span>' );
$after  = apply_filters( 'amcd_main_nav_item_after', '<span class="main-nav-item-after"></span>' );
$args   = [
        'menu'            => 'main',
        'menu_class'      => 'main-nav-menu-list',
        'menu_id'         => 'main-nav-menu-list',
        'container'       => false,
        'before'          => $before,
        'after'           => $after,
        'echo'            => true,
        'depth'           => 0,
        'theme_location'  => 'main',
        'item_spacing'    => 'preserve' // Accepts 'preserve' or 'discard'.
];

do_action( 'amcd_before_main_nav' ); ?>
<nav class="main-navigation" role="directory" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<div class="global-wrapper main-navigation-wrapper">
	<?php $menu_toggle = apply_filters( 'amcd_nav_toggle_text', esc_html__( 'Menu', 'amcd-theme' ) ); ?>
        <button id="menu-open" class="menu-open" aria-controls="main-nav-menu" aria-expanded="false"><?php echo $menu_toggle; ?></button>
        <div class="main-nav-menu">
            <button id="menu-close" class="menu-close"><?php echo esc_html__( 'Close', 'amcd-theme' ); ?></button>
            <?php wp_nav_menu( $args ); ?>
        </div>
	</div>
</nav>
<?php do_action( 'amcd_after_main_nav' ); ?>