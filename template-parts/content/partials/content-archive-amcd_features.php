<?php
/**
 * Film + TV archive HTML output.
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
    <ul class="video-grid features"><?php while ( have_posts() ) : the_post();

    $title    = get_the_title();
    $director = get_field( 'amcd_project_director' );
    $image    = get_field( 'amcd_project_image' );
    $vimeo    = get_field( 'amcd_project_vimeo_id' );
    $size     = 'video-medium';
    $srcset   = wp_get_attachment_image_srcset( $image['ID'], $size );
    $width    = $image['sizes'][ $size . '-width' ];
    $height   = $image['sizes'][ $size . '-height' ];
    $gallery  = get_field( 'amcd_project_gallery' );

    if ( $image ) {
        $thumb = $image['sizes'][ $size ];
    } else {
        $thumb = get_parent_theme_file_uri( '/assets/images/video-placeholder.jpg' );
    }

    if ( $title && $director ) {
        $caption = $title . '<br />Directed by ' . $director;
    } elseif ( $title ) {
        $caption = $title;
    } else {
        $caption = '';
    } ?>
        <li class="features-entry" id="<?php echo 'feature-' . get_the_ID(); ?>">
            <figure>
                <?php if ( $vimeo ) : ?><a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank"><?php endif; ?>
                    <img src="<?php echo $thumb; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                <?php if ( $vimeo ) : ?></a><?php endif; ?>
                <figcaption>
                    <?php echo sprintf( '<h3 class="archives-image-title">%1s</h3>', $title ); ?>
                    <ul>
                        <?php if ( $vimeo ) { ?><li class="grid-video-link"><a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank"><span><?php _e( 'Video', 'amcd-theme' ); ?></span></a></li><?php } ?>
                        <?php if ( $gallery ) {
                        $first_image = $gallery[0];
                        $url         = $first_image[url]; ?>
                        <li class="grid-gallery-link"><a href="<?php echo $url; ?>" data-fancybox="<?php echo 'gallery-' . get_the_ID(); ?>"><span><?php _e( 'Stills', 'amcd-theme' ); ?></span></a></li><?php } ?>
                        <li class="grid-details-link"><a href="<?php echo get_permalink(); ?>"><span><?php _e( 'Details', 'amcd-theme' ); ?></span></a></li>
                    </ul>
                </figcaption>
            </figure>
            <?php if ( $gallery ) { ?><div class="feature-archive-gallery" id="<?php echo 'gallery-' . get_the_ID(); ?>">
                <?php do_action( 'feature_galleries' ); ?>
            </div><?php } ?>
        </li>
        <?php endwhile; ?>
    </ul>
</article>
<?php endif; ?>