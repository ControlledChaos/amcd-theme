<?php
/**
 * Post type functionality.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since 1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

class Post_Types {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

		add_action( 'feature_galleries', [ $this, 'add_feature_galleries' ] );

	}

	public function add_feature_galleries() {

		global $post;
		$project_ID     = $post->ID;
		$gallery_images = get_field( 'amcd_project_gallery' );
		$title          = get_the_title();
		if ( $gallery_images ) : $i = 0;
		foreach ( $gallery_images as $gallery_image ) : $i++;
			if ( $i != 1 ) : ?>
			<a class="gallery-image" data-fancybox="<?php echo 'gallery-' . $project_ID; ?>" href="<?php echo $gallery_image['url']; ?>" title="<?php echo __( 'Scenes from ', 'ch-designer' ) . $title; ?>">
					<img src="<?php echo $gallery_image['sizes']['large']; ?>" alt="<?php echo $gallery_image['alt']; ?>" />
			</a>
		<?php endif; if (++$i == 20) break; endforeach; endif; ?>

		<?php if ( $i > 10 ) : ?>
		<a class="fancybox-notice" data-fancybox="<?php echo 'gallery-' . $project_ID; ?>" data-src="<?php echo '#fancybox-page-link-' . $project_ID; ?>" href="javascript:;"></a>
		<div class="fancybox-page-link" id="<?php echo 'fancybox-page-link-' . $project_ID; ?>" data-fancybox-group="<?php echo 'gallery-' . $project_ID; ?>">
			<h3><?php the_title(); ?></h3>
			<p><?php _e( 'More photos, video & info available on this project\'s page.', 'ch-designer' ); ?></p>
			<p><a class="fancybox-link" href="<?php the_permalink(); ?>"><?php _e( 'Take me there', 'ch-designer' ); ?></a> | <a href="javascript:jQuery.fancybox.close();"><?php _e( 'Close', 'ch-designer' ); ?></a></p>
		</div>
		<?php endif;

	}

}

new Post_Types;