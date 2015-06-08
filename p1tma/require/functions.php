<?php
/*
	php. file for index.php 
	created by David Sajdl
	for PHP TMA
	userName: dsajdl01
*/
	
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
		Function count lines in the file.
		Parameters:
		$file = name of the file
		Returns: number of lines in the file or that file cannot be found.
	*/
	function count_lines_in_file($file){
		if(is_file($file)){
			$linecount = count(file($file));
		}
		else{
			$linecount = 'The file '.$file.' cannot be found';
		}
		return $linecount;
	}
	
	/*
		Function that count lines in the file that where required by article.
		Parameters:
		$file = name of the file
		Returns: value that represent number of lines (files) that required by article
				 or that file cannot be found.
	*/
	function count_articles_file($file){
		if(is_file($file)){
			$myText = file($file);
			$countArticles = 0;
					foreach($myText as $article){
							$str = $article;
							if (strpos($str,'articles') !== false) {
								$countArticles ++;
							}
					}	
		}
		else{
			$countArticles = 'The file '.$file.' cannot be found';
		}
		return $countArticles;
	}
	
	/*
		Function that count bandwidth in byte from the file and convert bites into kb and mb.
		Parameters:
		$file = name of the file
		Returns: string containing concatenation with result in bites, kb and mb with </p> tag 
				 or that file cannot be found.
	*/
	function get_bandwidth_in_bytes($file){
		if(is_file($file)){
			$myFile = file($file);
			$countBits = 0;
					foreach($myFile as $article){
							$str1 = $article;
							$bits = explode(' ',$str1);
							$countBits +=$bits[8];
					}
					$kb = $countBits/1024;
					$mb = $countBits/131078;
					$kb = round($kb,2);
					$mb = round($mb,2);
			return '<p>'.$countBits.' Bytes </p>'.'<p>'. $kb.' KB</p><p>'.$mb.' MB</p>';
		}
		else{
			return 'The file '.$file.' cannot be found';
		}
	}
	
	/*
		Function that rearch for 404 errors and print them out.
		if the filename of 404 errors appear twice than it would not be displayed.
		Parameters:
		$file = name of the file
		Returns: array of the filenames that containing 404 errors or that file cannot be found.
	*/
	function get_404error_list($theFile){
		$fileName[0] = "";
		if(is_file($theFile)){
			$myText = file($theFile);
				$index  = 0;
					foreach($myText as $article){
							$bits = explode(' ',$article);
							if($bits[7] == 404){
								if(!in_array($bits[5], $fileName)){
									$fileName[$index] = $bits[5];
									$index++;
								}
							}
					}
		}
		else{
			$fileName[0] = 'The file '.$theFile.' cannot be found';
		}
		return $fileName;
	}
	
	/*
		Function that count file that contain 404 errors.
		Parameters:
		$file = name of the file
		Returns: number of file that contain 404 errors or that file cannot be found.
	*/
	function count_404_errors($files){
		if(is_file($files)){
			$myText = file($files);
				$count404  = 0;
					foreach($myText as $article){
							$bits = explode(' ',$article);
							if($bits[7] == 404){
								$count404++;
							}
					}
		}
		else{
			$count404 = 'The file '.$files.' cannot be found';
		}
		return $count404;
	}
?>