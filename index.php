<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Tyler Wittig | Web Developer</title>
		<meta charset="utf-8" />
		<meta name="description" content="Full-Stack Web Developer in South Texas, specializing in custom websites, website redesigns, and game development." />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Social Media Card -->
		<meta name="author" content="Tyler Wittig" />
		<meta property="og:title" content="Tyler Wittig | Web Developer" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="https://tylerwittig.com/" />
		<meta property="og:image" content="/img/site-card.png" />
		<meta property="og:description" content="Tyler Wittig's Portfolio Website" />
		<!-- make the og:image larger -->
		<meta name="twitter:card" content="summary_large_image">
		<!--  -->
		<link rel="icon" href="/img/icon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css?v=20211016" />
		<link rel="stylesheet" type="text/css" href="/css/home.css?v=20211013" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
		<script src="/js/main.js?v=20211012.02" defer></script>
		<script src="/js/home.js" defer></script>
	</head>

	<body>
		<?php
			include('./templates/header.html');
		?>

		<section id="intro">
			<div id="main-logo-wrap">
				<img id="main-logo" src="/img/icon.png" alt="site logo" />
				<span class="main-logo-overlay"></span>
			</div>
      <div class="blurb">
        <p>
          Well <i>hello</i> world,
          <br />
          My name is Tyler and I am a full-stack web developer.<br />
          I specialize in...
  			</p>
        <p>
          <span class="active tagline">Custom Websites</span>
          <span class="tagline">Website Redesigns</span>
          <span class="tagline">Game Development</span>
        </p>
      </div>
      <div class="details">
        <h1>Tyler Wittig</h1>
        <h2>Web Developer</h2>
				<div class="links">
					<a href="mailto:tylerwittig@utexas.edu?subject=Web%20Developer%20Information" target="_blank" rel="noreferrer">
						<img src="/img/logo_email.png" alt="twitter logo" />
					</a>
					<a href="https://github.com/twit96" target="_blank" rel="noreferrer">
						<img src="/img/logo_github.png" alt="github logo" />
					</a>
					<a href="https://www.linkedin.com/in/tylerwittig/" target="_blank" rel="noreferrer">
						<img src="/img/logo_linkedin.png" alt="linkedin logo" />
					</a>
				</div>  <!-- ./links -->
      </div>  <!-- ./details -->
		</section>


		<!-- Featured Projects Section -->
		<?php include('./php/featured_projects.php'); ?>


    <section id="skills">
			<h2>My Skills</h2>
			<div class="flex">
				<article>
					<h3>Languages and Frameworks</h3>
					<div class="skill-box">
						<div class="details">
							<b class="bubble-text">HTML</b>
							<span>3 years</span>
						</div>
						<div class="slide-container">
							<div class="slider">
								<span class="fill" style="--fill-percent: 80%;"></span>
							</div>
						</div>
					</div>
					<div class="skill-box">
						<div class="details">
							<b class="bubble-text">CSS</b>
							<span>3 years</span>
						</div>
						<div class="slide-container">
							<div class="slider">
								<span class="fill" style="--fill-percent: 97%;"></span>
							</div>
						</div>
					</div>
					<div class="skill-box">
						<div class="details">
							<b class="bubble-text">JavaScript</b>
							<span>3 years</span>
						</div>
						<div class="slide-container">
							<div class="slider">
								<span class="fill" style="--fill-percent: 90%;"></span>
							</div>
							<span class="bubble-text">+ jQuery</span>
							<span class="bubble-text">+ Phaser</span>
						</div>
					</div>
					<div class="skill-box">
						<div class="details">
							<b class="bubble-text">Python</b>
							<span>4 years</span>
						</div>
						<div class="slide-container">
							<div class="slider">
								<span class="fill" style="--fill-percent: 95%;"></span>
							</div>
							<span class="bubble-text">+ Pandas</span>
						</div>
					</div>
					<div class="skill-box">
						<div class="details">
							<b class="bubble-text">PHP</b>
							<span>1 year</span>
						</div>
						<div class="slide-container">
							<div class="slider">
								<span class="fill" style="--fill-percent: 80%;"></span>
							</div>
							<span class="bubble-text">+ MySQLi</span>
						</div>
					</div>
					<div class="skill-box">
						<div class="details">
							<b class="bubble-text">SQL</b>
							<span>1 year</span>
						</div>
						<div class="slide-container">
							<div class="slider">
								<span class="fill" style="--fill-percent: 60%;"></span>
							</div>
						</div>
					</div>
				</article>

				<article>
					<h3>Version Control and Runtimes</h3>
					<span class="bubble-text">Git</span>
					<span class="bubble-text">Linux</span>
					<span class="bubble-text">Apache</span>
					<span class="bubble-text">NGINX</span>
					<span class="bubble-text">Atom</span>
					<span class="bubble-text">Jupyter</span>
					<h3>Asset Development</h3>
					<span class="bubble-text">Tiled</span>
					<span class="bubble-text">Aseprite</span>
					<span class="bubble-text">FL Studio</span>
					<span class="bubble-text">Finale</span>
					<span class="bubble-text">Windows Video Editor</span>
					<span class="bubble-text">Paint 3D</span>
				</article>
			</div>
    </section>


		<section id="demo">
			<div class="wrapper">
				<div class="blurb">
					<h2>Your New Website</h2>
					<p>
						Whether a static website or one with an integrated database,
						I build websites from the ground up to meet your needs.
					</p>
				</div>
				<figure>
					<div class="website">
						<div class="monitor">
							<span class="title">Your Website</span>
						</div>
						<span class="text">HTML</span>
						<span class="text"> / CSS</span>
						<span class="text"> / JS</span>
					</div>
					<div class="pipeline">
						<span class="pipe"></span>
						<span class="pipe"></span>
						<span class="text">PHP</span>
					</div>
					<div class="database">
						<div>
							<span class="light"></span>
							<span class="light"></span>
							<span class="light"></span>
							<span class="title">Database</span>
						</div>
						<span class="text">SQL</span>
					</div>
					<span class="text">Host</span>
				</figure>
			</div>

			<div id="demo-controls">
				<div class="btn-text play">
					<span class="icon"></span>
					<span class="text">Play</span>
				</div>
				<div class="btn-text stop">
					<span class="icon"></span>
					<span class="text">Stop</span>
				</div>
			</div>
		</section>


		<?php
			include('./templates/footer.html');
		?>
	</body>
</html>
