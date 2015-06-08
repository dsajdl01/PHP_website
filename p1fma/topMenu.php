<?php
/**
			php. file for topMenu.php 
			created by David Sajdl
			for PHP FMA
			userName: dsajdl01
		*/
	echo '<ul>
		<li><a title="Home page - index" href="index.php"> <?php htmlspecialchars(SID); ?>Page 1</a></li>
		<li><a title="Page 2" href="page.php"> <?php htmlspecialchars(SID); ?>Page 2</a></li>
		<li><a title="Page 3" href="page1.php"> <?php htmlspecialchars(SID); ?>Page 3</a></li>
	</ul>';
?>