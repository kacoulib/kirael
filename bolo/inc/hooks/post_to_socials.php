<?php
// twitter
require get_template_directory() ."/api/twitter/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

function socials_send_post( $post_id, $post=null, $update=null ) { die;

	// If this is just a revision, return.
	if ( wp_is_post_revision( $post_id ) )
		{
			var_dump('brouillon'); die;
		}


	// if is a post not a custom-post-type or a page
	if (get_post($post_id)->post_type != 'post')
		return;

	if (get_post($post_id)->post_status != 'draft')
		{
			var_dump('brouillon'); die;
		}

	$socials_to_publish = get_post_meta($post_id,'social_check',true);
	// var_dump(in_array('instagram', $socials_to_publish));
	// if (in_array('instagram', $socials_to_publish)) {}
	// die();

	$user = get_user_by('slug', 'admin');
	if (empty(get_usermeta($user->id, 'twitter_token')))
		return;
	
	$twitter_access = get_usermeta($user->id, 'twitter_token');
	$the_post = get_post($post_id);

	$message = get_bloginfo('url'). '/' .$the_post->post_title;


	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_access['oauth_token'], $twitter_access['oauth_token_secret']);

	// getting basic user info
	$twitter_user = $connection->get("account/verify_credentials");

	// sending to twitter 
	$twitter_post = $connection->post('statuses/update', array('status' => $message));

	if (empty(get_post_meta($post_id, 'twitter_post_id')[0])) {
		update_post_meta($post_id, 'twitter_post_id', $twitter_post->id);
	}

	// var_dump(get_post_meta($post_id, 'twitter_post_id'));
	// die();

}
add_action( 'wp_insert_post', 'socials_send_post' );