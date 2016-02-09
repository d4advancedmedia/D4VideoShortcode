<?php

/*
	Plugin Name: D4 Video Shortcode
	Version: 08Feb16
	Description: Renders '[video]' shortcode
	Author: D4 Adv. Media
*/


function shortcode_d4video( $atts, $content = null ) {

	$attr = shortcode_atts( array(
		'id'		=> false,
		'class'		=> false,
		'autop'		=> true,

		'poster'	=> false, 
		'autoplay'	=> false,
		'loop'		=> false,
		'preload'	=> false, // Note: The preload attribute is ignored if autoplay is present. - http://www.w3schools.com/tags/att_video_preload.asp
		'controls'	=> false,
		'muted'		=> false,

		'mp4'		=> false, // MP4 = MPEG 4 files with H264 video codec and AAC audio codec
		'ogg'		=> false, // Ogg = Ogg files with Theora video codec and Vorbis audio codec
		'webm'		=> false, // WebM = WebM files with VP8 video codec and Vorbis audio codec
	), $atts );

	$output = '';
	#$output = '<pre>'.print_r($atts,true).'</pre>';
	
		$output .= '<div';
			if ( $attr['id'] )    $output .= ' id="'. $attr['id'] . '"';
			if ( $attr['class'] ) $output .= ' class="'. $attr['class'] . '"';
		$output .= '>';

			// Build <video> tag
				$output .= '<video';
					if ( $attr['poster'] )   $output .= ' poster="' . $attr['poster'] . '"';
					if ( $attr['preload'] )  $output .= ' preload="' . $attr['preload'] . '"';
					if ( $attr['loop'] )     $output .= ' loop';
					if ( $attr['autoplay'] ) $output .= ' autoplay';
					if ( $attr['controls'] ) $output .= ' controls';
					if ( $attr['muted'] )    $output .= ' muted';
				$output .= '>';

					// Source inputs
						if ( $attr['mp4']  ) $output .= '<source src="'. $attr['mp4'] . '" type="video/mp4">';
						if ( $attr['webm'] ) $output .= '<source src="'. $attr['wenm'] . '" type="video/webm">';      
						if ( $attr['ogv']  ) $output .= '<source src="'. $attr['ogv'] . '" type="video/ogg">';

				$output .= '</video>';

			// Content wrapper

				if ( $content ) {
						$output .= '<div class="video-content">';
							if ( $attr['autop'] == true ) $content = wpautop( $content );
							$output .= do_shortcode($content);
						$output .= '</div>';
				}

			// Video overlay for styling overlays
				$output .= '<div class="video-overlay"></div>';


	$output .= '</div>';

	return $output;

} add_shortcode( 'video', 'shortcode_d4video' );

?>