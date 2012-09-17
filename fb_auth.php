<?php
include "config.php";

$code = $_GET['code'];

if(empty($code)) {
	$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
	$dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
	. FB_APPID . "&redirect_uri=" . urlencode(FB_REDIRECT) . "&state="
	. $_SESSION['state'];

	echo("<script> top.location.href='" . $dialog_url . "'</script>");
}

if($_REQUEST['state'] == $_SESSION['state']) {
	$token_url = "https://graph.facebook.com/oauth/access_token?"
	. "client_id=" . FB_APPID . "&redirect_uri=" . urlencode(FB_REDIRECT)
	. "&client_secret=" . FB_SECRET . "&code=" . $code . "&scope=publish_stream";

	$response = @file_get_contents($token_url);
	$params = null;
	parse_str($response, $params);

	$graph_url = "https://graph.facebook.com/me?access_token=" 
	. $params['access_token'];

	$user = json_decode(file_get_contents($graph_url));
	
	$username = $user->username;
	$email = $user->email;
	$facebook_id = $user->id;
	
	// check if user in db => login
	$result = mysql_query("select * from `users` where `facebook_id`='$facebook_id'");
	if (mysql_num_rows($result) == 1)
	{
		$usr = mysql_fetch_array($result);
		$_SESSION['username'] = $usr['username'];
		$_SESSION['uid'] = $usr['id'];
		$_SESSION['access_token'] = $params['access_token'];
	}
	else // if user not in db
	{
		$join_date  = date('Y-m-d h:i:s');
		$query = mysql_query("INSERT INTO `users` (username, email, facebook_id, join_date) 
										VALUES ('$username', '$email', '$facebook_id', '$join_date')");  
		
		$_SESSION['uid'] = mysql_insert_id(); 
		$_SESSION['username'] = $username; 
		$_SESSION['access_token'] = $params['access_token'];
	 
	}
?>
	<script>
		top.location.href='index.php'
	</script>
<?php
}
else {
	echo("The state does not match. You may be a victim of CSRF.");
}