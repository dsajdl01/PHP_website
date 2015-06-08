<?php
/*
		Function to join title, first and last names with a space between them.
		Parameters:
		$title = person title and if title is not given it would be automaticaly asigned Mr.
		$first = the person's first name
		$last = the person's surname
		Returns: string containing the person's title and full name.
	*/
	function make_name($first,$last, $title='Mr.'){
		$fullname =  $title.' '.$first.' '.$last;
		return $fullname;
	}
?>