<?php
/*
* index.php file for gallery, 
* FMA assignment using MySQL and PHP
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 08/04/2015
*/
	
	$content = '';
	/*
	* include once other PHP files. 
	*/
	require_once 'includes/functions.php';
	require_once 'includes/config.php';
	include 'lang/en.php';
	
	
	/*
	* load headerTemplate.html file into variable call $header 
	* and replace place holds with values.
	*/
//	$fileHead = 'templates/headerTemplate.html';
	//$tplHead = file_get_contents($fileHead);
	$tplHead = getTemplate('templates/headerTemplate.html');
	$tplHead = str_replace('[+page_heading+]',htmlentities($lang['page_heading']), $tplHead);
	$header = $tplHead;
	/*
	* Load footerTemplate.html file and replace 
	* place holds with values and assign footer into variable $content.
	*/
	$tplFooter = getTemplate('templates/footerTemplate.html');
	$webAuthor = make_name('David','Sajdl'); // The designer name should remain in each language the same, therefore name was not added into en.php file .  
	$tplFooter = str_replace('[+footerText+]', htmlentities($lang['ftrText']), $tplFooter);
	$FooterFinal = str_replace('[+webAuthor+]',htmlentities($webAuthor), $tplFooter);	
	/*
	* Load errorTemplate.html file and assigns errorTemplate into variable $tplError
	*/
	$tplError = getTemplate('templates/errorTemplate.html');
	
	/*
	* Load templates/returnBackNavigationTemplate.html template and store it into variable
	*/
	$fileBack = 'templates/returnBackNavigationTemplate.html';
	
	/* 
	* If the connection with database fails, it "exit" here 
	* which stops all further processing by PHP and display error message only.
	*/
	if (mysqli_connect_errno()) {
		exit( getErorrPage(mysqli_connect_error(), $header, $FooterFinal, $lang['title-error']));
	}

	// assign SQL query into variable to create database if database does not exist
	$sql = "CREATE table IF NOT EXISTS thumbnails (
						img_id INT(5) NOT NULL AUTO_INCREMENT,
						img_title VARCHAR(100) NOT NULL,
						img_description VARCHAR(255),
						img_width_sm INT(4) NOT NULL,
						img_height_sm INT(4) NOT NULL,
						img_width_lg INT(4) NOT NULL,
						img_height_lg INT(4) NOT NULL,
						PRIMARY KEY (img_id))
						ENGINE=InnoDB";			
			
	// checking if SQL query does not contain error
	try {
		if(isQueryAlright(mysqli_query($link,$sql), $link) === true){
			// assign SQL query into variable that img_id starts with 1000
			$sql = "ALTER TABLE thumbnails AUTO_INCREMENT = 1000;";
			// checking if SQL query does not contain error
			$res = mysqli_query($link,$sql);
			isQueryAlright($sql, $link);
		}
	}
	catch (Exception $e) {
		/*
		* if yes, it not point to continue and  it "exit" here 
		* which stops all further processing by PHP and display error message only.
		*/
		exit(getErorrPage($e->getMessage(),$header, $FooterFinal, $lang['title-error']));
	}
	
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
			include 'views/thumblails.php';
			break;
		case 'uploading' :
			include 'views/uploading.php';
			break;
		case 'image':
			include 'views/image.php';
			break;
		default:
			include 'views/404.php';
	}
	
	// assign footer template into $content variable
	$content .= $FooterFinal;
	// display $content variavle
	echo $content;
?>