<?php
/*
* function.php file for Gallery, 
* FMA assignment using MySQL and PHP
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 08/04/2015
*/

	/*
	*	make_name() function joins title, first and last names with a space between them.
	*	
	*	@param string $title represent person title and if the title is not given it would be automatically assigned Mr.
	*	@param string represent the person's first name
	*	@param string represent the person's surname
	*	@returns string containing the person's title and full name.
	*
	*/
	function make_name($first,$last, $title='Mr.'){
		$fullname =  $title.' '.$first.' '.$last;
		return $fullname;
	}
	/*
	* getTemplate() function load particular template return back string template
	* 
	* @param string $path that represent path to particular HTML template
	* @param string that represent HTML course code of the template
	*/
	function getTemplate($path){
		return file_get_contents($path);
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
		$head = str_replace('[+body_name+]', htmlentities('errorHandling'),$head);
		$content = $head;
		// get error message template and replace place holders with error value
		$fileEr = 'templates/errorTemplate.html';
		$tplError = file_get_contents($fileEr);
		$erFinal = str_replace('[+error_message+]',htmlentities($error), $tplError);
		$content .= $erFinal;
		// get footer template
		$content .= $footer;
		return $content;
	}

	/*
`	* getErrorMesage function receive the error code associated with uploaded file from the users computer and 
	* compare file with possibles files errors and return error message.
	* 
	* @param error code $file that represent error code associated with uploaded file 
	* @param File name $fileName that represent original name of the file on the user computer
	* @return string an error message
	*/
	function getErrorMesage($file, $fileName) {
	        if ($file === UPLOAD_ERR_INI_SIZE) {
				return 'The size of the file "'. $fileName .'" is too big Please make sure that the file size is less than 2MG.';
			}else if ($file ===  UPLOAD_ERR_NO_FILE){
				return 'You have not entered file. Please upload the file!'; //$lang['noFileEnteredMessage'];
			}else if ($file === UPLOAD_ERR_PARTIAL){
				return 'The uploaded file was only partially uploaded. Please try it again';
			}else if($file === UPLOAD_ERR_FROM_SIZE){
				return 'The file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form, please try it again';		
			}else{
				return 'Undefined error occurred when the file was loaded please try it again';
			}
	}
	/*
	* isQueryAlright() function check is database query do not contain any error
	* if yes an exception is thrown otherwise it return true.
	*
	* @exception string error message only when query contains an error.
	* @return boolean true only if the query does not contain an error.
	*/
	function isQueryAlright($ok, $link){
			if ($ok === false){
				throw new Exception('SQL query error: '. mysqli_error($link));
			}
		return true;
	}
	
	/*
	* img_resize() function enable to resize image and keep proportion of the image. 
	* The new resize image is store into folder that is passed via function parameter
	* and new resize image will have either width or height size which is pass via parameter.
	*
	* @param string $in_img_file represent path to the input image which will be resized.
	* @param string $out_img_file represent path output resize image file name where the resize image would be saved. 
	* @param int $req_width represent maximum width that resize area image would has.
	* @param int $req_height represent maximum height that resize are image would has.
	* @return either array that contains resize image width and height or 
	*				false when the function was not able to resize the image. 
	*/
	function img_resize($in_img_file, $out_img_file, $req_width, $req_height) {
			// Get image file details
			$details = getimagesize($in_img_file);
			// Check image type only jpeg file is allowed 
			//however the gallery system already check the image type before the image is saved into system.
			if ($details !== false) {
					switch ($details[2]) {
						case IMAGETYPE_JPEG: // JPG File
						$src = imagecreatefromjpeg($in_img_file);
						break;
					}
					
					// i.e. calculate the scale factor
					// getting image width and height
					$width = $details[0];
					$height = $details[1];
					// get a new width and height
					if($width < $height){
							if($height < $req_height){
									$new_width = $width;
									$new_height = $height;
							}
							else{
									$size = $req_height/$height;
									$new_height = $req_height;
									$new_width = $width*$size;
							}
					}
					else{
							if($width < $req_width){
									$new_width = $width;
									$new_height = $height;
							}
							else{
									$size = $req_width/$width;
									$new_width = $req_width;
									$new_height = $height*$size;
							}
					}
					// Create the new canvas with a new width and height
					$new = imagecreatetruecolor($new_width, $new_height);
					// Re-sample input image into newly canvas
					imagecopyresampled($new, $src, 0, 0, 0, 0, $new_width,$new_height, $width, $height);
					// Create output jpeg at quality level of 95
					imagejpeg($new, $out_img_file, 95); // Save in images dir
					// Destroy any intermediate image files
					imagedestroy($src);
					imagedestroy($new);
					// Return a width and height if image is successfully resize or failure false
					$array['width'] = $new_width;
					$array['height'] = $new_height;
					return $array;
			} 
			else {
					return false;
			}
			
	}
	/*
	* fillBackBarNavigation() function fill up backBarTemplatehtml file place holders with values
	*
	* @param string $file that represent template of the backBar
	* @param string $title that represent title text which is replaced place holder
	* @param string $goBack that represent buttons name which replace place holder.
	*/			
	function fillBackBarNavigation($file, $title, $goBack){
			$tplBack = file_get_contents($file);
			$tplBack = str_replace('[+title_back+]',htmlentities($title),$tplBack);
			$tplBack = str_replace('[+goBackPage+]',htmlentities($goBack),$tplBack);
		return $tplBack;
	}
?>
