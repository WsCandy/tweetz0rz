<? 
	session_start();
	require_once("twitter/twitteroauth.php");
	 
	$twitteruser = "xxx";
	$notweets = 10;
	$consumerkey = "xxx";
	$consumersecret = "xxx";
	$accesstoken = "xxx";
	$accesstokensecret = "xxx";

	// See PHP Date
	$date_format = 'dS M Y';
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {

	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;

	}

	function ago($time)	{

		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");

		$now = time();

		$difference = $now - strtotime($time);
		$tense = "ago";

		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {

			$difference /= $lengths[$j];

		}

		$difference = round($difference);

		if($difference != 1) {

		   $periods[$j].= "s";

		}

		return "$difference $periods[$j] ago ";

	}
	 
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);	 
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

	foreach ($tweets as $tweet) {

		$tweet->text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@','<a href="$1" target="_blank">$1</a>', $tweet->text);
		$tweet->text = preg_replace('/@(\w+)/','<a href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet->text);
		$tweet->text = preg_replace('/\s+#(\w+)/',' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $tweet->text);
		$tweet->elapsed = ago($tweet->created_at);
		$tweet->date = date($date_format, strtotime($tweet->created_at));

	}