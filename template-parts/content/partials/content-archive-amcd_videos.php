<?php
/**
 * Videos archive HTML output.
 *
 * @package WordPress
 * @subpackage Bloomosphere
 * @since Bloomosphere 1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( have_posts() ) : ?>
<article class="global-wrapper" role="index">
    <ul class="video-grid videos"><?php while ( have_posts() ) : the_post();

    $client     = get_field( 'amcd_video_client' );
    $title      = get_field( 'amcd_video_title' );
    $director   = get_field( 'amcd_video_director' );
    $image      = get_field( 'amcd_video_thumbnail' );
    $vimeo      = get_field( 'amcd_video_vimeo_id' );
    $size       = 'video-medium';
    $thumb      = $image['sizes'][ $size ];
    $srcset     = wp_get_attachment_image_srcset( $image['ID'], $size );
    $width      = $image['sizes'][ $size . '-width' ];
    $height     = $image['sizes'][ $size . '-height' ];
    $vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $vimeo ) );

    if ( $image ) {
        $thumb = $image['sizes'][ $size ];
    } elseif ( $vimeo_data ) {
        $thumb = $vimeo_data->thumbnail_url;
    } else {
        $thumb = get_parent_theme_file_uri( '/assets/images/video-placeholder.jpg' );
    }

    if ( ! $vimeo_data ) {
        $vimeo = null;
    } else {
        $vimeo = $vimeo_data->video_id;
    }

    if ( $title && $director ) {
        $caption = $client . '<br />' . $title . '<br />Dirercted by ' . $director;
    } elseif ( $title ) {
        $caption = $client . '<br />' . $title;
    } elseif ( $director ) {
        $caption = $client . '<br />Dirercted by ' . $director;
    } else {
        $caption = $client . $title;
    }

    if ( $title ) {
        $heading = $client . ' | ' . $title;
    } else {
        $heading = $client;
    } ?>
        <li id="<?php echo 'video-' . get_the_ID(); ?>" class="video-video<?php if ( $director ) { echo ' video-has-director'; } ?>">
            <figure><a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank">
                <img src="<?php echo $thumb; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                <figcaption>
                    <?php
                    echo sprintf( '<h3 class="archives-image-title">%1s</h3>', $heading );
                    if ( $director ) {
                        echo sprintf( '<p class="archives-image-director video-director">Directed by %1s</p>', $director );
                    } ?>
                </figcaption>
            </a></figure>
        </li>
        <?php endwhile; ?>
    </ul>
</article>
<?php endif; ?>