<?php
/*
Plugin Name: Video Popup
Version: 1.0
Plugin URI: http://www.pushpendra.net
Author: Pushpendra Singh
Author URI: https://www.pushpendra.net/
Description: Plugin for video popup.
*/
   
function add_js_css_fun() {
	wp_register_style( 'myCss', plugins_url('colorbox.css', __FILE__) );
	wp_register_script( 'myJqScript', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
	wp_register_script( 'myScript', plugins_url('jquery.colorbox.js', __FILE__), array(), '1.0.0', true );
	wp_enqueue_style('myCss');
	wp_enqueue_script('myJqScript');
	wp_enqueue_script('myScript');

}

function vp_inline_script() { ?>
<script>
			$(document).ready(function(){
				$(".vp_inline").colorbox({inline:true, width:"50%"});
			});
</script>
<?php }
add_action( 'wp_enqueue_scripts', 'add_js_css_fun' ); 
add_action('wp_footer', 'vp_inline_script');

function video_popup_fun($atts){
ob_start(); 
$a = shortcode_atts( array(
        'embed' => 'https://www.youtube.com/embed/bxijX3jnMWs?list=PL4-k2YHb3HLjSbhK16WdhlpZ2K4cMo9TT',
        'image' => 'http://www.f5buddy.com/wp-content/uploads/2014/03/f5_1.jpg',
		'width' => '',
		'height' => ''
    ), $atts );

?>
		
    
		<p><a class='vp_inline' href="#inline_content"><img src="<?php echo $a['image']; ?>" width="<?php echo $a['width']; ?>" height="<?php echo $a['height']; ?>" /></a></p>
		<!-- This contains the hidden content for inline calls -->
		<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
            	<iframe width="100%" height="315" src="<?php echo $a['embed']; ?>" frameborder="0" allowfullscreen></iframe>			
			</div>
		</div>

<?php 
$content = ob_get_clean();
return $content;
}
add_shortcode( 'my_video', 'video_popup_fun' );