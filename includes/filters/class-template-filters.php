<?php
/**
 * Template filters.
 *
 * @package WordPress
 * @subpackage Controlled_Chaos_Theme
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
			'thumbnail' => esc_html__( 'Thumbnail', 'amcd-theme' ),
			'medium'    => esc_html__( 'Medium', 'amcd-theme' ),
            'large'     => esc_html__( 'Large', 'amcd-theme' ),
            'banner'    => esc_html__( 'Banner', 'amcd-theme' ),
            'video'     => esc_html__( 'HD Video', 'amcd-theme' )
		];

		$insert_sizes = apply_filters( 'amcd_insert_image_sizes', $sizes );
		return $insert_sizes;

    }

}

new Template_Filters;