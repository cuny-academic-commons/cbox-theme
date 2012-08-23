<div class="start-page">

<div class="infinity-content-wrap">

<div class="infinity-content">
		<h2>Thank you for purchasing Balance!</h2>	
 		
 		<p>
 		Thank you for purchasing Balance! We are glad to welcome you to our community and have you as a customer. We advise you to read the documentation included with this theme to quickly help you get started. Simply navigate to the "Documentation" tab and you'll be presented with a detailled set up guide.
 		</p>	
 				
		<h2>
			Need our support? 
		</h2>
	
		<p>
If you have additional questions please visit our Support Forum. We'll glady help you with any issues you might encounter related to setup issues or general questions you might have. 
<br>
<br>
Please submit your <strong>installation details</strong> when you create a support topic. They are displayed in the sidebar >>
		</p>	
		
	<h2>Need general WordPress/BuddyPress Support?</h2>
	<p>Please keep in mind when you're creating a new topic that our community forums should <strong>not</strong> be used for general WordPress/BuddyPress or 3rd Party plugin support. It's important that you ask for support in the right places, so that the solutions end up in the right places. Here are some helpful links:</p>
	<p>
	WordPress Support: <a href="http://wordpress.org/support/">WordPress Support</a><br>
	WordPress StackExhange: <a href="http://wordpress.org/support/">WordPress Q&amp;As</a><br>
	BuddyPress Support: <a href="http://buddypress.org/support/">BuddyPress Support</a><br>
	</p>
	
  		<div class="dashboard-widget">
		
		<h3>Latest Support Topics <a target="_blank" class="button" href="http://http://community.presscrew.com/discussions/">Visit Forums</a></h3>
		
		<?php // Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
		
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed('http://community.presscrew.com/discussion/premium-themes/balance/feed');
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
		
	</div>

	
	</div>
	</div>
	<!-- end content wrap -->
	<?php include('dashboard-sidebar.php');?>
	<div style="clear: both;"></div>
</div>