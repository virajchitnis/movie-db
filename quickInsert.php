<?php
	function downloadFile ($url, $path) {
		$newfname = $path;
		$file = fopen ($url, "rb");
		
		if ($file) {
			$newf = fopen ($newfname, "wb");
			if ($newf)
			while(!feof($file)) {
				fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
			}
		}

		if ($file) {
			fclose($file);
		}

		if ($newf) {
			fclose($newf);
		}
	}

	if((isset($_GET["id"]))&&(isset($_GET["quality"]))){
		$id = $_GET["id"];
		$tempqual = $_GET["quality"];
		$quality;
		
		if($tempqual=='10'){
			$quality = '1080p HD';
		}
		else if($tempqual=='7'){
			$quality = '720p HD';
		}
		
		$source = file_get_contents('http://www.omdbapi.com/?i='.$id);
		$info = json_decode($source, TRUE);
		
		$poster = 'posters/'.$id.'.jpg';
		downloadFile($info['Poster'], $poster);
		$name = $info['Title'];
		$year = $info['Year'];
		$time = $info['Runtime'];
		$genre = $info['Genre'];
		$rating = $info['Rated'];
		$link = 'http://www.imdb.com/title/'.$id;
		
		include 'config.php';
		$connection = mysql_connect($HOSTNAME,$USERNAME,$PASSWORD) or die('Connection failed!');
		mysql_select_db($DATABASE,$connection) or die('Database select failed!');
		
		$query = 'INSERT INTO Movies VALUES(\''.$id.'\',\''.$poster.'\',\''.$name.'\',\''.$year.'\',\''.$time.'\',\''.$genre.'\',\''.$rating.'\',\''.$quality.'\',\''.$link.'\')';
		
		echo $query;
		echo '<br>';
		
		$result = mysql_query($query,$connection) or die('Insert failed!');
		
		mysql_close($connection);
		
		//header('Location: ./');
	}
	else{
		echo 'No field must be empty, please go back and fill all fields.';
	}
?>