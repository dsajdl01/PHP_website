<?php
/*
*  home.php file for W1 Music home page, 
*  TMA assignment using MySQL and PHP
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 14/02/2015
*/
	
	/*
	* replacing title place holder with value in header and assign header string into $content.
	*/
	$Headstep = str_replace('[+title+]',htmlentities($lang['title_home']), $header);
	$HeadFinal = str_replace('[+body_name+]', htmlentities('homePage'),$Headstep);
	$content .= $HeadFinal;
	
	/*
	* replacing sub_headed place holder with value in heading template and 
	* assign sub-heading string into $content.
	*/
	$headingFinal = str_replace('[+header+]',htmlentities($lang['W1Music_header_home']), $tplHeading);
	$content .= $headingFinal;
	
	// assign summery string from variable $summeryFinal into $content.
	$content .= $summeryFinal;
	
?>