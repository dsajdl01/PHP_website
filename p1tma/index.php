	<?php
		/*
			php. file for index.php 
			created by David Sajdl
			for PHP TMA
			userName: dsajdl01
		*/
		$myTitle = 'Summary of loging files for April and May 2007, TMA of PHP';
		include 'includes/header.php';
		require_once 'require/functions.php';
	?>
    <body>
		<?php
			
			echo make_heading('Summary of date in the log files',1);
			echo make_heading('Summary for April 2007',3);
			$aprilFile = "require/april.log";
			echo make_table($aprilFile);
			echo '<hr>';
			

			echo make_heading('Summary for May 2007',3);
			$mayFile = "require/may.log";
			echo make_table($mayFile);
			echo '<hr>';
			include 'includes/footer.php';
		?>
    </body>
</html>
