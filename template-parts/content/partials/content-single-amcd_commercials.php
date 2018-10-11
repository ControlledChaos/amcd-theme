<?php
/**
 * Single commercial HTML output.
 *
 * @package WordPress
 * @subpackage Bloomosphere
 * @since Bloomosphere 1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

$get_client   = get_field( 'amcd_commercial_client' );
$get_title    = get_field( 'amcd_commercial_title' );
$get_director = get_field( 'amcd_commercial_director' );
$get_vimeo    = get_field( 'amcd_commercial_vimeo_id' );
$vimeo_data   = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $get_vimeo ) );

if ( ! $vimeo_data ) {
    $vimeo = null;
} else {
    $vimeo = $vimeo_data->video_id;
}

if ( $get_director ) {
    $director = sprintf( '<p class="single-project-director">%1s %2s</p>', esc_html__( 'Directed by' ), $get_director );
} else {
    $director = '';
}

?>
<article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
    <header class="entry-header">
        <?php echo apply_filters( 'amcd_singular_title', the_title( '<h1 class="entry-title">', '</h1>' ) ); ?>
    </header>
    <div class="entry-content single-project" itemprop="articleBody">
        <?php echo $director; ?>
        <div class="single-commercial-video">
            <iframe src="https://player.vimeo.com/video/<?php echo $vimeo; ?>?color=ffffff&title=0&byline=0&portrait=0" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
    </div><!-- entry-content -->
</article>