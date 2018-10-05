<?php
/**
 * Film + TV archive HTML output.
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
$title    = get_the_title();
$director = get_field( 'amcd_project_director' );
$image    = get_field( 'amcd_project_image' );
$vimeo    = get_field( 'amcd_project_vimeo_id' );
$size     = 'video-medium';
$thumb    = $image['sizes'][ $size ];
$srcset   = wp_get_attachment_image_srcset( $image['ID'], $size );
$width    = $image['sizes'][ $size . '-width' ];
$height   = $image['sizes'][ $size . '-height' ];

if ( $title && $director ) {
    $caption = $title . '<br />Dir. ' . $director;
} elseif ( $title ) {
    $caption = $title;
} else {
    $caption = '';
} ?>
<li class="features-entry" id="<?php echo 'feature-' . $id; ?>">
    <figure><a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank">
        <img src="<?php echo $thumb; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
        <figcaption>
            <?php
            echo sprintf( '<h3 class="archives-image-title">%1s</h3>', $title );
            if ( $director ) {
                echo sprintf( '<p class="archives-image-director">Dir. %1s</p>', $director );
            } ?>
        </figcaption>
    </a></figure>
</li>