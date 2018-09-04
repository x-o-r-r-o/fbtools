<?php  
include "../config/mysql.php";
if ($mysql) {
	$sql = $mysql->query("
		CREATE TABLE IF NOT EXISTS `tb_bot_postgroup` (
		`id` int(255) NOT NULL AUTO_INCREMENT,
		`userid` varchar(255) NOT NULL,
		`status` text NOT NULL,
		`message` text NOT NULL,
		`groupid` text NOT NULL,
		`time` text NOT NULL,
		`time_setting` text NOT NULL,
		`lastrun` text NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");

	$sql.= $mysql->query("
		CREATE TABLE IF NOT EXISTS `tb_bot_reaction` (
		`userid` varchar(255) NOT NULL,
		`status` text NOT NULL,
		`reaction` text NOT NULL,
		`maxprocess` text NOT NULL,
		`lastrun` text NOT NULL,
		PRIMARY KEY (`userid`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");

	$sql.= $mysql->query("
		CREATE TABLE IF NOT EXISTS `tb_laporan` (
		`userid` text NOT NULL,
		`tanggal` text NOT NULL,
		`type` text NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");

	$sql.= $mysql->query("
		CREATE TABLE IF NOT EXISTS `tb_user` (
		`userid` varchar(255) NOT NULL,
		`name` text NOT NULL,
		`token` text NOT NULL,
		PRIMARY KEY (`userid`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");

	if ($sql) {
		header("location: ../index.php");
	}else {
		echo "Tidak Dapat Membuat Table";
	}
}
?>