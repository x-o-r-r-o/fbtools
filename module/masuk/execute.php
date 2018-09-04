<?php  
if (@$_POST['tokeniphone']) {

	// Declaration Variable
	$username = $_POST['username'];
	$password = $_POST['password'];

	$data = array(
		"api_key" => "3e7c78e35a76a9299309885393b02d97",
		"email" => @$username,
		"format" => "JSON",
		//"generate_machine_id" => "1",
		//"generate_session_cookies" => "1",
		"locale" => "en_US",
		"method" => "auth.login",
		"password" => @$password,
		"return_ssl_resources" => "0",
		"v" => "1.0"
		);
	sign_creator($data);
	$result = "https://graph.facebook.com/restserver.php?".http_build_query($data);
	$_SESSION['execute'] = "
	<script> 
		var span = document.createElement('span');
		span.innerHTML = '<div class=\"c-alert c-alert--info\">Untuk Mendapatkan token Anda Buka URL dibawah ini :</div><div class=\"c-field has-addon-right u-mb-small\"><input class=\"c-input\" id=\"socialProfile\" type=\"text\" value=\"".$result."\"><span class=\"c-field__addon\"><a href=\"".$result."\" target=\"_blank\" class=\"c-btn c-btn--success\" style=\"border-left: 0; border-top-left-radius: 0; border-bottom-left-radius: 0; \">Open</a></span></div><div class=\"c-alert c-alert--info u-mt-medium\">Petunjuk Pengambilan Token, Klik Gambar dibawah ini :</div><a target=\"_blank\" href=\"assets/img/howtoget+token.png\"><img src=\"assets/img/howtoget+token.png\"/></a>';
		swal({
			title: 'Sukses Membuat URL !', 
			content: span,
		});
	</script>";
	header("Location: ./?module=masuk");
	exit;

}elseif (@$_POST['token']) {

	// Declaration Variable
	$token = $_POST['token'];

	// CURL VALIDATION IPHONE TOKEN
	$api = file_get_contents_curl("https://graph.facebook.com/app?access_token={$token}");
	$result = json_decode($api);
	$checkiphone = @$result->id;

	// CHECK TOKEN VALIDATION
	if (@$result->error->code == "190") {
		sweetalert($result->error->message,'error');		
		header("Location: ./?module=masuk");
		exit;
	}else {	
		if ($checkiphone == '6628568379') {
			// CURL
			$api = file_get_contents_curl("https://graph.facebook.com/me?fields=name,picture&access_token={$token}");
			$result = json_decode($api);

			$userid = $result->id;
			$name = $result->name;

			// IF SUCCESS CREATE SESSION
			$_SESSION['masuk'] = true;
			$_SESSION['userid'] = $result->id;
			$_SESSION['name'] = $result->name;
			$_SESSION['picture'] = $result->picture;
			$_SESSION['token'] = $token;

			// CHECK FIRST IF USER ALREADY EXIST ON DATABASE
			$sql = "SELECT userid FROM tb_user WHERE userid='$userid'";
			$result = $mysql->query($sql);

			// IF EXIST UPDATE DATA
			if ($result->num_rows > 0) {

				$sql = "UPDATE tb_user SET name='$name', token='$token' WHERE userid='$userid'";
				if ($mysql->query($sql) === TRUE) {
					sweetalert('Berhasil Masuk! Selamat Datang Kembali '.$name,'success');		
					header("Location: ./");
					exit;
				}
			}else {			
				// IF NOT EXIST CREATE NEW DATA
				$sql = "INSERT INTO tb_user
				VALUES ($userid, '$name', '$token')";
				if ($mysql->query($sql) === TRUE) {
					sweetalert('Berhasil Masuk! Selamat Datang User Baru','success');		
					header("Location: ./");
					exit;
				}
			}

		}else {
			sweetalert('Bukan Token Iphone Nih!','error');	
			header("Location: ./?module=masuk");
			exit;
		}
	}

}
?>