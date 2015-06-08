	<?php
		/*/*
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
			$aprilFile = "require/april.log";
			echo make_heading('Summary of date in the log files',1);
			echo make_heading('Summary for April 2007',3);
			echo '<table border="1"><tr><td>';
			echo 'Total number of file requested </td><td >'. count_lines_in_file($aprilFile).'</td></tr>';
			echo '<tr><td>Number of the file requested by the articles </td><td >'; 
			echo count_articles_file($aprilFile).'</td></tr>';
			echo '<tr><td>Total bandwidth consumed by the file requests </td><td >'. get_bandwidth_in_bytes($aprilFile).'</td></tr>';
			echo '<tr><td>Total number of 404 errors requested </td><td >'. count_404_errors($aprilFile).'</td></tr>';
			echo '<tr><td> The list of the filenames that produced 404 errors</td><td>';
			$theList = get_404error_list($aprilFile);
			foreach($theList as $list){
				echo '<p>'.$list.'</p>';
			}
			echo '</td></tr></table>';
		?>
		<hr />
		<?php
			echo make_heading('Summary for May 2007',3);
			$mayFile = "require/may.log";
			echo '<table border="1"><tr><td>';
			echo 'Total number of file requested </td><td >'. count_lines_in_file($mayFile).'</td></tr>';
			echo '<tr><td>Number of the file requested by the articles </td><td >'; 
			echo count_articles_file($mayFile).'</td></tr>';
			echo '<tr><td>Total bandwidth consumed by the file requests </td><td >'. get_bandwidth_in_bytes($mayFile).'</td></tr>';
			echo '<tr><td>Total number of 404 errors requested </td><td >'. count_404_errors($mayFile).'</td></tr>';
			echo '<tr><td> The list of the filenames that produced 404 errors</td><td>';
			$theList = get_404error_list($mayFile);
			foreach($theList as $list){
				echo '<p>'.$list.'</p>';
			}
			echo '</td></tr></table>';
		?>
		<hr />
		<?php
			include 'includes/footer.php';
		?>
    </body>
</html>
