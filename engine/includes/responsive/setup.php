<?php
//
function cbox_responsive_meta() { ?>
<!-- html -->
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<!-- end -->
<?php }
// Hook into action
add_action('open_meta','cbox_responsive_meta');


function cbox_responsive_viewport_bug() { ?>
<!-- html -->
<script>
  var metas = document.getElementsByTagName('meta');
  var i;
  if (navigator.userAgent.match(/iPhone/i)) {
    for (i=0; i<metas.length; i++) {
      if (metas[i].name == "viewport") {
        metas[i].content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
      }
    }
    document.addEventListener("gesturestart", gestureStart, false);
  }
  function gestureStart() {
    for (i=0; i<metas.length; i++) {
      if (metas[i].name == "viewport") {
        metas[i].content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
      }
    }
  }
</script>
<!-- end -->
<?php }
// Hook into action
add_action('wp_head','cbox_responsive_viewport_bug');

//insert JS for the responsive Menu
function cbox_responsive_menu() { { ?>
<!-- html -->

<script type="text/javascript">
jQuery(document).ready(function(){

	jQuery('.base-menu ul, div.menu ul').mobileMenu({
	  switchWidth: 768,                   //width (in px to switch at)
	  topOptionText: 'Where to?',     //first option text
	  indentString: '&nbsp;&nbsp;'  //string for indenting nested items
	});
		
	// Responsive Videos FTW
    jQuery("#wrapper").fitVids();
    
	// When ready...
	window.addEventListener("load",function() {
		// Set a timeout...
		setTimeout(function(){
			// Hide the address bar!
			window.scrollTo(0, 1);
		}, 0);
	});


});
</script>
<!-- end -->
<?php }} 
// Hook into action
add_action('open_body','cbox_responsive_menu');
?>