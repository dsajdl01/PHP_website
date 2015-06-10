<?php
/*
*   songs.php file for W1 Music, page songs, 
* 	TMA assignment using MySQL and PHP.
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 14/02/2015
*/
	/*
	* replacing title place holder with value in header and assign header string into $content.
	*/
	$Headstep = str_replace('[+title+]',htmlentities($lang['title_songs']), $header);
	$HeadFinal = str_replace('[+body_name+]', htmlentities('songsPage'),$Headstep);
	$content .= $HeadFinal;
	
	/*
	* replacing sub_headed place holder with value in heading template and 
	* assign sub-heading string into $content.
	*/
	$headingFinal = str_replace('[+header+]',$lang['W1Music_header_songs'], $tplHeading);
	$content .= $headingFinal;
	
	// assign summery string from variable $summeryFinal into $content.
	$content .= $summeryFinal;
	
	/*
	* making sql query to find out all title of the song, who sing that particular song 
	* and duration of the song from database tables artist and songs.
	*/
	$sql = 'SELECT title, name, duration
			FROM song, artist
			WHERE song.artist_id =  artist.id
			ORDER BY name, title;';
	
	/*
	* Execute the query and assigning the result to $result.
	*/
	$result = mysqli_query($link,$sql);

	/*
	* If the query failed, $result will be "false", 
	* here it is tested if does not fail. If yes it will exit.
	*/
	if ($result === false) {
		$erFinal = str_replace('[+error_message+]',htmlentities(mysqli_error($link)), $tplError);
		exit($erFinal);
	}
	// declare variable called $songs.
	$songs = '';
	
	/*
	* Checking if the query returned any value 
	* if not then get error message.
	*/
	if (mysqli_num_rows($result) == 0) {
		$erFinal = str_replace('[+error_message+]',htmlentities($lang['error_message_song']), $tplError);
		$songTemplateFinal = $erFinal;
	} else {
		/*
		* if query returned any value then songsTemplate.html is inserted into variable 
		* "which is the header of the table", and place holders are replaced with values
		* and then assign into variable $songTableTitle.
		*/
		$fileSongTemp = 'templates/songsTemplate.html';
		$tplSong = file_get_contents($fileSongTemp);
		$stepS1 = str_replace('[+songTitle+]',htmlentities($lang['table_heading_song_title']), $tplSong);
		$stepS2 = str_replace('[+song_Artist+]',htmlentities($lang['table_heading_songs_artist']), $stepS1);
		$songTableTitle = str_replace('[+song_duration+]',htmlentities($lang['table_heading_songs_duration']), $stepS2);
		
		
		/*
		* Loop through sql query result; $result, converting each record from the result 
		* and set it to an array which is called $row.
		*/
		while ($row = mysqli_fetch_assoc($result)) {
			
			/*
			* assigning the values in $row using the database column names as array keys 
			* into variables called $songName, $artist_name and $song_duration.
			*/
			$songName = $row['title'];
			$artist_name = $row['name'];
			$song_duration = $row['duration'];
			
			/*
			* load songTableTemplate.html into variable and assign 
			* place holder with database result from variables $songName, $artist_name and $song_duration.
			* Then template variable with database values are assigned into variable called $songs.
			*/
			$fileSongTblTemp = 'templates/songTableTemplate.html';
			$tplSongTbl = file_get_contents($fileSongTblTemp);
			$stepSt1 = str_replace('[+songTlt+]',htmlentities($songName), $tplSongTbl);
			$stepSt1 = str_replace('[+songTlt+]',htmlentities($songName), $tplSongTbl);
			$stepSt2 = str_replace('[+songs_artists+]',htmlentities($artist_name), $stepSt1);
			$SongTFinal = str_replace('[+song_time+]',htmlentities(getTime($song_duration)), $stepSt2);
			$songs .= $SongTFinal;
		}
		/*
		* replace songsTemplate.html place holder content with songTableTemplate 
		* hat has sql result and then store it to $songs variable.
		*/
		$songTemplateFinal	= str_replace('[+tableContent+]',$songs, $songTableTitle);
	}
	
	// assigning $songTemplateFinal values into $content variable. 
	$content .= $songTemplateFinal;
	
?>