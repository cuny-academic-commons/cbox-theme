<?php
/**
 * Template Name: Homepage Template
 *
 * @author Bowe Frankema <bowe@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package Infinity
 * @subpackage templates
 * @since 1.0
 */
 
    infinity_get_header();
?>
<div id="top-homepage-wrap">
	<div id="flex-slider-wrap-full" class="grid_16">
		
		<?php // load template for the slider
			infinity_get_template_part( 'base/feature-slider/template/slider' );
		?>
	</div>
	<div id="homepage-sidebar-right" class="grid_8">
		<div id="inner-sidebar">
	        <?php
	            dynamic_sidebar( 'Homepage Top Right' );
	        ?>
		</div>
	</div>
</div>
<div style="clear: both;"></div>
 
<div id="center-homepage-widget">
	<?php
	    dynamic_sidebar( 'Homepage Center Widget' );
	?>
</div>
			
<div id="homepage-content" role="main">
    <?php
    do_action( 'open_content' );
    do_action( 'open_home' );
    ?>                          
    <div id="homepage-widget-left" class="grid_8 alpha">           
        <?php
            dynamic_sidebar( 'Homepage Left' );
        ?>
    </div>              
    <div id="homepage-widget-middle" class="grid_8">   
        <?php
            dynamic_sidebar( 'Homepage Middle' );
        ?>
    </div>    
    <div id="homepage-widget-right" class="grid_8 omega">   
        <?php
            dynamic_sidebar( 'Homepage Right' );
        ?>
    </div>        
</div>
<div style="clear: both;"></div>
        
<?php
    do_action( 'close_home' );
    do_action( 'close_content' );
    infinity_get_footer();
?>