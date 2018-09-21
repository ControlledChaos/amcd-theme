<?php
/**
 * Site branding.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Conditional title tag.
 */
if ( is_front_page() && ! is_paged() ) {
    $title = sprintf( '<h1 class="site-title" itemprop="name">%1$s</h1>', get_bloginfo( 'name' ) );
} else {
    $title = sprintf( '<p class="site-title" itemprop="name"><a href="%1$s" rel="home">%2$s</a></p>', esc_url( home_url( '/' ) ), get_bloginfo( 'name' ) );
}
$site_title = apply_filters( 'amcd_site_title', $title );

/**
 * Site descrition, if any.
 */
$description = get_bloginfo( 'description' );
if ( ! empty( $description ) ) {
    $description = sprintf( '<p class="site-description" itemprop="description">%1s</p>', esc_html__( get_bloginfo( 'description' ) ) );
} else {
    $description = '';
}
$site_description = apply_filters( 'amcd_site_description', $description );

/**
 * Output header content.
 */
do_action( 'amcd_before_header_content' ); ?>
<header class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
    <div class="header-content global-wrapper header-wrapper">
        <div class="site-title-description">
            <?php echo $site_title, "\r"; ?>
            <?php echo $site_description, "\r"; ?>
        </div>
    </div><!-- header-content -->
</header>
<?php do_action( 'amcd_after_header_content' ); ?>