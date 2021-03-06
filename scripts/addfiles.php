<?php
include '../config/config.php';
$db = new mysqli($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$movies_table = $db->prepare("SELECT id, name, quality FROM Movies;");
$movies_table->execute();
$movies_table->bind_result($id, $name, $quality);

while($movies_table->fetch()){
	$db2 = new mysqli($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
	$db_count = $db2->prepare("SELECT count(id) FROM Files WHERE id = ?;");
	$db_count->bind_param('s', $id);
	$db_count->execute();
	$db_count->bind_result($count_id);
	$db_count->fetch();
	$db_count->free_result();

	if($count_id == 0){
		$link_quality;
		if($quality == "1080p HD"){
			$link_quality = "iTunes Movies (1080p HD)";
		}
		if($quality == "720p HD"){
			$link_quality =	"iTunes Movies (720p HD)";
		}
		if($quality == "SD"){
			$link_quality =	"iTunes Movies (SD)";
		}
		
		if (file_exists("../movies/".$link_quality."/".$name.".m4v")) {
			$file_name = $name.".m4v";
			echo $file_name."<br>";
			$db_files = $db2->prepare("INSERT INTO Files VALUES(?, ?);");
			$db_files->bind_param('ss', $id, $file_name);
			$db_files->execute();
			$db_files->free_result();
		}
	}
}
?>