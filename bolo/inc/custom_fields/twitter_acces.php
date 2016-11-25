<?php
	session_start();
	// twitter
	require get_template_directory() ."/api/twitter/autoload.php";
	use Abraham\TwitterOAuth\TwitterOAuth;

	add_action( 'show_user_profile', 'twitter_connect_extra_profile_fields' );
	add_action( 'edit_user_profile', 'twitter_connect_extra_profile_fields' );

	function twitter_connect_extra_profile_fields( $user ) {

		// before user autorize the api

		if (!isset($_SESSION['access_token'])) {
			echo "string";
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
			$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
			$_SESSION['oauth_token'] = $request_token['oauth_token'];
			$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
			$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

			$html .= '<table class="form-table"><tr><th>';
			$html .= '<label for="insta_id">Autoriser l\'acceder Twitter.</label></th>';
			$html .= '<td><a href="'.$url.'">Autoriser</a>';
			$html .= '</td></tr></table>';
			echo $html;
		}else{
			# code...
			$access_token = $_SESSION['access_token'];

			// saving the twitter information into wordpress user
			if (empty(get_usermeta($user->id, 'twitter_token'))) {
				update_usermeta( $user->id, 'twitter_token', $access_token);
			}

			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

			// getting basic user info
			$twitter_user = $connection->get("account/verify_credentials");

			// posting tweet on user profile
			$post = $connection->post('statuses/update', array('status' => 'https://sohaibilyas.com my website'));
			// displaying response of $post object
			print_r($post);
		}
	     var_dump($user->id);
	     var_dump(get_usermeta($user->id, 'twitter_token'));
	     // die();

		
	}

	add_action( 'personal_options_update', 'twitter_connect_save_extra_profile_fields' );
	add_action( 'edit_user_profile_update', 'twitter_connect_save_extra_profile_fields' );

	function twitter_connect_save_extra_profile_fields( $user_id ) {

		// if ( !current_user_can( 'edit_user', $user_id ) )
		// 	return false;

		// /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
		update_usermeta( $user_id, 'twitter_oauth_token', $_SESSION['access_token']['oauth_token'] );
		update_usermeta( $user_id, 'twitter_oauth_token_secret', $_SESSION['access_token']['oauth_token_secret'] );
		update_usermeta( $user_id, 'insta_hashTag', $_POST['insta_hashTag'] );
		// update_usermeta( $user_id, 'insta_access_token', $_POST['insta_access_token'] );
	}