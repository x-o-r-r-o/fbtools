<?php  
require_once '../../lib/limit.php';
require_once '../../lib/flush.php';
require_once '../../lib/function.php';
require_once '../../lib/language.php';

$token = $_POST['token_access'];
$max_process = @$_POST['max_process'];
$keyword = @$_POST['keyword'];

if (empty($keyword)) {
	$result_progress = $lang['KEYWORD_NOT_FOUND'];
	$jsonresult = array('result' => $result_progress, 'process' => '');
	echo json_encode($jsonresult);
	exit;	
}

$url = "https://graph.facebook.com/search?q={$keyword}&limit={$max_process}&type=group&access_token={$token}";

$curl = file_get_contents_curl($url);
$result = json_decode($curl);

if (!empty($result->error)) {
	$error = $result->error->message;
	$result_progress = $error;
	$jsonresult = array('result' => $result_progress, 'process' => '');
	echo json_encode($jsonresult);
	exit;	
}else {		

	if (empty(@$result->data)) {
		$result_progress = $lang['READ_TOKEN_DATA'];
		$jsonresult = array('result' => $result_progress, 'process' => '');
		echo json_encode($jsonresult);
		exit;
	}
	foreach ($result->data as $key => $value_search) {		

		sleep(1);
		$result_progress = $value_search->id;
		$jsonresult = array('result' => $result_progress, 'process' => $lang['FINIS_PROCESSING_ID'].' : '. $value_search->id);
		echo json_encode($jsonresult);	

	}
}

sleep(1);
$jsonresult = array('result' => '', 'process' => $lang['FINISH']);
echo json_encode($jsonresult);

?>