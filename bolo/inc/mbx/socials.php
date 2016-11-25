<?php
// add a metabox post title. under the header

add_action( 'add_meta_boxes', 'init_social_share' );
function init_social_share()
{
	add_meta_box('bolo_social_share', 'Partager', 'socials_metabox', 'post', 'normal', 'low');
}

function socials_metabox($post){
	$data = get_post_meta($post->ID,'social_check',true);

	$socials = ['facebook', 'twitter', 'instagram'];	
	
	// html

	$html = '';
	for ($i=0; $i < count($socials); $i++) { 
		$html .= '<label style="display:inline-block;margin-right:15px;">
					<div style="width:24px;"><img src="'.get_template_directory_uri().'/img/icons/'.$socials[$i].'.png"></div>';
		if ( in_array($socials[$i], $data)){
			
			$html .= '<input type="checkbox" name="social_check[]" checked="checked" value="'.$socials[$i].'"/>';
		}else{

			$html .= '<input type="checkbox" name="social_check[]" value="'.$socials[$i].'"/>';
		}

		$html .= '</label>';
	}

	echo $html;
}

add_action('save_post','save_social_share');
function save_social_share($post_ID){

	if(isset($_POST['social_check'])){

    	update_post_meta($post_ID,'social_check', $_POST['social_check']);
	}else{

    	update_post_meta($post_ID,'social_check', array());
    }

}
