<?php
/**
 * Archive HTML output.
 *
 * @package WordPress
 * @subpackage AMCD_Theme
 * @since  1.0.0
 */

namespace AMCD_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

    do_action( 'amcd_before_main' ); ?>
	<main class="main" role="main" itemscope itemprop="mainContentOfPage">
		<?php do_action( 'amcd_before_article' ); ?>
        <article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
            <header class="entry-header">
                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
            </header>
            <div class="entry-content" itemprop="articleBody">
                <?php do_action( 'amcd_after_content' ); ?>
                <?php  the_content(); ?>
                <?php do_action( 'amcd_after_content' ); ?>
            </div><!-- entry-content -->
        </article>
		<?php do_action( 'amcd_after_article' ); ?>
	</main>
	<?php do_action( 'amcd_after_main' ); ?>