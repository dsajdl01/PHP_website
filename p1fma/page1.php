<?php
		/*/*
			php. file for index.php 
			created by David Sajdl
			for PHP TMA
			userName: dsajdl01
		*/
		$myTitle = 'FMA page 3';
		include 'includes/header.php';
		require_once 'require/functions.php';
?>
		<ul>
			<li><a href="index.php<?php echo htmlspecialchars(SID); ?>">Page 1</a></li>
			<li><a href="page.php<?php echo htmlspecialchars(SID); ?>">Page 2</a></li>
			<li>Page 3</li>
		</ul>
        <p>This page 3</p>
		<?php
			require_once 'require/content.php'; 
			echo $TEST;
			include 'includes/footer.php';
		?>
    </body>
</html>