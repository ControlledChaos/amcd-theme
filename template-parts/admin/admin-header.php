<?php
/**
 * Admin header template.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Clean;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Site descrition, if any.
 */
$title       = get_bloginfo( 'name' );
$description = get_bloginfo( 'description' );

if ( ! empty( $title ) ) {
    $title = get_bloginfo( 'name' );
} else {
    $title = 'Alana Morshead';
}

if ( ! empty( $description ) ) {
    $description = get_bloginfo( 'description' );
} else {
    $description = __( 'Costume Designer', 'amcd-theme' );
} ?>
<header class="amcd-admin-header">
    <div class="admin-site-title-description">
        <p class="admin-site-title" itemprop="name"><a href="<?php echo admin_url(); ?>"><?php echo $title; ?></a></p>
        <p class="admin-site-description"><?php echo $description; ?></p>
    </div>
    <nav class="admin-navigation">
        <?php wp_nav_menu(
            array(
                'theme_location'  => 'admin',
                'container'       => false,
                'menu_id'         => 'admin-navigation-list',
                'menu_class'      => 'admin-navigation-list',
                'before'          => '',
                'after'           => '',
                'fallback_cb'     => ''
            )
        ); ?>
    </nav>
</header>