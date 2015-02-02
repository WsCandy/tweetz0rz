<? 
	session_start();
	require_once("twitter/twitteroauth.php");
	 
	$twitteruser = "xxx";
	$notweets = 10;
	$consumerkey = "xxx";
	$consumersecret = "xxx";
	$accesstoken = "xxx";
	$accesstokensecret = "xxx";
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {

	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;

	}
	 
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);	 
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

	foreach ($tweets as $tweet) {

		$tweet->text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@','<a href="$1" target="_blank">$1</a>', $tweet->text);
		$tweet->text = preg_replace('/@(\w+)/','<a href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet->text);
		$tweet->text = preg_replace('/\s+#(\w+)/',' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $tweet->text);

	}