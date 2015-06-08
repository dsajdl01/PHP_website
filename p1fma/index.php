<?php
		/*/*
			php. file for index.php 
			created by David Sajdl
			for PHP TMA
			userName: dsajdl01
		*/
		$myTitle = 'FMA index_page 1';
		include 'includes/header.php';
		require_once 'require/functions.php';
?>
    <body>
		<?php
			require_once 'require/logIn.php';
		?>
		<ul>
			<li>Page 1</li>
			<li><a href="page.php<?php echo htmlspecialchars(SID); ?>">Page 2</a></li>
			<li><a href="page1.php<?php echo htmlspecialchars(SID); ?>">Page 3</a></li>
		</ul>
        <p>This is index page 1</p>
		<?php
			echo $TEST;
			include 'includes/footer.php';
		?>
    </body>
</html>