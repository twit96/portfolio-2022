<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tyler Wittig | Projects</title>
    <meta charset="utf-8" />
		<meta name="description" content="Tyler Wittig's Projects" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Social Media Card -->
		<meta name="author" content="Tyler Wittig" />
		<meta property="og:title" content="Tyler Wittig | Projects" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="https://tylerwittig.com/projects/" />
		<meta property="og:image" content="/img/site-card.png" />
		<meta property="og:description" content="Tyler Wittig's Portfolio Website - Projects" />
		<!-- make the og:image larger -->
		<meta name="twitter:card" content="summary_large_image">
		<!--  -->
		<link rel="icon" href="/img/icon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
    <link rel="stylesheet" type="text/css" href="/css/projects.css" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="/js/main.js" defer></script>
  </head>
  <body>
    <?php
			include('../templates/header.html');
		  include('../php/all_projects.php');
			include('../templates/footer.html');
		?>
  </body>
</html>
