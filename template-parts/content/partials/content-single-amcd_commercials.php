<?php
/**
 * Single commercial HTML output.
 *
 * @package WordPress
 * @subpackage Bloomosphere
 * @since Bloomosphere 1.0.0
 */

namespace Bloomoshere;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

$get_client   = get_field( 'abcd_commercial_client' );
$get_title    = get_field( 'abcd_commercial_title' );
$get_director = get_field( 'abcd_commercial_director' );
$get_vimeo    = get_field( 'abcd_commercial_vimeo_id' );

if ( $get_director ) {
    $director = sprintf( '<p class="single-project-director">%1s %2s</p>', esc_html__( 'Directed by' ), $get_director );
} else {
    $director = '';
}

?>
<article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
    <header class="entry-header">
        <?php echo apply_filters( 'abcd_singular_title', the_title( '<h1 class="entry-title">', '</h1>' ) ); ?>
    </header>
    <div class="entry-content single-project" itemprop="articleBody">
        <?php echo $director; ?>
        <div class="single-embedded-video">
            <iframe src="https://player.vimeo.com/video/<?php echo $get_vimeo; ?>?color=ffffff&title=0&byline=0&portrait=0" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
    </div><!-- entry-content -->
</article>