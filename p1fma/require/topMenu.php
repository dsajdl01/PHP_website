<?php
	echo '<ul>
		<li><a href="index.php<?php echo htmlspecialchars(SID); ?>">Page 1</a></li>
		<li><a href="page.php<?php echo htmlspecialchars(SID); ?>">Page 2</a></li>
		<li><a href="page1.php<?php echo htmlspecialchars(SID); ?>">Page 3</a></li>
	</ul>';
?>