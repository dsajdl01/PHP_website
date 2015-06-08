<?php
	/**
			php. file for function.php 
			created by David Sajdl
			for PHP FMA
			userName: dsajdl01
		*/
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
	
	/*
		Function that give a text into the header html tags.
		Parameters:
		$headerText = actual text of the heading
		$theValue = value of the heading e.g 1 as h1
		Returns: string with concatenation text and h tag eleemnt with value.
	*/
	function make_heading($headerText, $theValue){	
		$printHeader = '<h'.$theValue.'>'.$headerText.'</h'.$theValue.'>';
		return $printHeader;
	}
?>