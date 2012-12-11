<?php
/**
 * Template Name: Features or Category Slider
 *
 * This template either displays Slides taken from the "Features" custom post type.
 * Or Loops through posts from a certain category. This is based on the theme options set by 
 * the user.
 *
 * @author Bowe Frankema <bowe@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package Infinity
 * @since 1.0
 */
?>
<?php
// locate no slides image url
$no_slides_url = infinity_image_url( 'slides-none.jpg' );

// Show slides from the Features custom post type by default
if ( infinity_option_get( 'cbox_flex_slider' ) == 1 ): 
?>
	<div class="flex-container">
		<div class="flexslider">
		  	<ul class="slides">
		<?php
			$captions = array();
			$tmp = $wp_query;
			$wp_query = new WP_Query('post_type=features&order=ASC&posts_per_page=8');
			if($wp_query->have_posts()) :
			while($wp_query->have_posts()) :
			$wp_query->the_post();
			$captions[] = ''.get_the_excerpt().'';
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider-image');
		?>		
			<!-- Loop through slides  -->
			<!-- Image -->
			<?php if(has_post_thumbnail()) :?>
			<li>
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo $image[0]; ?>" class="attachment-nivothumb wp-post-image" title="<?php the_title_attribute(); ?>" alt="<?php 			the_title_attribute(); ?>" />	
					</a>
					<!-- Caption -->	
					<div class="flex-caption">
					<h3><?php the_title_attribute();?></h3>
					<?php the_excerpt();?>
					</div>
					
			</li>
			<?php else :?>
			<li>
					<img src="<?php echo $no_slides_url ?>" />
			</li>
			<?php endif;?>
			</li>	
		<?php endwhile; else: ?>
			<!-- Fallback to default slide if no features are present -->
		    <li>
		     	<img src="<?php echo $no_slides_url ?>" />
		    </li>     
		<?php
			endif;
			// reset query
			$wp_query = $tmp;
			?>	
			</ul>	
		</div>
	</div>	
<?php endif; // end custom post type slider ?>


<?php if ( infinity_option_get( 'cbox_flex_slider' ) == 2 ): ?>
	<div class="flex-container">
		<div class="flexslider">
		  	<ul class="slides">
		<?php
			$cat = infinity_option_get( 'cbox_flex_slider_category' );
			$quantity = infinity_option_get( 'cbox_flex_slider_amount' );
			$captions = array();
			$tmp = $wp_query;
			$wp_query = new WP_Query('cat='.$cat.'&order=ASC&posts_per_page='.$quantity.'');
			if($wp_query->have_posts()) :
			while($wp_query->have_posts()) :
			$wp_query->the_post();
			$captions[] = '<h3>'.get_the_title($post->ID).'</h3><p>'.get_the_excerpt().'</p>';
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider-image');
		?>		
			<!-- Loop through slides  -->
			<!-- Image -->
			<?php if(has_post_thumbnail()) :?>
			<li>
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo $image[0]; ?>" class="attachment-nivothumb wp-post-image" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />	
					</a>
					<!-- Caption -->	
					<div class="flex-caption">
					<h3><?php the_title_attribute();?></h3>
					<?php the_excerpt();?>
					</div>
					
			</li>
			<?php else :?>
			<li>
					<img src="<?php echo $no_slides_url ?>" />
			</li>
			<?php endif;?>
			</li>	
		<?php endwhile; else: ?>
			<!-- Fallback to default slide if no features are present -->
		    <li>
		     	<img src="<?php echo $no_slides_url ?>" />
		    </li>     
		<?php
			endif;
			// reset query
			$wp_query = $tmp;
			?>	
			</ul>	
		</div>
	</div>	
<?php endif; // end custom post type slider ?>