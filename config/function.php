<?php  
function sign_creator(&$data){
	$sig = "";
	foreach($data as $key => $value){
		$sig .= "$key=$value";
	}
	$sig .= 'c1e620fa708a1d5696fb991c1bde5662';
	$sig = md5($sig);
	return $data['sig'] = $sig;
}
?>