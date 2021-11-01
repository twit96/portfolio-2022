<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Tyler Wittig | Web Developer</title>
		<meta charset="utf-8" />
		<meta name="description" content="Full-Stack Web Developer in South Texas, specializing in custom websites, website redesigns, and game development." />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="/img/icon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/css/home.css" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
		<script src="/js/main.js" defer></script>
		<script src="/js/home.js" defer></script>
	</head>

	<body>
		<?php
			DEFINE("FILENAME", 'home');
			include('../../includes/header.php');
		?>

		<section id="home">
			<div class="wrapper">

				<article id="intro">
					<div id="logo-container">
						<div id="main-logo-wrap">
							<img id="main-logo" src="/img/icon.png" alt="site logo" />
							<span class="main-logo-overlay"></span>
						</div>
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
				</article>

				<article id="skills">
					<h2>My Skills</h2>
					<div class="flex">
						<div>
							<h3>Languages and Frameworks</h3>
							<div class="skill-box">
								<div class="details">
									<b class="bubble-text">HTML</b>
									<span>3 years</span>
								</div>
								<div class="slide-container">
									<div class="slider">
										<span class="fill" style="--fill-percent: 85%;"></span>
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
										<span class="fill" style="--fill-percent: 95%;"></span>
									</div>
									<span class="bubble-text">+ jQuery</span>
									<span class="bubble-text">+ Phaser3</span>
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
							</div>  <!-- ./wrapper -->
						</div>

						<div>
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
						</div>
					</div>  <!-- ./flex -->
		    </article>

				<article id="featured">
					<div class="flex">
						<div class="heading-card">
				      <h2>Featured</h2>
				    </div>
				    <div class="card-container">

							<div class="card">
								<div class="featured-badge">
			            <span>#1</span>
			          </div>
								<img src="/img/projects/minesweeper/title-card.png" />
								<em>this is a blurb about it</em>
								<div class="info">
									<div class="btn-text date">
										<span class="icon"></span>
										<span>2020-12-07</span>
									</div>
									<a class="btn-text link" href="#">
										<span class="icon"></span>
										View Website
									</a>
								</div>
							</div>
							<div class="card">
								<div class="featured-badge">
			            <span>#2</span>
			          </div>
								<img src="/img/projects/bulko-redesign/title-card.png" />
								<em>this is a blurb about it</em>
								<div class="info">
									<div class="btn-text date">
										<span class="icon"></span>
										<span>2020-12-07</span>
									</div>
									<a class="btn-text link" href="#">
										<span class="icon"></span>
										View Website
									</a>
								</div>
							</div>
							<div class="card">
								<div class="featured-badge">
			            <span>#3</span>
			          </div>
								<img src="/img/projects/wittiggrass/title-card.png" />
								<em>this is a blurb about it</em>
								<div class="info">
									<div class="btn-text date">
										<span class="icon"></span>
										<span>2020-12-07</span>
									</div>
									<a class="btn-text link" href="#">
										<span class="icon"></span>
										View Website
									</a>
								</div>
							</div>
							<div class="card">
								<div class="featured-badge">
			            <span>#4</span>
			          </div>
								<img src="/img/projects/indie-quest/title-card.png" />
								<em>this is a blurb about it</em>
								<div class="info">
									<div class="btn-text date">
										<span class="icon"></span>
										<span>2020-12-07</span>
									</div>
									<a class="btn-text link" href="#">
										<span class="icon"></span>
										View Website
									</a>
								</div>
							</div>
							<div class="card">
								<div class="featured-badge">
			            <span>#5</span>
			          </div>
								<img src="/img/projects/connect-four/title-card.png" />
								<em>this is a blurb about it</em>
								<div class="info">
									<div class="btn-text date">
										<span class="icon"></span>
										<span>2020-12-07</span>
									</div>
									<a class="btn-text link" href="#">
										<span class="icon"></span>
										View Website
									</a>
								</div>
							</div>

							<a class="card link" href="/img/projects/">
				        <span>View All <br />Projects</span>
				      </a>
						</div>  <!-- ./card-container -->
					</div>  <!-- ./flex -->
					<p>
						To view all of my work, please visit my
						<a href="/img/projects/">projects page</a>.
					</p>
				</article>

				<article id="demo">
					<div class="flex">
						<div class="blurb">
							<h2>Your New Website</h2>
							<p>
								Whether a static website or one with an integrated database,
								I build websites from the ground up to meet your needs.
							</p>
						</div>
						<figure class="with-css with-js with-php with-sql with-host">
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
					</div>  <!-- ./flex -->
					<div id="demo-controls">
						<div class="btn-text play">
							<span class="icon"></span>
							<span class="text">Play</span>
						</div>
						<div class="btn-text stop disabled">
							<span class="icon"></span>
							<span class="text">Stop</span>
						</div>
					</div>  <!-- #/demo-controls -->
				</article>

			</div>  <!-- ./wrapper -->
		</section>  <!-- #/home -->

		<?php
			include('../../includes/footer.php');
		?>
	</body>
</html>
