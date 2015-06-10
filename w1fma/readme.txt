+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+ Gallery - APPLICATION DESIGN: Templates, PHP, CSS and i18n      +
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

readme.txt file for Gallery 
FMA assignment using MySQL and PHP

created by David Sajdl
userName: dsajdl01
date: 08/04/2015
Application home page: http://titan.dcs.bbk.ac.uk/~dsajdl01/w1fma/index.php

Description to Retrieve JSON Data
-----------------------------------
To retrieve JSON information of the large image go to the thumbnail or main Gallery and copy title of the image. 
Once you are coped image title paste is at the end of the URL provided below:
http://titan.dcs.bbk.ac.uk/~dsajdl01/w1fma/data.php?type=( here paste the image title )
then you retrieve JSON data of the particular image that contain: title, description, image file-name, width and height. 

To retrieve all images information in JSON copy and paste URL provided below:
http://titan.dcs.bbk.ac.uk/~dsajdl01/w1fma/data.php?type=all

+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

To retrieve the JSON object and transform it in PHP array and print it out you can use the following PHP code:

$my_curl = curl_init(); 
		$url = 'http://titan.dcs.bbk.ac.uk/~dsajdl01/w1fma/data.php?type=all'; // the word 'all' at the end of the URL can be replace with any image title 
		curl_setopt($my_curl, CURLOPT_URL, $url);
		curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($my_curl); 
			if ($result != false) { 
				$i = 0;
				$obj = json_decode($result, true);
				while($i < count($obj)){
					echo '<p>'. htmlentities('Title: '). htmlentities($obj[$i]['img_title']) 
						.htmlentities(' Description: ') . htmlentities($obj[$i]['img_description'])
						.htmlentities(' Image file-name: ') .htmlentities($obj[$i]['img_name'])
						.htmlentities(' Height: '). htmlentities($obj[$i]['img_height'])
						.htmlentities(' Width: '). htmlentities($obj[$i]['img_width']). '</p>';
				$i = $i + 1;
				}
			} 
			else { 
				echo curl_error($my_curl);
				echo curl_errno($my_curl);
			}
		curl_close($my_curl);


Description of the Gallery Application 
---------------------------------------
This package contains the files necessary to run Gallery application.

Gallery is PHP website which is connected to the database. The website 
communicate with one table 'thumbnails' from database.

Gallery website provides three view (web-pages)  

	•	Gallery or home page view displays all uploaded images in the Gallery.
	•	Upload view displays uploading form with the instruction how to upload images. 
	•	Image view displays particular image in the enlarged scale with the maximum width or height 600px.
			To Access large image it needs to be click on the particular image.

Installation
------------
Before deploying this application in your server, you should ensure that config.php file 
inside includes folder contains correct database user name, database name 
and database password. However it is strongly recommended that the values
inside the config file will NOT be changed as values are already set.

To make run the Gallery application in your server you must copy
the whole file called w1fma into your web server. Then into URL address
you need to type your_server_name/w1fma/index.php and home page should appear.

Before deploying this application in your server, you do not need to create a database table
A table called thumbnails will be created once you deploy the application
The things what must be done is that in the config file needs to be changed $config arrays values with your database values.

There may be some issues with your server security. 
To be sure please give the permission 777 to the thumbs and thumbs_small folders once you install on your server.

You can also void w1fma folder and copy into web server all sub-folders 
and all files inside w1fma folder. Then into URL address you need to type 
your_server_name/index.php. If you do this way, please make sure that you copy 
all 8 folders and 3 files. Folders name are: css, includes, instruction_fma, lang, 
templates, thumbs, thumbs_small and views and files name are: index.php, data.php and readme.txt.

Configuration
-------------
All configuration settings for this application can be found in: includes/config.inc.php
However it is strongly recommended that the values inside the includes/config.php file 
will NOT be changed as it may not work.

Notes
-----
The code was written by David Sajdl and the resources are mainly taken from the presentation lectures
and from the following two URL addresses; http://stackoverflow.com/questions/871858/php-pass-variable-to-next-page
and http://www.w3schools.com/php/func_filesystem_unlink.asp

Declaration:
------------ 
This Gallery system  is submitted under University of London regulations as part of the 
FMA requirements for MySQL and PHP course. 
I declare that all the work in Gallery is my own work.
