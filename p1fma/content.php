<?php
	/**
			php. file for logOut.php 
			created by David Sajdl
			for PHP FMA
			userName: dsajdl01
		*/
				// if session true then display text
			if(isset($_SESSION['name'])){
				echo make_heading('This is a secret page and can be seen only if you log in.',3);
				echo '<p>This is page 3 of the PHP for fma. It has been created by David Sajdl during Christmas time in 2013. This is page 3 of the PHP for fma. It has been created by David Sajdl during Christmas time in 2013. This is page 3 of the PHP for fma. It has been created by David Sajdl during Christmas time in 2013.  This is page 3 of the PHP for fma. It has been created by David Sajdl during Christmas time in 2013. This is page 3 of the PHP for fma. It has been created by David Sajdl during Christmas time in 2013.</p>';
			}
			// if session false display following text
			else{
				echo'<p>You need to be log in to see the content of the page.</p> 
				<p>Please log in!</p>';
			}
?>