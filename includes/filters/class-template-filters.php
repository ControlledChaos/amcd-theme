<?php
/**
 * Template filters.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template filters.
 */
class Template_Filters {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

        add_filter( 'image_size_names_choose', [ $this, 'image_size_choose' ] );

    }

    /**
     * Image sizes to insert into posts.
     */
    public function image_size_choose( $size_names ) {

        global $_wp_additional_image_sizes;

		$sizes = [
            'thumbnail'     => esc_html__( 'Thumbnail', 'amcd-theme' ),
            'thumb-large'   => esc_html__( 'Large Thumb', 'amcd-theme' ),
            'thumb-x-large' => esc_html__( 'XL Thumb', 'amcd-theme' ),
			'medium'        => esc_html__( 'Medium', 'amcd-theme' ),
            'large'         => esc_html__( 'Large', 'amcd-theme' ),
            'video-small'   => esc_html__( 'Video Small', 'amcd-theme' ),
            'video-medium'  => esc_html__( 'Video Medium', 'amcd-theme' ),
            'video-large'   => esc_html__( 'Video Large', 'amcd-theme' ),
            'intro-small'   => esc_html__( 'Intro Small', 'amcd-theme' ),
            'intro-medium'  => esc_html__( 'Intro Medium', 'amcd-theme' ),
            'intro-large'   => esc_html__( 'Intro Large', 'amcd-theme' )
		];

		$insert_sizes = apply_filters( 'amcd_insert_image_sizes', $sizes );
		return $insert_sizes;

    }

}

new Template_Filters;