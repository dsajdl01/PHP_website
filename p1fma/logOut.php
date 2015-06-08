<?php
	/**
			php. file for logOut.php 
			created by David Sajdl
			for PHP FMA
			userName: dsajdl01
		*/	
				//if logout is submitted destroy session
				if(isset($_POST['logOut'])) {
					session_destroy();
					header("Location: index.php");
					exit();
				}
						
		//declare variavle form and assign the form value
		$form ='<form action="" method="post">
			<div style="float:right;">            
				<input  type="submit" name="logOut" value="Log Out" />
			</div>
		</form>';
	// if session are active display data
	if(isset($_SESSION['name'])){
		echo $output;
		echo $form;
	}
	// if not display output: login form
	else{
		echo $output;
	}
?>