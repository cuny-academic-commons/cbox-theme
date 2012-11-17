<div class="start-page">

<div class="infinity-content-wrap">

<div class="infinity-content">
	<h1>Thank you for using Commons in a Box!</h1>	
	
	<p>
	 	Welcome to the Theme Dashboard of your CBOX installation. This is where you can find a whole bunch of options to change the front end of your site. Click on the "Options" tab at the top right of this page to view all the customisation options available.
	</p>	
				
	<h2>
		Need our support? 
	</h2>

	<p>
		If you have additional questions please visit our Support Forum. We'll gladly help you with any issues you might encounter related to setup issues or general questions you might have. 
	</p>
	<p>
		Please submit your <strong>installation details</strong> when you create a support topic. They are displayed in the sidebar on this page.	
	</p>
	
	<h3>Latest Support Topics <a target="_blank" class="button" href="http://commonsinabox.org/groups/help-support/forums/">Visit Forums</a></h3>
	
	<?php // Get RSS Feed(s)
	include_once(ABSPATH . WPINC . '/feed.php');
	
	// Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed('http://commonsinabox.org/forums/forum/help-support/feed');
	if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
	    // Figure out how many total items there are, but limit it to 10. 
	    $maxitems = $rss->get_item_quantity(10); 
	
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
		
	<h3>Need general WordPress/BuddyPress Support?</h3>
	
	<p>
		Please keep in mind when you're creating a new topic that our community forums should <strong>not</strong> be used for general WordPress/BuddyPress or 3rd Party plugin support. It's important that you ask for support in the right places, so that the solutions end up in the right places. Here are some helpful links:
	</p>
	
	<p>
		WordPress Support: <a href="http://wordpress.org/support/">WordPress Support</a><br>
		WordPress StackExhange: <a href="http://wordpress.org/support/">WordPress Q&amp;As</a><br>
		BuddyPress Support: <a href="http://buddypress.org/support/">BuddyPress Support</a><br>
	</p>		
		
	</div>
</div>
	<!-- end content wrap -->
	<?php include('dashboard-sidebar.php');?>
	<div style="clear: both;"></div>
</div>