<?php
//Custom functionality for Cbox
require_once( 'engine/includes/custom.php' );

/**
 * Set this to true to put Infinity into developer mode
 */
//define( 'INFINITY_DEV_MODE', true );

//
// Usually dev mode is enough, but if want finer control you can
// set some of these special constants manually.
//

/**
 * Set this to false to totally disable error handling by Infinity
 */
//define( 'INFINITY_ERROR_HANDLING', false );

/**
 * Set this to true to show detailed error and exception reports. This only
 * works if error handling is enabled (see above)
 */
//define( 'INFINITY_ERROR_REPORTING', true );

/**
 * Set this to a short message to customize the friendly AJAX error
 */
//define( 'ICE_ERROR_AJAX_MESSAGE', 'Woops! We forgot to feed the server, sorry!' );

/**
 * Set this to an absolute path to a custom friendly fatal error page
 */
//define( 'ICE_ERROR_PAGE_PATH', '/path/to/my/error.php' );

/**
 * Set this to false to disable caching of dynamically generated
 * CSS and Javascript. Highly recommended for development.
 */
//define( 'ICE_CACHE_EXPORTS', false );
?>