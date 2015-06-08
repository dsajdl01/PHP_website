<?php
	/*
		php. file for index.php 
		created by David Sajdl
		for PHP FMA
		userName: dsajdl01
	*/
	session_start();
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
	$form_is_submitted = false;
	$error_detected = false;
	$clear = array();
	$errors = array();
	$TEST = "F";
	
	if(isset($_POST['$submitLogIn'])){
		$TEST = "TEST";
		$form_is_submitted = true;
		if(empty($_POST['userName'])){
			$error_detected = true;
			$errors['userName'] = 'User name has not been entered.';
		}
		if(ctype_digit($_POST['userName']) || ctype_alpha($_POST['userName'])){
			$clear['userName'] = $_POST['userName'];
		}
		else{
			$error_detected = true;
			$errors['userName'] = 'User name can contain only characters and digits.';
		}
		
		if(empty($_POST['password'])){
			$error_detected = true;
			$errors['password'] = 'Password has not been entered';
		}
		else{
			if(ctype_digit($_POST['password']) || ctype_alpha($_POST['password'])){
				$clear['password'] = $_POST['password'];
			}
			else{
				$error_detected = true;
				$errors['password'] = 'Password can contain only characters and digits';
			}
		}
	}
		
	
	if($form_is_submitted === true && $error_detected === false){
		echo '<p>Hi David</p>';
	}
	else{
		if(isset($clear['userName'])){
			$html_userName = htmlentities($clear['userName']);
		}
		else{
			$html_userName = "";
		}
		if(isset($errors['userName'])){
			$userNameMess = $errors['userName'];
		}
		else{
			$userNameMess = "";
		}
		if(isset($errors['password'])){
			$erroMessage = $errors['password'];
		}
		else{
			$erroMessage = "";
		}
		$html_password = "";
		$self = htmlentities($_SERVER['PHP_SELF']);
		$outputForm = '<form action=""' . $self . '"method="post">
				<fieldset>
				<label for="us">User Name:</label>
				<input type="text" name="userName" id="us" style="width:170px" value="'. $html_userName.'"/>
				<label for="ps">Password:</label> 
				<input type="password" name="password" id="ps" value="'. $html_password.'"/>
				<input type="submit" id="submitLogIn" name="btnLogIn" value="logIn" />
				'.$userNameMess. ' ' . $erroMessage.'
				<div id="reg">REGISTER</div>
				</fieldset>
			</form>';
		
	}
?>