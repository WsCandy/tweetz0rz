<!doctype html>
<html>
	<head>
		<title>Tweetz0rz</title>
	</head>
	<body>
		<? include_once('twitter/twitter-header.php');?>
		<div class="twitter-feed">
			<? foreach ($tweets as $tweet) :?>

				<div class="tweet">

					<p><?= $tweet->text; ?></p>
					<p><?= ago($tweet->created_at); ?></p>
					<p><?= $tweet->id; ?></p>

				</div>

			<? endforeach;?>			
			
		</div>
	</body>
</html>