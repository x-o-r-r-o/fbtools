<?php  
// Include
include "../config/i.function.php";
include "../config/liveprocess.php";
include "../config/timezone.php";
include "../config/mysql.php";


// CHECK FIRST IF USER ALREADY EXIST ON DATABASE
$sql = "SELECT * FROM tb_bot_reaction INNER JOIN tb_user ON tb_bot_reaction.userid=tb_user.userid WHERE status='on'";
$result = $mysql->query($sql);


if ($result->num_rows > 0) {

	while ($read = $result->fetch_array()) {

		// CURL GET FEED FACEBOOK
		$curl = file_get_contents_curl("https://graph.facebook.com/me/home?fields=id&limit={$read['maxprocess']}&access_token={$read['token']}");
		$resultfeed = json_decode($curl);

		//IF TOKEN EXPIRED
		if (@$resultfeed->error->code == "190") {

			$error = $resultfeed->error->message;
			$lastrun = date('d-m-Y H:i:s');

			$sql = "UPDATE tb_bot_reaction SET status='$error', lastrun='$lastrun' WHERE userid='$read[userid]'";

			if ($mysql->query($sql)) {
				// SUCCESS UPDATE
			}

		}else {


			foreach ($resultfeed->data as $post) {

				// CURL FOR REACTION POST
				$curl = file_get_contents_curl("https://graph.facebook.com/{$post->id}/reactions?type={$read['reaction']}&method=post&access_token={$read['token']}");
				$resultfeed = json_decode($curl);

			}

			$lastrun = date('d-m-Y H:i:s');	

			$sql = "UPDATE tb_bot_reaction SET lastrun='$lastrun' WHERE userid='$read[userid]'";

			if ($mysql->query($sql)) {
				// SUCCESS UPDATE
			}

			$sql = "INSERT INTO tb_laporan
			VALUES ('$read[userid]', '$lastrun', 'Bot Reaction')";

			if ($mysql->query($sql)) {
				// SUCCESS UPDATE
			}

		}
	}

}	
?>