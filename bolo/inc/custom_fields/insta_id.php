<?php
	add_action( 'show_user_profile', 'insta_id_extra_profile_fields' );
	add_action( 'edit_user_profile', 'insta_id_extra_profile_fields' );

	function insta_id_extra_profile_fields( $user ) {
		// instagram api info
		// local

		$CLIENT_ID 		= 'b9e2d2defa254df8b775d224407939bb';
		$CLIENT_SECRET	= 'a644f56ead4748b4a6bbc64d17106610';
		$WEBSITE_URL	= 'http://localhost/wordpress/caribbean-planner/';
		$REDIRECT_URI 	= 'http://localhost/wordpress/caribbean-planner/wp-admin/profile.php';
		$CODE			= '9658633dbe684825b23386bdb8449949';

		// online
		$REDIRECT_URI 	= 'http://freelance.nicolaslandrieau.fr/freelance/wp-admin/profile.php';
		// $REDIRECT_URI 	= 'http://localhost/carribbean/wp-admin/profile.php';

		// getting access token
		$ACCESS_TOKEN = esc_attr( get_the_author_meta( 'insta_access_token', $user->ID ) );

		$url = 'https://api.instagram.com/oauth/authorize/?client_id='.$CLIENT_ID.'&redirect_uri='.$REDIRECT_URI.'&response_type=token';
		

		// user profil fields
		$user_insta_hashTag = esc_attr( get_the_author_meta( 'insta_hashTag', $user->ID ) );
		$user_insta_id = esc_attr( get_the_author_meta( 'insta_id', $user->ID ) );

		$to_reload = false;
		$html = '';
		// if authentification faild

		if (empty($ACCESS_TOKEN)) {
			try {
				// $instaUrl = 'https://api.instagram.com/v1/users/self/?access_token='.$ACCESS_TOKEN;
				$req = file_get_contents($url);
				$to_reload = true;
				
			} catch (Exception $e) {
				
			}
		}

		// getting user id
		if (!empty($ACCESS_TOKEN) && empty($user_insta_id)) {
			try {
				$url = 'https://api.instagram.com/v1/users/self/?access_token='.$ACCESS_TOKEN;
				$user_insta_id = file_get_contents($url);
				$user_insta_id = json_decode($user_insta_id, true);
				$user_insta_id = $user_insta_id['data']['id'];
				
				$to_reload = true;

			} catch (Exception $e) {
				
			}
		}

		// displays

		if ($to_reload == true || !empty($_GET['error_reason'])){
			$html .= '<table class="form-table"><tr><th>';
			$html .= '<label for="insta_id">Veillez autoriser notre service à acceder à votre flux instagam.</label></th>';
			$html .= '<td><a href="'.$url.'">Autoriser</a>';
			$html .= '</td></tr></table>';
		}else{
			

		$html .= '<table class="form-table"><tr><th>';
		$html .= '<label for="insta_id">Lien de votre instagram</label></th>';
		$html .= '<td><input type="text" name="insta_hashTag" id="insta_hashTag" style="min-width:400px;" value="'.esc_attr( get_the_author_meta( 'insta_hashTag', $user->ID ) ).'" palceholder="Veillez entre la date de votre mariage"/><br />';
			// user id from insta
		$html .= '<input type="hidden" name="insta_id" id="insta_id" value="'.$user_insta_id.'"/>';
		$html .= '</td></tr></table>';
			// user access_token
		$html .= '<input type="hidden" name="insta_access_token"  id="insta_access_token" value="'.$ACCESS_TOKEN.'"/>';
		$html .= '</td></tr></table>';

		}

		if ($to_reload == true){
			$html .= '<script>
			document.addEventListener("DOMContentLoaded", fn, false);
			function fn(){if (location.hash.split(\'=\')[1] != undefined){
						document.getElementById(\'insta_access_token\').value = location.hash.split(\'=\')[1]; document.getElementById(\'submit\').click();
			}} </script>';
		}
		echo $html;
	}

	add_action( 'personal_options_update', 'insta_id_save_extra_profile_fields' );
	add_action( 'edit_user_profile_update', 'insta_id_save_extra_profile_fields' );

	function insta_id_save_extra_profile_fields( $user_id ) {

		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;

		/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
		update_usermeta( $user_id, 'insta_id', $_POST['insta_id'] );
		update_usermeta( $user_id, 'insta_hashTag', $_POST['insta_hashTag'] );
		update_usermeta( $user_id, 'insta_access_token', $_POST['insta_access_token'] );
	}