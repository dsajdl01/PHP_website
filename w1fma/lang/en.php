<?php
/*
* en.php file for gallery,
* FMA assignment using MySQL and PHP
*
* It represents all written content in English language for all gallery web-pages .
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 08/04/2015
*/

	/**
	* describe main header text of all the pages.
	*/
	$lang['page_heading'] = "Gallery";
	/**
	* describe titles for all the pages.
	*/
	$lang['title-error'] = 'BBK FMA - Building Web Applications using MySQL and PHP: Photo Gallery error handling page';
	$lang['title-thumbnail'] = 'BBK FMA - Building Web Applications using MySQL and PHP: Photo Gallery Thumbnails page';
	$lang['title-loading'] = 'BBK FMA - Building Web Applications using MySQL and PHP: Photo Gallery Uploading page';
	$lang['title_image'] = 'BBK FMA - Building Web Applications using MySQL and PHP: Photo Gallery Image page of ';
	/**
	* describe names for navigation bars.
	*/
	$lang['title_load'] = 'Upload image page';
	$lang['goBackPage'] = 'Thumbnail';
	/**
	* describe titles for navigation bars.
	*/
	$lang['loadPage'] = 'Upload Image';
	$lang['title_back'] = 'Back to home page - Gallery';
	/*
	* text for Gallery page 
	*/
	$lang['pageInstruction'] = 'To see the picture enlarged, please click on the image.'; 
	$lang['zeroResult'] = 'Sorry but there are not any images in the gallery system. Please upload any images.';
	/**
	* describe main content for uploading image page.
	*/
	$lang['loadingText'] = 'Please click on the Browser button and select the image that you wish to load into the gallery. The image can be only .jpeg or .jpg file. Then enter title and summary of the image into text box below the Browser button and press upload file button. The maximum characters for the image title is limited to 20 characters and the maximum characters for description of the image is limited to 150 characters include spaces. After that the image with entered title and summary would loaded into the gallery system. Please insure that the title and summary is entered otherwise the image can NOT be loaded into gallery!';
	$lang['imageLoading'] = 'UPLOAD IMAGE';
	$lang['uploadFile'] = 'Upload File';
	/*
	* instruction of each type in uploading image form
	*/
	$lang['uploadFileTitle'] = 'Upload your image:';
	$lang['uploadTitle'] = 'Give title to your image:';
	$lang['uploadSummaryTitle'] = 'Give short brief to your image:';
	/*
	* possible errors message that may occur in uploading image form
	*/
	$lang['titleErrorMessage'] = 'Title of the image has not been entered.';
	$lang['summaryErrorMessage'] = 'Summary of the image has not been entered.';
	$lang['noJPEGFileMessage'] = 'Not a JPEG image. Please ensure that image is only .jpeg.';
	$lang['notWriteableFile'] = 'Sorry, either Thumbs or Thumbs_small files are not writeable. Please change the permission of those two files to writeable: 777.';
	$lang['fileDoNOTExist'] = 'Sorry, either Thumbs or Thumbs_small files do not exist. Please create files and change a permission to writeable 777';
	$lang['uploadedFailMessage'] = 'To upload image has failed.';
	
	$lang['noFileEnteredMessage'] = 'You have not entered image file. Please upload the file!';
	/**
	* describe success messages for uploading image page.
	*/
	$lang['uploadedFileMessage'] = 'The image is successfully uploaded and saved into the system.';
	
	/**
	* describe footer text.
	*/
	$lang['ftrText'] = 'Web Programming using SQL and PHP ';
?>