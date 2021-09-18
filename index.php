<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Tyler Wittig | Web Developer</title>
		<meta charset="utf-8" />
		<meta name="description" content="Full-Stack Web Developer in South Texas, specializing in custom websites, website redesigns, and game development." />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="/img/icon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css?v=20210915" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
		<script src="/js/main.js" defer></script>
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
				<a href="https://github.com/twit96" target="_blank" rel="noreferrer">
					<img src="/img/logo_github.png" alt="github logo" />
				</a>
				<a href="https://www.linkedin.com/in/tylerwittig/" target="_blank" rel="noreferrer">
					<img src="/img/logo_linkedin.png" alt="linkedin logo" />
				</a>
				<a href="https://twitter.com/tyler_wittig" target="_blank" rel="noreferrer">
					<img src="/img/logo_twitter.png" alt="twitter logo" />
				</a>
      </div>
			<span class="scroll-down-indicator"></span>
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
								<span class="fill" style="--fill-percent: 80%; --i: 1;"></span>
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
								<span class="fill" style="--fill-percent: 97%; --i: 2;"></span>
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
								<span class="fill" style="--fill-percent: 90%; --i: 3;"></span>
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
								<span class="fill" style="--fill-percent: 95%; --i: 4;"></span>
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
								<span class="fill" style="--fill-percent: 80%; --i: 5;"></span>
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
								<span class="fill" style="--fill-percent: 60%; --i: 6;"></span>
							</div>
							<span class="bubble-text">+ MySQL</span>
						</div>
					</div>
				</article>

				<article>
					<h3>Version Control and Runtimes</h3>
					<span class="bubble-text">Git</span>
					<span class="bubble-text">Linux</span>
					<span class="bubble-text">Apache</span>
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

		<section id="projects">

			<div class="heading-card">
				<h2>Projects</h2>
				<!-- <h2>Featured</h2> -->
			</div>

			<div class="card-container">
				<div class="card">
					<img src="/projects/goldschen-ohm-lab/title-card.png" alt="Goldschen-Ohm Title Card" />
					<em>Mobile-Responsive Webpage Update</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2021/08/05</span>
						</div>
						<a class="btn-text link" href="https://marcel-goldschen-ohm.github.io/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/minesweeper/title-card.png" alt="Minesweeper Title Card" />
					<em>Javascript Minesweeper Game</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2021/06/09</span>
						</div>
						<a class="btn-text link" href="https://twit96.github.io/minesweeper/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/wittiggrass/title-card.png" alt="Wittig Grass Title Card" />
					<em>Website Redesign</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2021/05/10</span>
						</div>
						<a class="btn-text link" href="https://twit96.github.io/wittiggrass/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/memory-game/title-card.png" alt="Memory Game Title Card" />
					<em>JavaScript Memory Game</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2021/01/31</span>
						</div>
						<a class="btn-text link" href="https://twit96.github.io/memory-game/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/connect-four/title-card.png" alt="Connect Four Title Card" />
					<em>JavaScript Connect Four Game</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2021/01/13</span>
						</div>
						<a class="btn-text link" href="https://twit96.github.io/connect-four/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/bulko-redesign/title-card.png" alt="Bulko Redesign Title Card" />
					<em>Mobile-Friendly Website Redesign</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2021/01/09</span>
						</div>
						<a class="btn-text link" href="https://www.cs.utexas.edu/~bulko/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<!-- <a class="card link" href="/projects/">
					<span>View All <br />Projects</span>
				</a> -->
				<div class="card">
					<img src="/projects/simple-gradient-website/title-card.png" alt="Simple Gradient Website Title Card" />
					<em>Static Website Mockup</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2021/01/02</span>
						</div>
						<a class="btn-text link" href="https://twit96.github.io/simple-gradient-website/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/indie-quest/title-card.png" alt="IndieQuest Title Card" />
					<em>Dynamic Website Project</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2020/12/07</span>
						</div>
						<a class="btn-text link" href="https://tylerwittig.com/IndieQuest/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/tic-tac-toe/title-card.png" alt="Tic-Tac-Toe Title Card" />
					<em>JavaScript Tic-Tac-Toe Game</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2020/11/06</span>
						</div>
						<a class="btn-text link" href="https://twit96.github.io/tic-tac-toe/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/star-wars-survey/title-card.png" alt="Star Wars Survey Title Card" />
					<em>Machine Learning Classification Analysis</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2020/04/20</span>
						</div>
						<a class="btn-text link" href="https://github.com/twit96/StarWarsSurvey-ClassificationAnalysis">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/pharaohs-phury/title-card.png" alt="Pharaoh's Phury Title Card" />
					<em>2D Platformer Web Game</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2019/12/09</span>
						</div>
						<a class="btn-text link" href="https://twit96.github.io/PharaohsPhury_Phaser3/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
				<div class="card">
					<img src="/projects/tank-fighter/title-card.png" alt="Tank Fighter Title Card" />
					<em>Top-Down Shooter Web Minigame</em>
					<div class="info">
						<div class="btn-text date">
							<span class="icon"></span>
							<span>2019/09/16</span>
						</div>
						<a class="btn-text link" href="https://twit96.github.io/TankFighter_Phaser3/">
							<span class="icon"></span>
							View Project
						</a>
					</div>
				</div>
			</div>

		</section>

		<section id="filler">
			<h2>New Portfolio Coming Soon!</h2>
			<p>
				If you would like to visit my current portfolio website while this one
				is under construction,
				follow this link:
			</p>
			<p>
				<a href="https://twit96.github.io/" target="_blank" rel="noreferrer">
					Current Portfolio Website
				</a>
			</p>
		</section>

		<footer>
			&copy; 2021 Tyler Wittig
		</footer>
	</body>
</html>
