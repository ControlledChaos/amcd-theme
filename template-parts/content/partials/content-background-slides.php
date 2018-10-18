<?php
/**
 * Front page HTML output.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

// Check for the Advanced Custom Fields plugin.
if ( class_exists( 'acf' ) ) :
    if ( have_rows( 'amcd_intro_slides' ) ) : ?>
    <div class="amcd-slider">
        <div id="slick-flexbox-fix"><!-- Stops SlickJS from getting original image rather than the intro-large size" -->
            <ul class="intro-slides">
                <?php while ( have_rows( 'amcd_intro_slides' ) ) : the_row();
                $image  = get_sub_field( 'amcd_intro_image' );
                $horz   = get_sub_field( 'amcd_intro_image_horz' );
			    $vert   = get_sub_field( 'amcd_intro_image_vert' );
                $size   = 'slide-large';
                $slide  = $image['sizes'][ $size ];
                $width  = $image['sizes'][ $size . '-width' ];
                $height = $image['sizes'][ $size . '-height' ];
                $srcset = wp_get_attachment_image_srcset( $image['ID'], $size );
                $position = $horz . ' ' . $vert; ?>
                <li class="slide" style="background-image: url(<?php echo $slide; ?>); background-position: <?php echo $position; ?>;"></li>
                <?php endwhile; ?>
            </ul>
            <div class="amcd-slider-overlay"></div>
        </div>
    </div>
    <?php endif;
endif;