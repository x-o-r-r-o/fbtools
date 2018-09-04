<?php  
require_once "../../config/liveprocess.php";
require_once "../../config/i.function.php";
require_once "../../config/session.php";

$token = @$_SESSION['token'];
$type =  @$_POST['type'];
$link = @$_POST['link'];
$delay = @$_POST['delay'];
$target = @$_POST['target'];
$target_count = count($target);
$count_kali = 100 / $target_count;
$message = @$_POST['message'];

if ($target == 0) {
	$response = array('message' => 'error', 'progress' => 100, 'code' => 'Silahkan Pilih Target Untuk Di proses !');
	echo json_encode($response);
	exit;
}

$success = 0;
$error = 0;
$nomor = 0;
foreach ($target as $targetid) {	

	$sendmessage = htmlspecialchars(spin($message));

	if (!empty($link)) {
		$data = array(
			'message' => $sendmessage, 			
			'link' => $link,
			'access_token' => $token, 
			);
	}else {
		$data = array(
			'message' => $sendmessage, 
			'access_token' => $token, 
			);
	}
	$url = "https://graph.facebook.com/{$targetid}/feed";
	$curl = file_get_contents_curl($url,$data);
	$result = json_decode($curl);

	if ($result->id == true) {
		$success = $success + 1;
	}else {
		$error = $error + 1;
	}

	sleep($delay);	
	$processed = ceil($count_kali * $nomor);
	$response = array('message' => $processed . '% complete. execute post with message : ' . $targetid, 'progress' => $processed);
	echo json_encode($response);	
	flush();

	if ($target_count === 1) {
		sleep(1);
	}

	$nomor++;

}

sleep(1);
$response = array('message' => 'Complete', 'progress' => 100, 'success' => $success, 'error' => $error, 'redirect' => '');
echo json_encode($response);
?>