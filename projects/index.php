<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tyler Wittig | Projects</title>
    <meta charset="utf-8" />
		<meta name="description" content="Tyler Wittig's Projects" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Social Media Card -->
		<meta name="title" property="og:title" content="Tyler Wittig | Web Developer" />
		<meta property="og:type" content="Website" />
		<meta name="image" property="og:image" content="/img/site-card.png" />
		<meta name="description" property="og:description" content="Tyler Wittig's Portfolio Website" />
		<meta name="author" content="Tyler Wittig" />
		<!--  -->
		<link rel="icon" href="/img/icon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css?v=20210922.04" />
    <link rel="stylesheet" type="text/css" href="/css/projects.css?v=20210922" />
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
