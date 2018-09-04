<?php  
require_once "../../config/liveprocess.php";
require_once "../../config/i.function.php";
require_once "../../config/session.php";

$posturl = @$_POST['postid'];
$postidsearch =  preg_match('/[^\/|\.!=][0-9]{7,}(?!.*[0-9]{7,})\d+/',$posturl,$matches);
$postid = $matches[0];
$token = @$_SESSION['token'];
$delay = @$_POST['delay'];
$max = @$_POST['max'];
$count_kali = 100 / $max;
$images =  @$_POST['images'];
$imagesX = explode("||", $images);
$message = @$_POST['message'];

$success = 0;
$error = 0;
$nomor = 0;
for ($i=1; $i <= $max; $i++) { 
	
	if ($message !== 'massup' or $message !== 'massnumb') {
		$sendmessage = urlencode(spin($message));
	}else {		
		$sendmessage = ($message == 'massup' ? urlencode("up ".base64_encode(rand(000,999))) : rand(000000000,999999999));
	}
	
	if (!empty($images)) {
		$rand = array_rand($imagesX);
		$imagesrand = $imagesX[$rand];
		$url = "https://graph.facebook.com/{$postid}/comments?method=POST&attachment_url={$imagesrand}&message={$sendmessage}&access_token={$token}";
	}else {
		$url = "https://graph.facebook.com/{$postid}/comments?method=POST&message={$sendmessage}&access_token={$token}";
	}

	$curl = file_get_contents_curl($url);
	$result = json_decode($curl);

	if ($result->id) {
		$success = $success + 1;
	}else {
		$error = $error + 1;
	}

	sleep($delay);	
	$processed = ceil($count_kali * $nomor);
	$response = array('message' => $processed . '% complete. Selesai Mengirim dengan pesan : '. $sendmessage, 'progress' => $processed);
	echo json_encode($response);	
	flush();

	if ($max === 1) {
		sleep(1);
	}

	$nomor++;
}

sleep(1);
$response = array('message' => 'Complete', 'progress' => 100, 'success' => $success, 'error' => $error);
echo json_encode($response);
?>