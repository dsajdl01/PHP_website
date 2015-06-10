<?php
/*
*  index.php file for W1 Music, 
*  TMA assignment using MySQL and PHP
*
*  index file allows to load connection with database, get data from different files,
*  switch between the pages and display content.
*	
*	created by David Sajdl
*	userName: dsajdl01
* 	date 14/02/2015
*/



	$content = '';
	/*
	* include once php file. 
	*/
	require_once 'lang/en.php';
	require_once 'includes/functions.php';
	require_once 'includes/config.php';
	
		
	/**
	* to config values defined in config.php as arguments to connect database with M1 Music system.
	*/
	$link = mysqli_connect(
			$config['db_host'], 
			$config['db_user'], 
			$config['db_pass'], 
			$config['db_name']);
	
	/* 
	* If the connection with database fails, it "exit" here 
	* which stops all further processing by PHP.
	*/
	if (mysqli_connect_errno()) {
		$fileEr = 'templates/errorTemplate.html';
		$tplError = file_get_contents($fileEr);
		$erFinal = str_replace('[+error_message+]',htmlentities(mysqli_connect_error()), $tplError);
		exit($erFinal);
	}
	/*
	* load head.html file into variable call $header 
	* and replace place holds with values.
	*/
	$fileHead = 'includes/head.html';
	$tplHead = file_get_contents($fileHead);
	$step1 = str_replace('[+home+]',htmlentities($lang['nav_home']), $tplHead);
	$step2 = str_replace('[+artists+]',htmlentities($lang['nav_artists']), $step1);
	$step3 = str_replace('[+songs+]',htmlentities($lang['nav_songs']), $step2);
	$step4 = str_replace('[+title_home+]',htmlentities($lang['home_title']), $step3);
	$step5 = str_replace('[+title_artist+]',htmlentities($lang['artist_title']), $step4);
	$step6 = str_replace('[+title_song+]',htmlentities($lang['song_title']), $step5);
	$HeadFinal = str_replace('[+page_heading+]',htmlentities($lang['page_heading']), $step6);
	$header = $HeadFinal;
	
	/*
	* load headingTemplate.html file that is sub-heading of each 
	* page view and text of each page, replace place holds with text and 
	* store headingTemplate.html into variable called $tplHeading.
	*/
	$fileHeading = 'templates/headingTemplate.html';
	$tplH = file_get_contents($fileHeading);
	$tplHeading = str_replace('[+sub_text+]', htmlentities($long['lorem_ipsum_text']), $tplH);
	
	/*
	* load errorTemplate.html file that is paragraph of any  page
	* and store errorTemplate.html file into variable called $tplError.
	*/
	$fileEr = 'templates/errorTemplate.html';
	$tplError = file_get_contents($fileEr);
	/*
	* making sql query to find out how many artist 
	* are in database table that are active (artists with at least one song).
 	*/
	$sqlQuery = 'SELECT COUNT(name) as active_artist 
				FROM artist
				WHERE name in (SELECT name
								FROM artist, song
								WHERE artist.id = song.artist_id
								GROUP BY name);';
	
	/*
	* Execute the query and assigning the result to $res.
	*/
	$res = mysqli_query($link,$sqlQuery);

	/*
	* If the query failed, $res will be "false", 
	* here it is tested if does not fail. If yes it will exit.
	*/
	if ($res === false) {
		$erFinal = str_replace('[+error_message+]',htmlentities(mysqli_error($link)), $tplError);
		exit($erFinal);
	}
	/*
	* Declaring variable $numberOfActiveArtist. 
	*/
	$numberOfActiveArtist = '';
	/*
	* Checking if the query returned any value. 
	* If not then into variable $numberOfActiveArtist is assign zero message
	*/
	if (mysqli_num_rows($res) == 0) {
		$numberOfActiveArtist = htmlentities($lang['zoro_message_num_of_artist']);
	} else{ 
		/* 
		* If there is any result it would be only one row from one column,
		* so it does not need it to loop throughout sql result.
		* Then the result of the query is assigned into variable called $numberOfActiveArtist
		*/
		$firstRow = mysqli_fetch_assoc($res);
		$numberOfActiveArtist = htmlentities($firstRow['active_artist']);
	}
	/*
	* Making sql query to find out how many songs 
	* are in database table call song.
 	*/
	$sqlQuery2 =  'SELECT COUNT(title) as num_of_song 
					FROM dsajdl01db.song;';
					
	/*
	* Execute the query and assign the result to $res2.
	*/
	$res2 = mysqli_query($link,$sqlQuery2);

	/*
	* If the query failed, $res2 will be "false", so
	* here it is tested if does not fail. If yes it will exit.
	*/
	if ($res2 === false) {
		$erFinal = str_replace('[+error_message+]',htmlentities(mysqli_error($link)), $tplError);
		exit($erFinal);
	}
	/*
	* Declaring variable $numberOfSongs.
	*/
	$numberOfSongs = '';
	
	/*
	* Checking if the query returned any value. 
	* If not then into variable $numberOfActiveArtist is assign zero message.
	*/
	if (mysqli_num_rows($res2) == 0) {
		$numberOfSongs =  htmlentities($lang['zero_message_num_of_songs']);
	} else{ 
		/* 
		* If there is any result it would be only from one row for from one column,
		* so it does not need it to loop throughout sql result.
		* Then the result of the query is assigned into variable called $numberOfActiveArtist.
		*/
		$firstRow = mysqli_fetch_assoc($res2);
		$numberOfSongs = htmlentities($firstRow['num_of_song']);
	}
	/*
	* Load SummeryTemplate.html file and replace 
	* place holds with values.
	*/
	$fileSum = 'templates/SummeryTemplate.html';
	$tplSum = file_get_contents($fileSum);
	$stepSum1 = str_replace('[+title_for_summery+]',htmlentities($lang['summery_title']), $tplSum);
	$artistSummeryContent = $lang['first_artist_content'] . ' ' . $numberOfActiveArtist . ' ' . $lang['last_artist_content'];
	$stepSum2 = str_replace('[+summery_for_artist+]',htmlentities($artistSummeryContent), $stepSum1);
	$songSummeryContent = $lang['first_song_content'] . ' ' . $numberOfSongs . ' ' . $lang['last_song_content'];
	$summeryFinal = str_replace('[+summery_for_songs+]',htmlentities($songSummeryContent), $stepSum2);
	/*
	* Checking which page link is clicked. When is clicked it gets clicked page view into variable $id 
	* if none is click then it gets home page view.
	*/
	if(!isset($_GET['page'])){
		$id = 'home';
	} else
	{
		$id = $_GET['page'];
	}
	/* 
	* Switch statement to get view when the link is pressed
	* and assign variable called $UrlLink with value.
	*/
	switch ($id){
		case 'home' :
			include 'views/home.php';
			break;
		case 'artists' :
			include 'views/artists.php';
			break;
		case 'songs' :
			include 'views/songs.php';
			break;
		default:
			include 'views/404.php';
	}
	

	/*
	* Load footer.html file and replace 
	* place holds with values and assign footer into variable $content.
	*/
	$fileFooter = 'includes/footer.html';
	$tplFooter = file_get_contents($fileFooter);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$webAuthor = make_name('David','Sajdl'); // The designer name should remain in each language the same, therefore name was not added into en.php file .  
	$passF1 = str_replace('[+footerText+]', htmlentities($lang['ftrText']), $tplFooter);
	$passF2 = str_replace('[+urlLink+]', $actual_link, $passF1);
	$passF3 = str_replace('[+title_validation+]', htmlentities($lang['validation_title_of_html']), $passF2);
	$FooterFinal = str_replace('[+webAuthor+]',htmlentities($webAuthor), $passF3);	
	$content .= $FooterFinal;

	// Display content values.
	echo $content;
?>