<?php
/*
* config.php file, which is configuration settings for gallery, 
* FMA assignment using MySQL and PHP
*
*	created by David Sajdl
*	userName: dsajdl01
* 	date 08/04/2015
*/

 
	/**
	 * Database connection authorization.
	 *
	 * ATTENCION!
	 * PLEASE DO NOT CHANGE VALUES OF THE ARRYS $config
	 * AS THE APPLICATION MAY NOT WORK ! 
	 * /
 	
 	/*
	 * (if you decide to connect gallery.php system to your database
	 * then change database or $config arrays values with your database values.) 
	 */
 	$config['db_host'] = 'xxxxxxxx-xxx-xx';
	$config['db_name'] = '***-***';
	$config['db_user'] = 'dsajdl01';
	$config['db_pass'] = 'mysql';

	/**
	* to config values defined in array above as arguments to connect database with Gallery system.
	*/
	@$link = mysqli_connect(
			$config['db_host'], 
			$config['db_user'], 
			$config['db_pass'], 
			$config['db_name']);
			
	/**
	 * Directory connection authorization.
	 *
	 * ATTENCION!
	 * PLEASE DO NOT CHANGE VALUES OF THE ARRYS $config
	 * AS THE APPLICATION MAY NOT WORK !
	 * /
	 
	 /*
	 * (if you change or rename directory for saving the images 
	 * then the changing are require here.) 
	 */	
	 
	// Getting the absolute path to the application root directory
	$config['app_dir'] = dirname(dirname(__FILE__));
	// An absolute path is assigned to thumbs and thumbs_small directories
	// This reduces potential for error when saving files.
	$config['thumbs_dir'] = $config['app_dir'].'/thumbs/';
	$config['thumbs_small_dir'] = $config['app_dir'].'/thumbs_small/';
?>