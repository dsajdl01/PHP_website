<?php
/*
*   uploading.php file for gallery, page upload image, 
* 	FMA assignment using MySQL and PHP.
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 08/04/2015
*/

	// initialize variables
	$title = "";
	$summary = "";
	$success = "";
	$errorBrowserMessage = "";
	$errorTitleMessage = "";
	$errorSummaryMessage  = "";
	$errorDetected = false;
	$formIsSubmitted = false;
	$clean = array();
	
	/*
	* replacing place holders with values in header template and assign header string into $content.
	*/
	$header = str_replace('[+title+]',htmlentities($lang['title-loading']), $header);
	$header = str_replace('[+body_name+]', htmlentities('loadingPage'),$header);
	$content .= $header;
	
	/*
	*	dealing with form submitting
	*/
	// when the submit button is pressed then
	if (isset($_POST['upload'])) {
		$formIsSubmitted = true;
		// check if title of the image is entered
		if(empty($_POST['titleOfImage'])){
				$errorTitleMessage = $lang['titleErrorMessage'];
				$errorDetected  = true;
	}
	else{
			// checking if the title do not contain html elements
			if (isValid(trim($_POST['titleOfImage']))) {
					$clean['titleOfImage'] = trim($_POST['titleOfImage']);
			} 
			else {
					$errorTitleMessage = $lang['invalidImageTitle'];
					$errorDetected  = true;
			}
	}

		// check if summary of the image is entered
		if(empty($_POST['summaryOfImage'])){
				$errorSummaryMessage = $lang['summaryErrorMessage'];
				$errorDetected  = true;
		}
		else{
				// checking  if image summary do not contain htlm elements
				if (isValid(trim($_POST['summaryOfImage']))) {
					$clean['summaryOfImage'] = trim($_POST['summaryOfImage']);
				} 
				else {
					$errorSummaryMessage = $lang['invalidTextSummary'];
					$errorDetected  = true;
				}

				
		}
		// check if any file is uploaded into form 
		if (is_uploaded_file($_FILES['userfile']['tmp_name']) && $_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
				// if yes, check if uploaded file is only .JPEN file (image) 
				if(exif_imagetype($_FILES['userfile']['tmp_name']) != IMAGETYPE_JPEG){
					$errorBrowserMessage =  $lang['noJPEGFileMessage'];
					$errorDetected  = true;
				} 
				// then check if both folders Thumbs and Thumbs_small exist
				else if ((!is_dir($config['thumbs_dir'])) || (!is_dir($config['thumbs_small_dir']))){
					$errorDetected = true;
					$errorBrowserMessage = $lang['fileDoNOTExist'];
						
				}
				//  then check if both folders Thumbs and Thumbs_small are writeable.
				else if((!is_writable($config['thumbs_dir'])) || (!is_writable($config['thumbs_small_dir']))){
					$errorDetected = true;
					$errorBrowserMessage = $lang['notWriteableFile'];
				}
				
		}
		// if file is not uploaded get correct error 
		else {
				$errorBrowserMessage = getErrorMesage($_FILES['userfile']['error'], basename($_FILES['userfile']['name']));
				$errorDetected  = true;
		}
	}
	//if all data and image .jpen are inserted and files are writeable then
	if($errorDetected === false && $formIsSubmitted === true){
		$newTitle = $clean['titleOfImage'];
		// try if any errors occur through process
		try{
			$isUnique = false;
			$number = 1;
			// get unique title for a new image
			while ($isUnique === false){
				// title can not be all as with all id is used to retrieve all available JSON data in gallery 
				if($newTitle == 'all'){
					$newTitle = 'All';
				}
				// checking if title already exist in database
				$sql = "SELECT COUNT(img_title) as num FROM dsajdl01db.thumbnails WHERE  img_title = '$newTitle'";
				$result = mysqli_query($link, $sql);
				if(isQueryAlright($result, $link) === true){
					$row = mysqli_fetch_assoc($result);
					//if title does not exist set isUnique variable to true.
					if($row['num'] == 0){
					   $isUnique = true;
					// if title exist add _01 to the title and check database again. If title exist again then add _02 and so on.
					}else{
						$newTitle = $clean['titleOfImage'];
						$newTitle .='_0'.$number;
						// $isUnique = false;
						$number = $number + 1;
					}
				}
			}
			// add uploaded image into file as image.jpeg
			$newname = $config['thumbs_dir'].'image.jpeg';
			$tmpname = $_FILES['userfile']['tmp_name']; 
			//check if image.jpeg is successfully moved to a new location
			if (move_uploaded_file($tmpname, $newname)) {
				// if yes then:
				//resize image.jpeg either width or height to 600px and save it
				$res = img_resize('thumbs/image.jpeg', $config['thumbs_dir'].$newTitle.'.jpeg', 600, 600);
				// if the image is not resized delete image.jpeg from the file and throw en exception error
				// which will finish further steps in try condition 
				if($res === false){
					$errorDetected  = false;
					unlink($config['thumbs_dir'].'image.jpeg');
					throw new Exception($lang['uploadedFailMessage']);
				// if the image is resized and saved then 
				} else{
					// store width and height of the resized image 
					$lg_width = $res['width'];
					$lg_height = $res['height'];
					//resize image.jpeg again now with either width or height to 150px and save it
					$res = img_resize('thumbs/image.jpeg', $config['thumbs_small_dir'].$newTitle.'.jpeg', 150, 150);
					// if the image is not resized delete image.jpeg and both resizing images from the file and throw en exception error
					// which will finish further steps in try condition 
					if($res === false){
						unlink($config['thumbs_dir'].'image.jpeg');
						unlink($config['thumbs_dir'].$newTitle.'.jpeg');
						throw new Exception($lang['uploadedFailMessage']);
					}
					// if the image is resized then
					else{
						// delete image.jpeg as it is not needed any more
						unlink($config['thumbs_dir'].'image.jpeg');
						// insert title, summary, widths and heights of the both resize images into database.
						$sql = 'INSERT INTO thumbnails (img_title, img_description, img_width_sm, img_height_sm, img_width_lg, img_height_lg) 
								VALUES (\''.$newTitle.'\', \''.$clean['summaryOfImage'].'\',\''.$res['width'].'\',\''.$res['height'].'\',\''.$lg_width.'\',\''.$lg_height.'\')';
						$result = mysqli_query($link, $sql);
						// check if data is inserted into database
						if($result === false){
							// if not delete both resized images and throw en exception
							unlink($config['thumbs_small_dir'].$newTitle.'.jpeg');
							unlink($config['thumbs_dir'].$newTitle.'.jpeg');
							throw new Exception('SQL query error: '. mysqli_error($link));
						}
						// if resize images and data are process successfully get message
						$success = $lang['uploadedFileMessage'];
					}
				}
			}
			//if the image form the form is not uploaded get an error message
			else {
				$errorDetected  = false;
				$browserErrorMessage = $lang['uploadedFailMessage'];
			}
		// if any exception is thrown catch an error message	
		} catch (Exception $e) {
			$errorBrowserMessage = $e->getMessage();
		}
	}
	// if any data is entered into form by user then retrieve data.
	else{
			// if title is enterd get title
			if (isset($clean['titleOfImage'])) {
				$title = htmlentities($clean['titleOfImage']);
			}
			// if summary is entered get summary
			if(isset($clean['summaryOfImage'])){
				$summary = htmlentities($clean['summaryOfImage']);
			}
	}

	/*
	* replace place holder with value of returnBackNavigationTemplate 
	* and assign returnBackNavigationTemplate into $content variable
	*/
	$content .= fillBackBarNavigation($fileBack,$lang['title_back'],$lang['goBackPage']);

	/*
	* load loadPageTemplate.html into variable and replace place holders with values.
	* Then template variable with a new values are assigned into variable $content.
	*/
	$server = htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');
	$tplLoad = getTemplate('templates/loadPageTemplate.html');
	$tplLoad = str_replace('[+server+]', htmlentities($server),$tplLoad);
	$tplLoad = str_replace('[+loadingText+]', htmlentities($lang['loadingText']),$tplLoad);
	$tplLoad = str_replace('[+titleErrorMessage+]', htmlentities($errorTitleMessage),$tplLoad);
	$tplLoad = str_replace('[+summaryErrorMessage+]', htmlentities($errorSummaryMessage),$tplLoad);
	$tplLoad = str_replace('[+browserErrorMessage+]', htmlentities($errorBrowserMessage),$tplLoad);
	$tplLoad = str_replace('[+titleImage+]', htmlentities($title),$tplLoad);
	$tplLoad = str_replace('[+summaryImage+]', htmlentities($summary),$tplLoad);

	$tplLoad = str_replace('[+uploadFileTitle+]', htmlentities($lang['uploadFileTitle']),$tplLoad);
	$tplLoad = str_replace('[+uploadTitle+]', htmlentities($lang['uploadTitle']),$tplLoad);
	$tplLoad = str_replace('[+uploadSummaryTitle+]', htmlentities($lang['uploadSummaryTitle']),$tplLoad);

	$tplLoad = str_replace('[+imageLoading+]', htmlentities($lang['imageLoading']),$tplLoad);
	$tplLoad = str_replace('[+uploadFile+]', htmlentities($lang['uploadFile']),$tplLoad);
	$tplLoad = str_replace('[+uploadingSuccess+]', htmlentities($success),$tplLoad);
	$content .= $tplLoad;
?>