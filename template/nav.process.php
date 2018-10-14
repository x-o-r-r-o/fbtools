<?php  
if (empty($_SESSION['masuk']) AND @$_GET['module']) {
	if ($_GET['module'] == 'masuk') {
		include "module/masuk/index.php";
	}elseif ($_GET['module'] == 'changelog') {
		include "module/changelog/index.php";
	}elseif ($_GET['module'] == 'tentangaplikasi') {
		include "module/tentangaplikasi/index.php";
	}elseif ($_GET['module'] == 'daftarpengguna') {
		include "module/daftarpengguna/index.php";
	}
	else {
		$_SESSION['execute'] = "<script> sweetAlert('Ehmm!', 'By Passed Detected!', 'error').then(function() {window.location = './?module=masuk'; }); </script>";
	}
}else {
	switch (@$_GET['module']) {

		case 'multiplepost':
		include "module/multiplepost/index.php";
		break;

		case 'multipledeletestatus':
		include "module/multipledeletestatus/index.php";
		break;

		case 'bomlike':
		include "module/bomlike/index.php";
		break;

		case 'addfriend':
		include "module/addfriend/index.php";
		break;

		case 'multipleunfriend':
		include "module/multipleunfriend/index.php";
		break;

		case 'friendrequest':
		include "module/friendrequest/index.php";
		break;

		case 'joingroup':
		include "module/joingroup/index.php";
		break;

		case 'multipleleavegroup':
		include "module/multipleleavegroup/index.php";
		break;

		case 'multipledeletepostgroup':
		include "module/multipledeletepostgroup/index.php";
		break;

		case 'multiplecomment':
		include "module/multiplecomment/index.php";
		break;

		case 'profileguard':
		include "module/profileguard/index.php";
		break;

		case 'botreaction':
		include "module/botreaction/index.php";
		break;
		case 'botreactionmemperbarui':
		include "module/botreaction/memperbarui/index.php";
		break;

		case 'botpostgroup':
		include "module/botpostgroup/index.php";
		break;

		case 'laporan':
		include "module/laporan/index.php";
		break;

		case 'changelog':
		include "module/changelog/index.php";
		break;

		case 'tentangaplikasi':
		include "module/tentangaplikasi/index.php";
		break;

		case 'masuk':
		include "module/masuk/index.php";
		break;

		case 'userinfo':
		include "module/userinfo/index.php";
		break;

		default:
		include "module/dashboard/index.php";
		break;

	}
}
?>