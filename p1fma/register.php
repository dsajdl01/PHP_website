<?php
	session_start();
	/*
		php. file for register.php 
		created by David Sajdl
		for PHP FMA
		userName: dsajdl01
	*/
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
		<head>
			<title>Web Programming using PHP: Registration Form </title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<style type="text/css">
				#footer,#reg{font-size: 10px;}
				
			</style>
			
		</head>
		<body>';
			require_once 'require/functions.php';
					// declering state variables
					$output = "";
					$formIsSubmitted = false;
					$errorDetected = false;
					$fullName = "";
					//declering Arrays to gather data
					$clear = array();
					$errors = array();
					$errors['fname'] ="";
					
					
					// If validate form is submitted
				if(isset($_POST['SUBmit'])) {
						$formIsSubmitted = true;
						
						// First name is a required field
						if(empty($_POST['fname'])){
							$errorDetected = true;
							$errors['fmane'] = 'First name has not been entered';
						}
						else{
							if (ctype_alpha($_POST['fname'])) {
									$clean['fname'] = $_POST['fname'];
									
							} else {
								$errorDetected = true;
								$errors['fname'] = 'First name must contain alphabetical letters only';
							}
						}
						
						// Last name is a required field
						if(empty($_POST['lname'])){
							$errorDetected = true;
							$errors['lmane'] = 'Last name has not been entered';
						}
						else{
							if (ctype_alpha($_POST['lname'])) {
									$clean['lname'] = $_POST['lname'];
									
							} else {
								$errorDetected = true;
								$errors['lname'] = 'Last name must contain alphabetical letters only';
							}
						}
						
						//User name is a required field
						if(empty($_POST['usrname'])){
							$errorDetected = true;
							$errors['usrname'] = 'User name has not been entered';
						}
						else{
							if (ctype_alnum($_POST['usrname'])) {
									$clean['usrname'] = $_POST['usrname'];
									
							} else {
								$errorDetected = true;
								$errors['usrname'] = 'User name must contain letters or digits only';
							}
						}
						
						//Email address is a required field
						if(empty($_POST['email'])){
							$errorDetected = true;
							$errors['email'] = 'Email address has not been entered'; 
						}
						else{
							$name = $_POST['email'];
							$trimmed = trim($name);
							if(filter_var($trimmed,FILTER_VALIDATE_EMAIL)) {
									$clean['email'] = $_POST['email'];
									
							} else {
								$errorDetected = true;
								$errors['email'] = 'You have entered invalid email address'; 
							}
						}
						
						// Password is a required field
						if(empty($_POST['password'])){
							$errorDetected = true;
							$errors['password'] = 'Password has not been entered';
						}
						else{
							if (ctype_alnum($_POST['password'])) {
									$clean['password'] = $_POST['password'];
									
							} else {
								$errorDetected = true;
								$errors['password'] = 'Password must contain letters or digits only';
							}
						}
					// continue testing other fields..
				}
				
					//Store input into data.txt file or display error messages
				if($formIsSubmitted === true && $errorDetected === false){
						//find and open folder or display error message that folder had not been found					
						$dir = '/home/dsajdl01/private';
						if(is_dir($dir)){
							$Handledir = opendir('/home/dsajdl01/private');
							while(false !==($file = readdir($Handledir))){
								$path = "/home/dsajdl01/private/".$file;
								
								// find and txt file and add data or print error message 
								if(is_file($path)){
									$handle =  fopen($path, 'a');
									$text = $clean['fname'].' '.$clean['lname'].' '.$clean['usrname'].' '.$clean['email'].' '.$clean['password']. PHP_EOL;
									$result = fwrite($handle, $text);
									if($result === false){
										$formsErorrs = '<p>Oops! data not written</p>';
									}
									else{
										$formsErorrs = '<p>Thank you for register with us. Yours details has been saved </p>';
										$fullName = htmlentities($clean['fname']).' '.htmlentities($clean['lname']);
									}
									fclose($handle);
								}
								else{
									//if txt file has not been found
									$formsErorrs= '<p>Oops!!! file  has NOT been found >>>  '.$path.'</p>';
								}
							}
							closedir($Handledir);
							$output= '<p>Registration form has been submitted</p><p>Welcome '.$fullName.'</p>';
							$_SESSION['name'] = $fullName;
						}
						else{
							// if file has not been found
							$formsErorrs = '<p>Oops, the file has NOT been found!!!</p>';
						}
						
				}
				else{
						$self = htmlentities($_SERVER['PHP_SELF']);	
						$formsErorrs = '';
						// disply error messages if any
						if($formIsSubmitted === true){
							
							foreach($errors as $r){
									$formsErorrs = $formsErorrs .'<p>'.$r.'</p>';					
								}	
						}

						// redisplay data in the form if any 
						if (isset($clean['fname'])) {
							$firstN = htmlentities($clean['fname']);
						} 
						else {
							$firstN = '';
						}
						if (isset($clean['lname'])) {
							$lastN = htmlentities($clean['lname']);
						} 
						else {
							$lastN = '';
						}
						if (isset($clean['usrname'])) {
							$usrN = htmlentities($clean['usrname']);
						} 
						else {
							$usrN = '';
						}
						if (isset($clean['email'])) {
							$emlAdd = htmlentities($clean['email']);
						} 
						else {
							$emlAdd = '';
						}
						
						// display the form, with valid data (if there is any)
						$output = '<form action="'.$self.'" method="post">
								<fieldset>
										<table>
												
												<tr>
													<td><label for="fn">First Name</label></td>
													<td>&#42; <input type="text" name="fname" id="fn" value="'.$firstN.'" /></td>
												</tr>
												<tr>
													<td><label for="ln">Last Name</label></td>
													<td>&#42; <input type="text" name="lname" id="ln" value="'.$lastN.'" /></td>
												</tr>
												<tr>
													<td><label for="usrn">User Name</label></td>
													<td>&#42; <input type="text" name="usrname" id="usrn" value="'.$usrN.'" /></td>
													<td>Only letters and digits allowed</td>
												</tr>
												<tr>
													<td><label for="eml">Email</label></td>
													<td>&#42; <input type="text" name="email" id="eml" value="'.$emlAdd.'" /></td>
												</tr>
												<tr>
													<td><label for="pw">Password</label></td>
													<td>&#42; <input type="password" name="password" id="pw" value="" /></td>
													<td>Only letters and digits are allowed </td>
												</tr>
												<tr>
													<td><input type="submit" name="SUBmit" value="SUBMIT DATA" /></td>
												</tr>
										</table>
								</fieldset>
						</form><p>&#32;</p>';
					}
			
			//display data
			echo make_heading('Registration Form',3);
			echo '<div id="breadcrumbs"> <a title="Back to home page" href="index.php?"> Back to home page</a></div>';
			echo $output;
			echo $formsErorrs;
			//if the form is submitted and there are not data errors then display menu
			if($formIsSubmitted === true && $errorDetected === false){
				include 'topMenu.php';
			}
			//display footer
			$UrlLink ='http%3A%2F%2Ftitan.dcs.bbk.ac.uk%2F~dsajdl01%2Fp1fma%2Fregister.php%3F';
			include 'includes/footer.php';
			?>
		</body>
</html>