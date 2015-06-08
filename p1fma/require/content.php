<?php
	if(isset($_SESSION['name'])){
		echo $_SESSION['name'].' your favourite number is: '.$_SESSION['number'];
	}
else{
		echo'<p>You need to be log in to see the content of the page.</p>
			<p>Please log in!</p>';
	}
?>