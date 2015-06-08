<?php
if(isset($_SESSION['name'])){
	echo $_SESSION['name'];
}
else{
	echo $outputForm;
}
