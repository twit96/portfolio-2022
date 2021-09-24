<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Tyler Wittig | Admin Dashboard</title>
		<meta charset="utf-8" />
		<meta name="description" content="Tyler Wittig's Portfolio Admin Dashboard" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="/img/icon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/css/admin.css" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
		<script src="/js/main.js" defer></script>
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
