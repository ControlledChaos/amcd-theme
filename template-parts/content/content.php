<?php
/**
 * Content HTML template.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Content HTML template.
 */
class Content {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {

        $this->partials();

    }

    /**
	 * Content partials.
     *
     * @since  1.0.0
	 */
    public function partials() {

        $contact_page = get_page_by_path( 'contact' );
		$contact_id   = $contact_page->ID;

        if ( is_front_page() && is_home() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'home' );
        } elseif ( is_front_page() && class_exists( 'ACF_Pro' ) && is_page_template( 'page-templates/front-page-background-slides.php' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'background-slides' );
        } elseif ( is_front_page() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'front-page' );
        } elseif ( is_home() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'home' );
        } elseif ( is_post_type_archive( 'amcd_features' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content-archive', 'amcd_features' );
        } elseif ( is_post_type_archive( 'amcd_commercials' ) ) {
			$partial = get_template_part( 'template-parts/content/partials/content-archive', 'amcd_commercials' );
		} elseif ( is_post_type_archive( 'amcd_videos' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content-archive', 'amcd_videos' );
        } elseif ( is_archive() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'archive' );
        } elseif ( is_search() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'search' );
        } elseif ( is_singular( 'amcd_features' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content-single', 'amcd_features' );
        } elseif ( is_singular( 'amcd_commercials' ) ) {
			$partial = get_template_part( 'template-parts/content/partials/content-single', 'amcd_commercials' );
		} elseif ( is_singular( 'amcd_videos' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content-single', 'amcd_videos' );
        } elseif ( class_exists( 'ACF_Pro' ) && ( is_page_template( 'page-templates/page-contact.php' ) || is_page( $contact_page->ID ) ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'page-contact' );
        } else {
            $partial = get_template_part( 'template-parts/content/partials/content', 'singular' );
        }

        $content = apply_filters( 'amcd_content_part', $partial );

        echo $content;

    }

}

new Content;