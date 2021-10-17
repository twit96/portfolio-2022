<?php
include('../templates/head.php');
?>
		<!-- Additional Head Tags -->
		<meta name="description" content="Tyler Wittig's Portfolio Admin Dashboard" />
		<link rel="stylesheet" type="text/css" href="/css/admin.css" />
	</head>

  <body>
		<?php
			include('../templates/header.html');
			echo '<section id="entries">';
			include('../php/admin_dashboard.php');
			echo '</section>';
			include('../templates/footer.html');
		?>
  </body>
</html>
