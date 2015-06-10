<?php
/*
*  artist.php file for W1 Music artist page, 
*  TMA assignment using MySQL and PHP
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 14/02/2015
*/
	
	/*
	* replacing title place holder with value in header and assign header string into $content.
	*/
	$Headstep = str_replace('[+title+]',htmlentities($lang['title_artists']), $header);
	$HeadFinal = str_replace('[+body_name+]', htmlentities('artistPage'),$Headstep);
	$content .= $HeadFinal;
	
	/*
	* replacing sub_headed place holder with value in heading template and 
	* assign sub-heading string into $content.
	*/
	$headingFinal = str_replace('[+header+]',$lang['W1Music_header_artist'], $tplHeading);
	$content .= $headingFinal;
	
	// assign summery string from variable $summeryFinal into $content.
	$content .= $summeryFinal;
	
	/*
	* making sql query to fing out artist with their songs  
	* from database tables artist and songs.
	*/
	$sql = "SELECT name, COUNT(title) as songs
			FROM artist, song
			WHERE artist.id = song.artist_id
			GROUP BY name 
			ORDER BY name ASC;";
			
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
	
	// declare variable called $artists.
	$artists = '';
	
	/*
	* Check if the query returned any value 
	* if not then get error message.
	*/
	if (mysqli_num_rows($result) == 0) {
		$erFinal = str_replace('[+error_message+]',htmlentities($lang['error_message_artist']), $tplError);
		$artists .= $erFinal;
	} else {
		/*
		* If query returned any value get artistTemplate.html into variable "which is the 
		* header of the table", replace place holder with values
		* and assign variable into $content variable.
		*/
		$fileArtTemp = 'templates/artistTemplate.html';
		$tplArt = file_get_contents($fileArtTemp);
		$stepA1 = str_replace('[+name+]',htmlentities($lang['table_heading_name']), $tplArt);
		$ArtFinal = str_replace('[+num_of_song+]',htmlentities($lang['table_heading_songs']), $stepA1);
		$content .= $ArtFinal;
		
		/*
		* Loop through $result, converting each record from the result 
		* and set it to an array which is called $row.
		*/
		while ($row = mysqli_fetch_assoc($result)) {
			
			/*
			* assigning the values in $row using the database column names as array keys 
			* into variables called $artistName, $artist_num_of_songs.
			*/
			$artistName = $row['name'];
			$artist_num_of_songs = $row['songs'];

			/*
			*  load atristDivTableTemplate.html into variable and assign 
			* place holder with database result from variables $artistName, $artist_num_of_songs.
			* Then template variable with database values are assign into variable called $artists. 
			*/
			$fileTempArtTbl = 'templates/atristDivTableTemplate.html';
			$tpltbl = file_get_contents($fileTempArtTbl);
			$stepT1 = str_replace('[+art_name+]',htmlentities($artistName), $tpltbl);
			$tblFinal = str_replace('[+num_of_songs+]',htmlentities($artist_num_of_songs), $stepT1);
			$artists .= $tblFinal;
		}
	}
	// assigning $artists values into $content variable. 
	$content .= $artists;
?>