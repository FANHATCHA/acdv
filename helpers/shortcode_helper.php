<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$CI = get_instance();
$CI->load->library("shortcodes");

$CI->shortcodes->add_shortcode('hide-this-part','hide_this_part');
$int_conter = 0;
function hide_this_part($atts, $content=''){
	$atts= implode(' ',$atts);
	global   $int_conter;
	if($atts != '') {
		$str_more_link = $atts;
	}
	else {
		$str_more_link = 'More';
	}
	
	$str_more_link = preg_replace('/["]+/',"", htmlspecialchars_decode($str_more_link));
	$str_more_link = htmlspecialchars_decode($str_more_link);
	//$str_more_link = str_replace("&laquo;","&quot;",$str_more_link);
	//$str_more_link = str_replace("&raquo;","&quot;",$str_more_link);
	//$str_more_link = str_replace("&ndash;","&quot;",$str_more_link); 
	//$str_more_link = str_replace("&rsquo;","&quot;",$str_more_link);
	//print_r($str_more_link);exit;
		$str_return =	'<div class="hide-this-part-wrap">';
		$str_return .=		'<div class="hide-this-part-more" id="hide-this-part-'.$int_conter.'" morelink-text='.$str_more_link.'>'.$str_more_link.'</div>';
		$str_return .=		'<div class="hide-this-part" status="invisible">';
		$str_return .=		$content;
		$str_return .=		'</div>';
		$str_return .= '</div>';
		
		$int_conter++;
		
	return $str_return;
}

