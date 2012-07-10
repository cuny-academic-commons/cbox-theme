<!-- start sidebar wrap -->
<div class="infinity-sidebar-wrap">
	<div id="infinity-sidebar">
	
	<div class="dashboard-widget">
		
	<h3>Follow PressCrew</h3>
	
	<p>
		Stay up to date about Infinity and our new themes and products by following us on Twitter.</br>
		<a href="https://twitter.com/PressCrew" class="twitter-follow-button">Follow @PressCrew</a>
		<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
	</p>
		
		</div>
	
	<div class="dashboard-widget">
		<?php //display some useful support info
			infinity_support_info();
		?>
	</div>	
	
		<div class="dashboard-widget">
		
		<h3>Latest Bug Reports <a target="_blank" class="button" href="http://http://community.presscrew.com/discussions/discussion/bug-reports/">Report a bug</a></h3>
		
		<?php // Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
		
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed('http://community.presscrew.com/discussions/feed');
		if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
		    // Figure out how many total items there are, but limit it to 5. 
		    $maxitems = $rss->get_item_quantity(5); 
		
		    // Build an array of all the items, starting with element 0 (first element).
		    $rss_items = $rss->get_items(0, $maxitems); 
		endif;
		?>
		
		<ul>
		    <?php if ($maxitems == 0) echo '<li>No items.</li>';
		    else
		    // Loop through each feed item and display each item as a hyperlink.
		    foreach ( $rss_items as $item ) : ?>
		    <li>
		        <a target="_blank" href='<?php echo esc_url( $item->get_permalink() ); ?>'
		        title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
		        <?php echo esc_html( $item->get_title() ); ?></a>
		    </li>
		    <?php endforeach; ?>
		</ul>	
		
	</div>

		<div class="dashboard-widget">
			<h3>
				Learn Infinity
			</h3>
		
			<p>
				The theme developer documentation is available right in the theme, as well as online!
				Its the best place to start.
				
				<ul class="theme-features">
					<li id="responsive">
						<a target="infinity-cpanel-tab-ddocs" href="<?php print infinity_screens_route( 'cpanel', 'ddocs', 'index' ) ?>">Built-In Docs &raquo;</a>
					</li>
					<li id="slider">
						<a target="_blank" href="http://infinity.presscrew.com/docs">Online Docs &raquo;</a>
					</li>
					<li id="easy-hooks">
						<a target="_blank" href="http://infinity.presscrew.com/api">Online API Manual &raquo;</a>
					</li>
				</ul>
			</p>
		
		</div>
	
	
</div>
<!-- Three Widgets end -->

		
		
	
	</div
</div>
<!-- end sidebar wrap -->
