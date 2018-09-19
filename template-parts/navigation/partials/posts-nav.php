<?php
/**
 * Blog pages standard navigation.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( is_search() ) {
    $prev = __( 'Previous Results', 'amcd-theme' );
    $next = __( 'More Results', 'amcd-theme' );
} else {
    $prev = __( 'Previous Page', 'amcd-theme' );
    $next = __( 'Next Page', 'amcd-theme' );
}

$prev_posts = apply_filters( 'amcd_prev_posts_label', sprintf( '<span>%1s</span>', $prev ) );
$next_posts = apply_filters( 'amcd_next_posts_label', sprintf( '<span>%1s</span>', $next ) );
?>
<nav class="posts-nav">
	<span class="prev-page" rel="prev"><?php previous_posts_link( $prev_posts ); ?></span>
	<span class="next-page" rel="next"><?php next_posts_link( $next_posts ); ?></span>
</nav>