<?php
/*
*   thumblails.php file for gallery page or home, 
* 	FMA assignment using MySQL and PHP.
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 08/04/2015
*/

	/*
	* replacing place holders with values in header template and assign header string into $content.
	*/
	$header = str_replace('[+title+]',htmlentities($lang['title-thumbnail']), $header);
	$header = str_replace('[+body_name+]', htmlentities('thumbnailsPage'),$header);
	$content .= $header;
	

	/*
	* load loadTemplate.html into variable and assign place holders with values.
	*/
	$tplLoad = getTemplate('templates/mainGalleryTemplate.html');
	$tplLoad = str_replace('[+pageInstruction+]',htmlentities($lang['pageInstruction']),$tplLoad);
	$tplLoad = str_replace('[+title_load+]',htmlentities($lang['title_load']),$tplLoad);
	$tplLoad = str_replace('[+loadPage+]',htmlentities($lang['loadPage']),$tplLoad);
	
	
	try{
		// load SQL query data from database into variable
		$sql = 'SELECT img_id, img_title, img_width_sm, img_height_sm
				FROM thumbnails';
		$result = mysqli_query($link, $sql);
		// checking if SQL query does not contain error
		if (isQueryAlright($result, $link) === true) {
			// checking if SQL query return any value
			if (mysqli_num_rows($result) == 0){
				// if not print out error massage.
				$tplLoad = str_replace('[+photoContent+]',htmlentities($lang['zeroResult']),$tplLoad);
				$content .= $tplLoad;
			}
			else{ 
			// if SQL query returns any values then 
				// load galleryImageTemplate.html and replace place holders with values 
				$gallery = "";
				while ($row = mysqli_fetch_assoc($result)){
						$image = $row['img_title'];
						$tplGallery = getTemplate('templates/galleryImageTemplate.html');
						$tplGallery = str_replace('[+imageId+]',$row['img_id'], $tplGallery);
						$tplGallery = str_replace('[+imagePath+]','thumbs_small/'.$image, $tplGallery);
						$tplGallery = str_replace('[+imgWidth+]',$row['img_width_sm'], $tplGallery);
						$tplGallery = str_replace('[+imgHeight+]',$row['img_height_sm'], $tplGallery);
						$tplGallery = str_replace('[+imageName+]',$image, $tplGallery);
						$gallery .= str_replace('[+imgTitle+]',$image, $tplGallery);
				}
				// replace place holder with galleryImageTemplate.html template and it into $content variable. 
				$tplLoad = str_replace('[+photoContent+]',$gallery,$tplLoad);
				$content .=  $tplLoad;
			}
		}
	}
	// if any exception is thrown catch error here and assign error into $content variable.	
	catch (Exception $e) {
		$tplError = str_replace('[+error_message+]',$e->getMessage(), $tplError);
		$content .= $tplError;
	}
?>