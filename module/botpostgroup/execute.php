<?php  
if (@$_POST['botpostgroup']) {

	if (empty($_POST['target']) AND !empty($_POST['status'])) {
		sweetalert('Grup belum dipilih!','error');		
		header("Location: ./?module=botpostgroup");
		exit;		
	}else {

		$userid = $_SESSION['userid'];
		$name = $_SESSION['name'];
		$token = $_SESSION['token'];
		$status = !empty($_POST['status']) ? $_POST['status'] : 'off';
		$message = $_POST['message'];
		$group = json_encode($_POST['target']);
		$time = $_POST['time'];		
		if ($time == 'setting_jam') {
			$time_setting = implode(',', $_POST['jam']);
		}elseif ($time == 'setting_hari') {
			$time_setting = $_POST['jam_hari'];
		}elseif ($time == 'setting_minggu') {
			$time_setting = implode(',', $_POST['hari'])."_".$_POST['jam_minggu'];
		}

		// CHECK FIRST IF USER ALREADY EXIST ON DATABASE
		$sql = "SELECT userid FROM tb_bot_postgroup WHERE userid='$userid'";
		$result = $mysql->query($sql);

		// IF EXIST UPDATE DATA
		if ($result->num_rows > 0) {

			$sql = "UPDATE tb_bot_postgroup SET 
			status='$status',
			message='$message',
			groupid='$group',
			time='$time',
			time_setting='$time_setting'
			WHERE userid='$userid'
			";
			$mysql->query($sql);
			if ($mysql->query($sql) === TRUE) {
				sweetalert('Berhasil Mengupdate Post Group','success');		
				header("Location: ./?module=botpostgroup");
				exit;
			}
		}else {			
			// IF NOT EXIST CREATE NEW DATA
			$sql = "INSERT INTO tb_bot_postgroup
			VALUES ('', '$userid', '$status', '$message', '$group', '$time', '$time_setting', '')";
			if ($mysql->query($sql) === TRUE) {
				sweetalert('Berhasil Mengatur Post Group','success');		
				header("Location: ./?module=botpostgroup");
				exit;
			}
		}		
		
	}

}
?>