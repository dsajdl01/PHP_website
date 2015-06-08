<?php
	session_start();
	/*
		php. file for header.php 
		created by David Sajdl
		for PHP FMA
		userName: dsajdl01
	*/
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
			<title>Web Programming using PHP: ';
			echo $myTitle;
			echo '</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<style type="text/css">
				#footer,#reg{font-size: 10px;}
				
			</style>
			
		</head>
		<body>';
					// Declare State variables to gather data
					$output = "";
					$passwordFound = false;
					$fullName = "";
					$errorLogInMessage = "";
					$formIsSubmitted = false;
					$errorDetected = false;
					//Declare array to gather data
					$clear = array();
					$errors = array();
					$errors['userName'] ="";
					$errors["pass_word"] = "";
				
				// Validate form if it was sabmotted	
				if(isset($_POST['submitForm'])) {
						$formIsSubmitted = true;
						
						// User Name is a required field
						if(empty($_POST['userName'])){
							$errorDetected = true;
							$errors['userName'] = 'User name has not been entered';
						}
						else{
							if (ctype_alnum($_POST['userName'])){
									$clean['userName'] = $_POST['userName'];
									
							} else {
								$errorDetected = true;
								$errors['userName'] = 'User name can contain only characters and digits.';
							}
						}
						
						// password is a required field
						if(empty($_POST['pass_word'])){
							$errorDetected = true;
							$errors['pass_word'] = 'Password has not been entered';
						}
						else{
							if (ctype_alnum($_POST['pass_word'])) {
									$clean['pass_word'] = $_POST['pass_word'];
									
							} else {
								$errorDetected = true;
								$errors['pass_word'] = 'Incorrect password';
							}
						}
						
						
					// continue testing other fields..
				}
				
				
				// Decide if to process data of display errors
				if($formIsSubmitted === true && $errorDetected === false){			
						$dir = '/home/dsajdl01/private';
						// find folder or display error message
						if(is_dir($dir)){
							$Handledir = opendir('/home/dsajdl01/private');
								$path = "/home/dsajdl01/private/data.txt";
								//find file date.txt or display error message
								if(is_file($path)){
									$handle =  fopen($path, 'r');
									// loop through the file to check data
									while(!feof($handle)){
										$fileLine = fgets($handle);
										if(!empty($fileLine)){
											$bits = explode(' ',$fileLine);
											$cleanPassW = trim($clean['pass_word']);
											$cleanUsrN = trim($clean['userName']);
											$cleanDataUsrN = trim($bits[2]);
											$cleanDataPassw = trim($bits[4]);
											//if data match, store data or display message
											if(($cleanDataUsrN == $cleanUsrN) && ($cleanDataPassw == $cleanPassW)){
												$passwordFound = true;
												$fullName = ($bits[0]). ' '.($bits[1]);
												//echo '<p>This is full name '.$fullName.'</p>';
											}
											else{
													$errorLogInMessage = 'Your user name or password is incorrect';
											}
											
										}
									}
									fclose($handle);
								}
								else{
									echo '<p>Oops!!! TRYing file  has NOT been found >>>  '.$path.'</p>';
								}
							//}
							closedir($Handledir);
						}
						else{
							echo '<p>Oops, the file has NOT been found!!!</p>';
						}
						
						
				}
				
				// if data match store full name into and display message or display form with error message
				if($passwordFound === true){
						$htmlClear = htmlentities($fullName);
						echo '<p>Welcome '.$htmlClear.'</p>';
						$_SESSION['name'] = $htmlClear;
						
				}
				// if session found is true store it 
				else if(isset($_SESSION['name'])){
						$output = '<p>Welcome '.$_SESSION['name'].'</p>';
				}
				// display error messages and form
				else{
						$self = htmlentities($_SERVER['PHP_SELF']);	
						$pass_Word = '';
					
						if (isset($clean['userName'])) {
							$theUserName = htmlentities($clean['userName']);
						} 
						else {
							$theUserName = '';
						}
						// initialize variable to assign login form
						$output = 
						'<form action="'.$self.'" method="post">
							<fieldset>
								<legend>Sign Up</legend>
								<div>
									<label for="us">User Name</label>
									<input value="'.$theUserName.'" type="text" name="userName" id="us"  />
								
									<label for="password">Password:</label>
										<input value="'.$pass_Word.'" type="password" name="pass_word" id="password"  />
											
									<input  type="submit" name="submitForm" value="Sign In" /> '.$errorLogInMessage.'
									 <br />'.$errors["userName"].' &#160; &#160; '.$errors["pass_word"].'
									 <div id="reg"><a title="Get Registration Form" href="register.php?">REGISTER</a></div>
								</div>
							</fieldset>
						</form>';
						
					}
	
?>