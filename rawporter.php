<?php
/**
 * @package rawporter
 * @version 1.0
 */
/*
Plugin Name: Photos & Videos
Plugin URI: http://wordpress.org/extend/plugins/rawporter/
Description: For rawporter.com page popup on blog.
Author: Rawporter
Version: 1.0
Author URI: http://rawporter.com/
*/
function rawporter_box() {
	//loading required JS, CSS and initialize it
?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>	
	<script type="text/javascript" src="<?php echo plugins_url('/fancybox/jquery.fancybox.pack.js',__FILE__ ); ?>"></script>	 
	<link rel="stylesheet" href="<?php echo plugins_url('/fancybox/jquery.fancybox.css',__FILE__ ); ?>" type="text/css" media="screen" /> 	      
	<div id="butDiv">
		<a id="lnkButDiv" href="<?php echo "http://rawporter.com/wpassign";?>" class="fancybox fancybox.iframe">
			<input type="button"  class="button-primary" value="Request Photos / Videos" />
		</a>	
	</div>
	<script type="text/javascript">
        $rawfunc = jQuery.noConflict();
		$rawfunc(document).ready(function() {
            $rawfunc('.fancybox').fancybox({
                padding : 0,
                openEffect  : 'none',				
				openSpeed  : 'fast'
            });
        });
    </script>
<?php
}
function rawporter_exec() {	
	add_meta_box( 'rawporter_boxid', __('Photos / Videos', 'wpsc'), 'rawporter_box', $pagename, 'side', 'low' );
}
// This just echoes the chosen line, we'll position it later
function rawporter() {
	$chosen = rawporter_exec();
	echo "<p id='rawporter'>$chosen</p>";
}
// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'rawporter' );

// We need some CSS to position the div
function rawporter_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';
	echo "
	<style type='text/css'>
	#rawporter {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}	
	#lnkButDiv {
		text-decoration:none;
	}
	</style>
	";
}
add_action( 'admin_head', 'rawporter_css' );
?>