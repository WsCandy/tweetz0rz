# tweetz0rz

That's right, this is a Twitter feed.... mmmm.

All the settings can be found in twitter/twitter-header.php

To output on a page simply include the header and you're good to go!

	<? include_once('twitter/twitter-header.php');?>

	<? foreach ($tweets as $tweet) :?>

		<div class="tweet">

			<p><?= $tweet->text;?></p>
			<p><?= $tweet->elapsed;?> - <?= $tweet->date;?></p>
			<p><?= $tweet->id;?></p>

		</div>

	<? endforeach;?>

Hash tags and links and @'s are parsed and linked automatically.