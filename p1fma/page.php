<?php
		/*/*
			php. file for index.php 
			created by David Sajdl
			for PHP TMA
			userName: dsajdl01
		*/
		$myTitle = 'FMA page 2';
		include 'includes/header.php';
		require_once 'require/functions.php';
?>
    <body>
		<ul>
			<li><a href="index.php<?php echo htmlspecialchars(SID); ?>">Page 1</a></li>
			<li>Page 2</li>
			<li><a href="page1.php<?php echo htmlspecialchars(SID); ?>">Page 3</a></li>
		</ul>
        <p>This is page 2</p>
		<?php
			include 'includes/footer.php';
		?>
    </body>
</html>