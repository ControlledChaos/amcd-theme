<?php
/**
 * Singular HTML output.
 *
 * @package WordPress
 * @subpackage Bloomosphere
 * @since Bloomosphere 1.0.0
 */

namespace Bloomoshere;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'ACF_Pro' ) ) {
    $get_director    = get_field( 'amcd_project_director' );
    $get_client      = get_field( 'amcd_project_client' );
    $get_description = get_field( 'amcd_project_description' );
    $get_imdb        = get_field( 'amcd_project_imdb_page' );
    $get_poster      = get_field( 'amcd_project_poster' );

    if ( $get_director ) {
        $director = sprintf( '<p class="entry-description">%1s %2s</p>', esc_html__( 'Directed by:', 'amcd-theme' ), $get_director );
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
        $imdb = sprintf( '<p>%1s <a href="%2s" target="_blank">%3s</a></p>', esc_html__( 'IMDb page:' ), $get_imdb, $get_imdb );
    } else {
        $imdb = '';
    }
    if ( ! empty ( $get_poster ) ) {
        $title   = get_the_title();
        $image   = get_field( 'amcd_project_poster' );
        $url     = $image['url'];
        $size    = 'Poster Large';
        $thumb   = $image['sizes'][ $size ];
        $caption = $title . __( ' Poster' );
        $srcset  = wp_get_attachment_image_srcset( $image['ID'], $size );
        $poster  = sprintf( '<a data-fancybox data-caption="%1s" href="%2s"><img class="project-poster" src="%3s" srcset="%4s" sizes="(max-width: 2048px) 360px, 640px" /></a>', esc_attr( $caption ), esc_attr( $url ), esc_attr( $thumb ), esc_attr( $srcset ) );
    } else {
        $poster = '';
    }
} else {
    $director    = '';
    $client      = '';
    $description = '';
    $imdb        = '';
    $poster      = '';
} ?>

<article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
    <header class="entry-header">
        <?php echo the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <div class="entry-content single-project" itemprop="articleBody">
        <div class="entry-info">
            <?php echo $poster; ?>
            <?php echo $director; ?>
            <?php echo $client; ?>
            <?php echo $description; ?>
            <?php echo $imdb; ?>
        </div>
        <div class="clearfix"></div>
        <?php if ( class_exists( 'ACF_Pro' ) ) {
        $video = get_field( 'amcd_project_vimeo_id' );
        if ( $video ) { ?>
        <div class="single-feature-video">
            <?php echo sprintf( '<h3>%1s %2s</h3>', get_the_title(), esc_html__( 'Trailer', 'amcd-theme' ) ); ?>
            <iframe src="https://player.vimeo.com/video/<?php echo $video; ?>?color=ffffff&title=0&byline=0&portrait=0" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <div class="clearfix video-fix"></div><?php }
        } ?>
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
                                <img src="<?php echo $image['sizes']['Video Medium']; ?>" />
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