<?php
	infinity_get_header(); ?>

	<div id="content" role="main" class="<?php do_action( 'content_class' ); ?>">
		<?php if ( ddc_is_tool_directory() ) : ?>
			<?php include( DDC_PLUGIN_DIR . 'templates/dirt/directory.php' ) ?>
		<?php elseif ( ddc_is_tool_page() ) : ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<div class="post-content">
						<h1 class="post-title">
							<?php the_title(); ?>
							<?php edit_post_link(' ✍','',' ');?>
						</h1>

						<?php include( DDC_PLUGIN_DIR . 'templates/dirt/single.php' ) ?>
					</div>
				</div>
			<?php endwhile; endif; ?>
		<?php endif; ?>
	</div>
<?php
	infinity_get_sidebar();
	infinity_get_footer();
?>
