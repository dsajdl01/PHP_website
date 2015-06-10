+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+ W1 Music - APPLICATION DESIGN: Templates, PHP, CSS and i18n     +
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

readme.txt file for W1 Music 
TMA assignment using MySQL and PHP

created by David Sajdl
userName: dsajdl01
date 14/02/2015

Description
-----------
This package contains the files necessary to run M1 Music application.

M1 Music is PHP website which is connected to the database. The website 
communicate with two tables 'artist and song' from database.

M1 Music website provides three view (web-pages)  and on each view is a 
summary of a number of artist that are available in M1 music
and a number of songs that are available in M1 music.

	•	On Home view displays a welcome message with summary.
	•	On Artists view displays summary with an artist name and number of songs that particular artist has. 
	•	On Songs view displays summary with a table with all available songs 
		(title of song) that are in M1 Music with song's artist name and song's duration.


			  
Installation
------------
Before deploying this application, you should ensure that config.php file 
inside includes folder contains correct database user name, database name 
and database password. However it is strongly recommended that the values
inside the config file will NOT be changed as values are already set.

To make run the w1tma application in your server you must copy
the whole file called w1tma into your web server. Then into URL address
you need to type your_server_name/w1tma/index.php and home page should appear.

You can also void w1tma folder and copy into web server all sub-folders 
and all files inside w1tma folder. Then into URL address you need to type 
your_server_name/index.php. If you do this way, please make sure that you copy 
all 6 folders and 2 files. Folders name are: image, includes, instruction_tma, lang, 
templates and view and files name are: index.php and readme.txt.

W1 Music website is available online on the Birkbeck web server on the 
following URL address: http://titan.dcs.bbk.ac.uk/~dsajdl01/w1tma/index.php

Configuration
-------------
All configuration settings for this application can be found in: includes/config.inc.php
However it is strongly recommended that the values inside the includes/config.php file 
will NOT be changed as it may not work.

Notes
-----
The code was written by David Sajdl and the resources are mainly taken from the presentation lectures
and from the following URL address http://php.net/manual/en/function.strftime.php

Declaration:
------------ 
This W1 Music system  is submitted under University of London regulations as part of the 
TMA requirements for MySQL and PHP course. 
I declare that all the work in W1 Music is my own work.