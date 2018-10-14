<?php
/**
 * Singular HTML output.
 *
 * @package WordPress
 * @subpackage Bloomosphere
 * @since Bloomosphere 1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'ACF_Pro' ) ) {
    $get_director    = get_field( 'amcd_project_director' );
    $get_client      = get_field( 'amcd_project_client' );
    $get_description = get_field( 'amcd_project_description' );
    $get_imdb        = get_field( 'amcd_project_imdb_page' );

    if ( $get_director ) {
        $director = sprintf( '<p class="entry-description"><strong>%1s</strong> %2s</p>', esc_html__( 'Directed by:', 'amcd-theme' ), $get_director );
    } else {
        $director = '';
    }
    if ( $get_client ) {
        $client = sprintf( '<p class="entry-description">%1s %2s</p>', esc_html__( 'Client:', 'amcd-theme' ), $get_client );
    } else {
        $client = '';
    }
    if ( $get_description ) {
        $description = $get_description;
    } else {
        $description = __( 'No description available for this project.', 'amcd-theme' );
    }
    if ( $get_imdb ) {
        $imdb = sprintf( '<p class="entry-imdb"><strong>%1s</strong> <a href="%2s" target="_blank">%3s</a></p>', esc_html__( 'IMDb page:' ), $get_imdb, $get_imdb );
    } else {
        $imdb = '';
    }
} else {
    $director    = '';
    $client      = '';
    $description = '';
    $imdb        = '';
} ?>

<article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
    <header class="entry-header">
        <?php echo the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <div class="entry-content single-project" itemprop="articleBody">
        <div class="entry-info">
            <?php echo $director; ?>
            <?php echo $imdb; ?>
            <?php echo $client;
            if ( $get_description ) { ?>
            <div class="entry-info-description">
                <p><strong><?php _e( 'Description:', 'amcd-theme' ); ?></strong></p>
                <?php echo $description; ?>
            </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        <?php if ( class_exists( 'ACF_Pro' ) ) {
            $get_vimeo = get_field( 'amcd_project_vimeo_id' );
            $image     = get_field( 'amcd_project_image' );
            $size      = 'video-large';
            $srcset    = wp_get_attachment_image_srcset( $image['ID'], $size );
            $width     = $image['sizes'][ $size . '-width' ];
            $height    = $image['sizes'][ $size . '-height' ];

            if ( ! empty( $get_vimeo ) ) {
                $vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $get_vimeo ) );
            } else {
                $vimeo_data = null;
            }

            if ( ! $vimeo_data ) {
                $vimeo = null;
            } else {
                $vimeo = $vimeo_data->video_id;
            }

            if ( $image ) {
                $thumb = $image['sizes'][ $size ];
            }

            if ( $get_vimeo ) { ?>
            <div class="single-feature-video">
                <?php echo sprintf( '<h3>%1s %2s</h3>', get_the_title(), esc_html__( 'Trailer', 'amcd-theme' ) ); ?>
                <iframe src="https://player.vimeo.com/video/<?php echo $vimeo; ?>?color=ffffff&title=0&byline=0&portrait=0" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            <div class="clearfix video-fix"></div>
            <?php } elseif ( ! $get_vimeo && $image ) {
                echo sprintf(
                    '<div class="single-feature-video"><img src="%1s" /></div>',
                    $thumb
                );
            }
        } // End if ACF ?>
        <?php if ( class_exists( 'ACF_Pro' ) ) {
        $gallery = get_field( 'amcd_project_gallery' );
        if ( $gallery ) { ?>
            <div class="entry-gallery feature-gallery" id="entry-gallery">
                <?php echo sprintf( '<h3>%1s %2s</h3>', get_the_title(), esc_html__( 'Gallery', 'amcd-theme' ) ); ?>
                <ul class="entry-gallery-list">
                <?php foreach( $gallery as $image ) : ?>
                    <li>
                        <figure>
                            <a data-type="image" data-fancybox="entry-gallery" data-caption="<?php echo $image['caption']; ?>" href="<?php echo $image['url']; ?>">
                                <img src="<?php echo $image['sizes']['medium']; ?>" />
                                <figcaption><span><?php echo $image['caption']; ?></span></figcaption>
                            </a>
                        </figure>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div><?php }
        } ?>
    </div><!-- entry-content -->
    <nav class="posts-nav posts-nav-bottom single-project-nav">
        <span class="next-post next-project" rel="next"><?php next_post_link( '%link', '%title', false ); ?></span>
        <span class="prev-post prev-project" rel="prev"><?php previous_post_link( '%link', '%title', false ); ?></span>
    </nav>
</article>