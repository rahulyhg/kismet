<?php
/* Check to make sure nobody is accessing the file directly */
if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
	require('include/functions.php');
	
	/* Send Request to API */
	function sendRequest($method, $data, $username, $url) 
	{
				    /* https://kismet-api.aws.af.cm/himanshu/conversation/ */
		$requestUri = 'http://kismet-api.aws.af.cm/' . $username . $url;
				
		$curl = curl_init($requestUri);
		
		if ($method == 'POST') {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		else if ($method == 'DELETE') {
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		}
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);
		
		/* If Logging In */
		if ($url == '/login/') {
			/* If Successful, create session and remove token */
			if ($info['http_code'] == 200) {
				$decoded = json_decode($result, true);
				createSession($username,$decoded['name'],$decoded['token'],$decoded['membership'],$_POST['remember']);
				$result = str_replace($decoded['token'], "removed", $result);
			}
			echo $result;
		}
		else {
			echo $result;
		}
		exit;
	}
	
	/* Process Incoming Ajax Request */
	session_start();
	$token = $_SESSION['token'];
	$username = $_SESSION['username'];
	
	if (!empty($_POST)) 
	{
		/* Log In User */
		if ($_POST['type'] == 'login') {
			$data = array(
				'password' => $_POST['password'] 
			);
			sendRequest('POST', $data, $_POST['username'], '/login/');
		}
		/* Logout User */
		else if ($_POST['type'] == 'logout') {
			clearSessionCookies();
			$response['message'] = 'Success!';
			echo json_encode($response);
			exit;
		}
		else if ($_POST['type'] == 'search') {
			$data = array(
				'token' => $token,
				'gender' => $_POST['gender'],
				'genderInterested' => $_POST['genderInterested'],
				'ageLow' => $_POST['ageLow'],
				'ageHigh' => $_POST['ageHigh'],
				'cityState' => $_POST['cityState'],
				'recordCount' => $_POST['recordCount']
			);
			sendRequest('POST', $data, $username, '/search/');	
		}
		/* Get Favorites For User */
		else if ($_POST['type'] == 'favorites') {
			$data = array(
				'token' => $token
			);
			sendRequest('POST', $data, $username, '/favorites/');
		}
		/* Get Matches For User */
		else if ($_POST['type'] == 'matches') {
			$data = array(
				'token' => $token
			);
			sendRequest('POST', $data, $username, '/matches/');
		}
		/* Send Message To User */
		else if ($_POST['type'] == 'sendMessage') {
			$data = array(
				'token' => $token,
				'toUser' => $_POST['toUser'],
				'message' => $_POST['message']
			);
			sendRequest('POST', $data, $username, '/message/');
		}
		/* Delete a Message */
		else if ($_POST['type'] == 'deleteMessage') {
			$data = array(
				'token' => $token,
				'msgId' => $_POST['msgId']
			);
			sendRequest('DELETE', $data, $username, '/message/');
		}
		/* Get Conversation withUser */
		else if ($_POST['type'] == 'getConversation') {
			$data = array(
				'token' => $token,
				'withUser' => $_POST['withUser']
			);
			sendRequest('POST', $data, $username, '/conversation/');
		}
		/* Delete Conversation withUser */
		else if ($_POST['type'] == 'deleteConversation') {
			$data = array(
				'token' => $token,
				'withUser' => $_POST['withUser']
			);
			sendRequest('DELETE', $data, $username, '/conversation/');
		}
		/* Get All Conversations For User */
		else if ($_POST['type'] == 'conversations') {
			$data = array(
				'token' => $token
			);
			sendRequest('POST', $data, $username, '/conversations/');
		}
		/* Register User */
		else if ($_POST['type'] == 'register' && $method == 'POST') {
			createUser($data[1], $_POST['name'], $_POST['email'], $_POST['password']); 
		}
		/* Get User Details */
		else if ($_POST['type'] == 'getUser') {
			$data = array(
				'token' => $token,
				'reqUser' => $_POST['username']
			);
			sendRequest('POST', $data, $username, '/profile/');
		}
		else {
			$response['error']['code'] = '401';
			$response['error']['message'] = 'Bad Request';
			echo json_encode($response);
		}
	}
}
/* If direct access is happening, redirect */
else header('Location: /');
?>
