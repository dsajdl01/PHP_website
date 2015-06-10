<?php
/*
*   image.php file for gallery, page of individual image, 
* 	FMA assignment using MySQL and PHP.
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 08/04/2015
*/

	
	try{
		// get image id
		$id = $_GET['type'];
		/*
		* retrieve data information about particular image from database
		*/
		$sql = 'SELECT img_title, img_description, img_width_lg, img_height_lg 
				FROM thumbnails
				WHERE img_id = \''.$id.'\'';
		$result = mysqli_query($link, $sql);
		//if data are retrieved from database successfully then
		if(isQueryAlright($result, $link) === true){
			
			// it is only one row so, the loop is not needed and the data is assigned into $row variable
			$row = mysqli_fetch_assoc($result);
			
			if($row == 0) { throw new Exception('The image id '. $id . ' is not in gallery system. Please check image\'s id');}
			/*
			* replacing place holders with values in header template and assign header string into $content.
			*/
			$title = $lang['title_image'] . $row['img_title'];
			$header = str_replace('[+title+]',htmlentities($title), $header);
			$header = str_replace('[+body_name+]', htmlentities('imagePage'),$header);
			$content .= $header;
			
			/*
			* assign place holder with value of returnBack template 
			* and assign returnBack template into $content variable
			*/
			//$fileBack = 'templates/returnBackTemplate.html';
			$content .= fillBackBarNavigation($fileBack,$lang['title_back'],$lang['goBackPage']);
			
			/*
			* load imageTemplate.html into variable and assign place holders with values.
			* Then template variable with a new values are assigned into variable content
			*/
			$tplImg = getTemplate('templates/imageTemplate.html');
			$tplImg = str_replace('[+imageTitle+]',htmlentities($row['img_title']),$tplImg);
			$tplImg = str_replace('[+imageGoBack+]', htmlentities($lang['title_back']),$tplImg);
			$tplImg = str_replace('[+imagePath+]','thumbs/'.$row['img_title'],$tplImg);
			$tplImg = str_replace('[+imgWidth+]',$row['img_width_lg'], $tplImg);
			$tplImg = str_replace('[+imgHeight+]',$row['img_height_lg'], $tplImg);
			$tplImg = str_replace('[+imageName+]',$row['img_title'], $tplImg);
			$tplImg = str_replace('[+imageSummerey+]',$row['img_description'], $tplImg);
			$content .= $tplImg;
		}
	}
	/* 
	* If the connection with database fails, it "exit" here 
	* which stops all further processing and display only error message.
	*/
	catch (Exception $e) {
		exit(getErorrPage($e->getMessage(),$header, $FooterFinal, $lang['title-error']));
	}
?>