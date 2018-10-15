<?php
/**
 * Contact page HTML output.
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
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'amcd_before_article' ); ?>
        <article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>
            <div class="entry-content" itemprop="articleBody">
				<?php do_action( 'amcd_before_content' ); ?>
				<div class="info-page-content">
					<?php if ( get_field( 'amcd_contact_info' ) ) { echo get_field( 'amcd_contact_info' ); } ?>
					<?php if ( have_rows( 'amcd_agency' ) ) :  while ( have_rows( 'amcd_agency' ) ) : the_row(); ?>
					<div class="agency-content">
						<h3><span><?php echo get_sub_field( 'amcd_agency_name' ); ?></span></h3>
						<?php $image  = get_sub_field( 'amcd_agency_logo' ); if ( ! empty( $image ) ) { ?>
						<img class="agency-logo" src="<?php echo $image; ?>" alt="<?php echo get_sub_field( 'amcd_agency_name' ); ?>" />
						<?php } ?>
						<?php if ( have_rows( 'amcd_agents' ) ) : ?>
						<ul class="agents-list">
							<?php while ( have_rows( 'amcd_agents' ) ) : the_row();
							$name  = get_sub_field( 'amcd_agent_name' );
							$dept  = get_sub_field( 'amcd_agent_department' );
							$phone = get_sub_field( 'amcd_agent_phone' );
							$email = get_sub_field( 'amcd_agent_email' ); ?>
							<li>
								<span class="agent agent-department"><?php echo $dept; ?></span> | <span class="agent agent-name"><?php echo $name; ?></span>
								<br /><a class="" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
								<br /><a class="" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
						<?php if ( get_sub_field( 'amcd_agency_info' ) ) { ?>
						<div class="agency-info">
							<?php echo get_sub_field( 'amcd_agency_info' ); ?>
						</div>
						<?php } ?>
					</div>
					<?php endwhile; endif; ?>
					<div class="resume-link">
						<?php the_field( 'amcd_resume_notice' ); ?>
						<?php
						$type = get_field( 'amcd_resume_type' );
						$link = get_field( 'amcd_resume_link' );
						$file = get_field( 'amcd_resume_file' );
						if ( 'url' == $type ) {
							$url   = $link;
							$title = __( 'View Resume', 'amcd-theme' );
						} elseif ( 'file' == $type ) {
							$url   = $file['url'];
							$title = __( 'Download Resume', 'amcd-theme' );
						} ?>
						<p><a class="resume-link-button tooltip" href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a></p>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php do_action( 'amcd_after_content' ); ?>
            </div><!-- entry-content -->
        </article>
        <?php do_action( 'amcd_after_article' ); ?>
    <?php endwhile; endif; ?>
	</main>
	<?php do_action( 'amcd_after_main' ); ?>