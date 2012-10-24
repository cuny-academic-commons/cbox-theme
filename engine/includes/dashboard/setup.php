<?php
/**
 * Show useful support informations. props to Paul Gibbs for and 90% of the code!
 */ 
function infinity_support_info() {
global $wpdb, $wp_rewrite, $wp_version;
	$active_plugins = array();
	$all_plugins = apply_filters( 'all_plugins', get_plugins() );
	
	//Show some useful Infinity Info
	if ( 1 == constant( 'INFINITY_DEV_MODE' ) )
		$is_developer_mode = __( 'Enabled', 'infinity' );
	else
		$is_developer_mode = __( 'Disabled', 'infinity' );

	$is_bp_default_child_theme = __( 'no', 'infinity' );
	$theme = current_theme_info();

	//What Plugins are Active?
	foreach ( $all_plugins as $filename => $plugin ) {
		if ( 'BuddyPress' != $plugin['Name'] && is_plugin_active( $filename ) )
			$active_plugins[] = $plugin['Name'] . ': ' . $plugin['Version'];
	}
	natcasesort( $active_plugins );

	if ( !$active_plugins )
		$active_plugins[] = __( 'No other plugins are active', 'infinity' );

	//MultiSite info
	if ( defined( 'MULTISITE' ) && constant( 'MULTISITE' ) == true ) {
		if ( defined( 'SUBDOMAIN_INSTALL' ) && constant( 'SUBDOMAIN_INSTALL' ) == true )
			$is_multisite = __( 'subdomain', 'infinity' );
		else
			$is_multisite = __( 'subdirectory', 'infinity' );
	} else {
		$is_multisite = __( 'no', 'infinity' );
	}

   //What permalinks are being used?
  if ( empty( $wp_rewrite->permalink_structure ) )
		$custom_permalinks = __( 'default', 'infinity' );
	else
		if ( strpos( $wp_rewrite->permalink_structure, 'index.php' ) )
			$custom_permalinks = __( 'almost', 'infinity' );
		else
			$custom_permalinks = __( 'custom', 'infinity' );
?>
	<h3><?php _e( 'Installation Details', 'infinity' ) ?></h3>
	<p><?php _e( "If you are having issues with the theme and need support, below is some useful info about your installation.", 'infinity' ) ?></p>
	<p><?php _e( "Please submit this information with your support request so it's easier for us to help you!", 'infinity' ) ?></p>

	<h4><?php _e( 'Versions', 'infinity' ) ?></h4>
	<ul>
		<li><?php printf( __( 'CBOX Version: %s', 'infinity' ), INFINITY_VERSION ) ?></li>
		<li><?php printf( __( 'Developer Mode: %s', 'infinity' ), $is_developer_mode ) ?></li>
		<li><?php printf( __( 'BuddyPress: %s', 'infinity' ), BP_VERSION ) ?></li>
		<li><?php printf( __( 'MySQL: %s', 'infinity' ), $wpdb->db_version() ) ?></li>
		<li><?php printf( __( 'Permalinks: %s', 'infinity' ), $custom_permalinks ) ?></li>
		<li><?php printf( __( 'PHP: %s', 'infinity' ), phpversion() ) ?></li>
		<li><?php printf( __( 'WordPress: %s', 'infinity' ), $wp_version ) ?></li>
		<li><?php printf( __( 'WordPress multisite: %s', 'infinity' ), $is_multisite ) ?></li>
	</ul>

	<h4><?php _e( 'Theme', 'infinity' ) ?></h4>
	<ul>
		<li><?php printf( __( 'Current theme: %s', 'infinity' ), $theme->name ) ?></li>
	</ul>

	<h4><?php _e( 'Active Plugins', 'infinity' ) ?></h4>
	<ul>
		<?php foreach ( $active_plugins as $plugin ) : ?>
			<li><?php echo $plugin ?></li>
		<?php endforeach; ?>
	</ul>
<?php
}
?>