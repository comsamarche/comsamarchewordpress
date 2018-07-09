<?php
/*
Plugin Name : Machine Humaine Svg
Plugin URI : LIEN VERS LE PLUGIN
Description : affichage d'un svg animé
Version : 1.0
Author : GUINAUDEAU Christine
Author URI :
License : GPLv2
*/
/* Shortcode – Google Maps Integration */
function fn_svghumanmachine($atts, $content = null) {
//    extract(shortcode_atts(array(
//       "width" => 640,
//       "height" => 480,
//       "src" => ''
//    ), $atts));
	 $url = '<img src="' .get_template_directory_uri() . '/assets/img/lamachinehumaine.svg" />';
	 return $url;
}
add_shortcode("humanmachine", "fn_svghumanmachine") ;
?>
