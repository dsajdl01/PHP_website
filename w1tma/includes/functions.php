<?php
/*
* function.php file for W1 Music, 
* TMA assignment using MySQL and PHP
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 14/02/2015
*/

	/*
	*	make_name() function joins title, first and last names with a space between them.
	*	
	*   Parameters:
	*	$title = person title and if title is not given it would be automatically assigned Mr.
	*	$first = the person's first name
	*	$last = the person's surname
	*	Returns: string containing the person's title and full name.
	*
	*/
	function make_name($first,$last, $title='Mr.'){
		$fullname =  $title.' '.$first.' '.$last;
		return $fullname;
	}

	/*
	* getTime() function converts integer into time string as minutes and second - mm::ss.
	* If the integer is greater then 59 minutes and 59 seconds then one hour not will be displayed
	* as it is unlikely that any song would have duration more that 1 hour.
	* 
	* Parameters: duration
	* $duration integer 
	* return string that represent minutes and second e.g; 22:05
	*/
	function getTime($duration){
		$t = round($duration);
		return sprintf('%02d:%02d', ($t/60%60), $t%60);
	}
	/*
	* getErorrPage() function enable to replace place holder with values and 
	* return html page that contain header footer and one text paragraph which represent error message as a body.
	*
	* @param string $error that represent error message which is content of the page text.
	* @param string $head that represent header template include body of the page.
	* @param string $footer that represent footer template of the page.
	* @param string $title that represent title of the web page.
	* @return string that represent completed html web page. 
	*/
	function getErorrPage($error, $head, $footer, $title){
		// get header and replace place holders with title and error values
		$head = str_replace('[+title+]',htmlentities($title), $head);
		$head = str_replace('[+error_message+]', $error, $head);
		$content = $head;
		// get error message template and replace place holders with error value
		//$fileEr = 'templates/errorTemplate.html';
		//$tplError = file_get_contents($fileEr);
		//$erFinal = str_replace('[+error_message+]',htmlentities($error), $tplError);
		//$content .= $erFinal;
		// get footer template
		$content .= $footer;
		return $content;
	}

?>
