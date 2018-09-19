<?php
/**
 * Customizer blog controls.
 *
 * @package WordPress
 * @subpackage Controlled_Chaos_Theme
 * @since  1.0.0
 */

// Do not namespace this class.

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Customizer blog controls.
 */
class Customizer_Blog {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {

        // Blog panel.
		add_action( 'customize_register', [ $this, 'blog' ] );

    }

    /**
     * Blog panel.
     */
    public function blog( $wp_customize ) {

        /**
		 * Framework settings panel.
		 */
		$wp_customize->add_section( 'amcd_customizer_blog', [
			'priority'    => 35,
			'capability'  => 'edit_theme_options',
			'title'       => __( 'Blog & Archives', 'amcd-theme' ),
			'description' => __( 'Content and navigation archives.', 'amcd-theme' )
        ] );
        
        // Blog content format.
		$wp_customize->add_setting( 'amcd_blog_content_format', [
			'default'	        => 'content',
			'sanitize_callback' => 'amcd_sanitize_blog_content_format'
		] );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'amcd_blog_content_format', [
			'section'     => 'amcd_customizer_blog',
			'settings'    => 'amcd_blog_content_format',
			'label'       => __( 'Blog Content', 'amcd-theme' ),
			'description' => __( 'Full content or excerpts', 'amcd-theme' ),
			'type'        => 'select',
			'choices'     => [
				'content' => __( 'Full Content', 'amcd-theme' ),
				'excerpt' => __( 'Excerpts', 'amcd-theme' )
				]
			]
		) );
		
		// Archive content format.
		$wp_customize->add_setting( 'amcd_archive_content_format', [
			'default'	        => 'content',
			'sanitize_callback' => 'amcd_sanitize_archive_content_format'
		] );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'amcd_archive_content_format', [
			'section'     => 'amcd_customizer_blog',
			'settings'    => 'amcd_archive_content_format',
			'label'       => __( 'Archive Content', 'amcd-theme' ),
			'description' => __( 'Full content or excerpts', 'amcd-theme' ),
			'type'        => 'select',
			'choices'     => [
				'content' => __( 'Full Content', 'amcd-theme' ),
				'excerpt' => __( 'Excerpts', 'amcd-theme' )
				]
			]
        ) );
        
        // Blog/archive navigation format.
		$wp_customize->add_setting( 'amcd_blog_navigation_format', [
			'default'	        => 'standard',
			'sanitize_callback' => 'amcd_sanitize_blog_navigation_format'
		] );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'amcd_blog_navigation_format', [
			'section'     => 'amcd_customizer_blog',
			'settings'    => 'amcd_blog_navigation_format',
			'label'       => __( 'Blog Pages Navigation', 'amcd-theme' ),
			'description' => __( 'Next/previous links or page count.', 'amcd-theme' ),
			'type'        => 'select',
			'choices'     => [
				'standard' => __( 'Next/Previous', 'amcd-theme' ),
				'numeric'  => __( 'Page Count', 'amcd-theme' )
				]
			]
		) );

    }
    
}

new Customizer_Blog;