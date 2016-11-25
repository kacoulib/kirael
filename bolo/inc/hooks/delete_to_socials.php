<?php
// twitter
require get_template_directory() ."/api/twitter/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

function socials_delete_post( $post_id ) {

	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;

	$user = get_user_by('slug', 'admin');
	if (empty(get_usermeta($user->id, 'twitter_token')))
		return;
	
	$twitter_access = get_usermeta($user->id, 'twitter_token');

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_access['oauth_token'], $twitter_access['oauth_token_secret']);

	// getting basic user info
	$twitter_user = $connection->get("account/verify_credentials");

	$twitter_post_id = get_post_meta($post_id, 'twitter_post_id')[0];

	// sending to twitter 
	$twitter_post = $connection->post('statuses/destroy/'.$twitter_post_id);

}
add_action( 'wp_trash_post', 'socials_delete_post' );