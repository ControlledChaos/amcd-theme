<?php
/**
 * Commercials archive HTML output.
 *
 * @package WordPress
 * @subpackage Bloomosphere
 * @since Bloomosphere 1.0.0
 */

namespace Bloomoshere;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

global $post;
$id       = $post->ID;
$client   = get_field( 'abcd_commercial_client' );
$title    = get_field( 'abcd_commercial_title' );
$director = get_field( 'abcd_commercial_director' );
$image    = get_field( 'abcd_commercial_thumbnail' );
$vimeo    = get_field( 'abcd_commercial_vimeo_id' );
$size     = 'Video Medium';
$thumb    = $image['sizes'][ $size ];
$srcset   = wp_get_attachment_image_srcset( $image['ID'], $size );
$width    = $image['sizes'][ $size . '-width' ];
$height   = $image['sizes'][ $size . '-height' ];

if ( $title && $director ) {
    $caption = $client . '<br />' . $title . '<br />Dir. ' . $director;
} elseif ( $title ) {
    $caption = $client . '<br />' . $title;
} elseif ( $director ) {
    $caption = $client . '<br />Dir. ' . $director;
} else {
    $caption = $client . $title;
}

if ( $title ) {
    $heading = $client . ' &ndash; ' . $title;
} else {
    $heading = $client;
} ?>
<li id="<?php echo 'commercial-' . $id; ?>">
    <figure><a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank">
        <img src="<?php echo $thumb; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
        <figcaption>
            <?php
            echo sprintf( '<h3 class="archives-image-title">%1s</h3>', $heading );
            if ( $director ) {
                echo sprintf( '<p class="archives-image-director">Dir. %1s</p>', $director );
            } ?>
        </figcaption>
    </a></figure>
</li>