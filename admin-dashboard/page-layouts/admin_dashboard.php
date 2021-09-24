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
			include('../../templates/header.html');
		?>

		<section id="entries">
			<form method="POST" action="index.php">
		    <h2>Login</h2>
		   	<table>
		      <tr>
		     		<td>Username:</td>
		     		<td><input name="username" type="text" size="30" placeholder="username" required /></td>
		    	</tr>
		    	<tr>
		        	<td>Password:</td>
		        	<td><input name="password" type="password" size="30" required /></td>
		    	</tr>
		   	</table>
			<p>
		    <input name="login" type="submit" value="Submit" />
		    <input type="reset" value="Reset" />
		  </p>
			</form>
	    <h2>Database Entries</h2>
			<table>
				<thead>
					<tr>
						<th>Title</th>
						<th>Directory</th>
						<th>Blurb</th>
						<th>Description</th>
						<th>Date</th>
						<th>Primary Link</th>
						<th>Primary Link Text</th>
						<th>Secondary Link</th>
						<th>Secondary Link Text</th>
						<th>Tertiary Link</th>
						<th>Tertiary Link Text</th>
						<th>Featured</th>
						<th>Update?</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Goldschen-Ohm Lab</td>
						<td>goldschen-ohm-lab</td>
						<td>Mobile-Responsive Webpage Update</td>
						<td>Updating the HTML to use semantic HTML5 tags, as well as implementing a mobile-first responsive design with vanilla CSS, add mobile-responsiveness and increase the readability of the code base of a researcher's lab webpage.</td>
						<td>2021-08-05</td>
						<td>https://marcel-goldschen-ohm.github.io/</td>
						<td>View Website</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>0</td>
						<td></td>
					</tr>
					<tr>
						<td>Minesweeper</td>
						<td>minesweeper</td>
						<td>JavaScript Minesweeper Game</td>
						<td>A mobile-responsive, no-frameworks version of the classic game of minesweeper.</td>
						<td>2021-06-09</td>
						<td>https://twit96.github.io/minesweeper/</td>
						<td>Play Now</td>
						<td>https://github.com/twit96/minesweeper/</td>
						<td>View GitHub</td>
						<td></td>
						<td></td>
						<td>3</td>
						<td></td>
					</tr>
					<tr>
						<td>Wittig Grass Sales</td>
						<td>wittiggrass</td>
						<td>Business Website Redesign</td>
						<td>This website redesign gives a new face to a business website. Background image slideshows, custom informational card layouts, an optimized and filterable image gallery page, and numerous other tricks yield a clean and mobile-responsive design with pure CSS (no frameworks).</td>
						<td>2021-05-10</td>
						<td>https://twit96.github.io/wittiggrass/</td>
						<td>View Website</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>4</td>
						<td></td>
					</tr>
					<tr>
						<td>Memory Game</td>
						<td>memory-game</td>
						<td>JavaScript Memory Game</td>
						<td>A mobile-responsive memory game, brought to life with audio and various animations. Made possible with vanilla CSS, jQuery, and confetti.js.</td>
						<td>2021-01-31</td>
						<td>https://twit96.github.io/memory-game/</td>
						<td>Play Now</td>
						<td>https://github.com/twit96/memory-game</td>
						<td>View GitHub</td>
						<td></td>
						<td></td>
						<td>0</td>
						<td></td>
					</tr>
					<tr>
						<td>Connect Four</td>
						<td>connect-four</td>
						<td>JavaScript Connect Four Game</td>
						<td>A mobile-responsive version of the classic game, made possible with vanilla CSS and JavaScript (no frameworks).</td>
						<td>2021-01-13</td>
						<td>https://twit96.github.io/connect-four/</td>
						<td>Play Now</td>
						<td>https://github.com/twit96/connect-four</td>
						<td>View GitHub</td>
						<td></td>
						<td></td>
						<td>5</td>
						<td></td>
					</tr>
					<tr>
						<td>Dr. Bulko's Responsive Redesign</td>
						<td>bulko-redesign</td>
						<td>Mobile-Friendly Website Redesign</td>
						<td>A responsive header, fluid two-column page layout, and scroll to top button fueled by vanilla CSS and JavaScript, alongside reflowable calendar and table designs, add mobile-responsiveness to an educator's existing website design.</td>
						<td>2021-01-09</td>
						<td>https://www.cs.utexas.edu/~bulko/</td>
						<td>View Website</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>2</td>
						<td></td>
					</tr>
					<tr>
						<td>Simple Gradient Website</td>
						<td>simple-gradient-website</td>
						<td>Static Website Mockup</td>
						<td>This single-page static website mockup is themed around a colorful gradient and utilizes a sticky sidebar that reflows for mobile.</td>
						<td>2021-01-02</td>
						<td>https://twit96.github.io/simple-gradient-website/</td>
						<td>View Project</td>
						<td>https://github.com/twit96/simple-gradient-website</td>
						<td>View GitHub</td>
						<td></td>
						<td></td>
						<td>0</td>
						<td></td>
					</tr>
					<tr>
						<td>IndieQuest</td>
						<td>indie-quest</td>
						<td>Dynamic Website Project</td>
						<td>IndieQuest is a dynamic blog website that sends users on a quest to read all of its articles - powered by PHP, SQL, JavaScript, and CSS.</td>
						<td>2020-12-07</td>
						<td>https://tylerwittig.com/IndieQuest/</td>
						<td>View Website</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>1</td>
						<td></td>
					</tr>
					<tr>
						<td>Tic-Tac-Toe</td>
						<td>tic-tac-toe</td>
						<td>JavaScript Tic-Tac-Toe Game</td>
						<td>This simple take on the classic game is powered by JavaScript and jQuery, and given a clean, responsive design with vanilla CSS.</td>
						<td>2020-11-06</td>
						<td>https://twit96.github.io/tic-tac-toe/</td>
						<td>Play Now</td>
						<td>https://github.com/twit96/tic-tac-toe</td>
						<td>View GitHub</td>
						<td></td>
						<td></td>
						<td>0</td>
						<td></td>
					</tr>
					<tr>
						<td>First Portfolio Website</td>
						<td>first-portfolio</td>
						<td>Single-Page Static Portfolio Website</td>
						<td>Used as a playground for tinkering with HTML, CSS, and JavaScript, this website underwent numerous design changes and refactors in its time active as I learned more about web development.</td>
						<td>2020-08-01</td>
						<td>https://twit96.github.io/</td>
						<td>View Website</td>
						<td>https://github.com/twit96/twit96.github.io</td>
						<td>View GitHub</td>
						<td></td>
						<td></td>
						<td>0</td>
						<td></td>
					</tr>
					<tr>
						<td>Star Wars Survey Classification Analysis</td>
						<td>star-wars-survey</td>
						<td>Machine Learning Classification Analysis</td>
						<td>By utilizing a few machine learning classification techniques, determining whether or not someone is a Star Wars fan need only require their responses to a few survey questions.</td>
						<td>2020-04-20</td>
						<td>https://github.com/twit96/StarWarsSurvey-ClassificationAnalysis</td>
						<td>View Project</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>0</td>
						<td></td>
					</tr>
					<tr>
						<td>Pharaoh's Phury</td>
						<td>pharaohs-phury</td>
						<td>2D Platformer Web Game</td>
						<td>After thousands of years of slumber, your place of rest has been invaded. Reclaim your prized possessions, avoid traps and enemy attacks, and run the British Imperialists out of your pyramid, or become their next museum exhibit.</td>
						<td>2019-12-09</td>
						<td>https://twit96.github.io/PharaohsPhury_Phaser3/</td>
						<td>Play Now</td>
						<td>https://github.com/twit96/PharaohsPhury_Phaser3</td>
						<td>View GitHub</td>
						<td>https://youtu.be/IQX4wJzflHA</td>
						<td>Watch Trailer</td>
						<td>0</td>
						<td></td>
					</tr>
					<tr>
						<td>Tank Fighter</td>
						<td>tank-fighter</td>
						<td>Top-Down Shooter Web Minigame</td>
						<td>In a post-apocalyptic world, swarms of alien orbs have nearly overtaken planet Earth. Your men have fallen and you have nothing left to lose. As a lone tank, it is your duty to give the invaders a fight to the death that they won't soon forget. Good luck, comrade.</td>
						<td>2019-09-16</td>
						<td>https://twit96.github.io/TankFighter_Phaser3/</td>
						<td>Play Now</td>
						<td>https://github.com/twit96/TankFighter_Phaser3</td>
						<td>View GitHub</td>
						<td></td>
						<td></td>
						<td>0</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<form method="POST" action="index.php">
	      <input name="logout" type="submit" value="Logout" />
	    </form>
		</section>

    <!-- <h1>Add Project</h1>
    <form method="POST" action="add_project.php">
      <section>
        <label for="title">Title</label>
        <input id="title" name="project_title" type="text" size="30" placeholder="Project Title" required /></td>
      </section>
      <section>
        <label for="directory">Directory Name</label>
        <input id="directory" name="directory_name" type="text" size="30" placeholder="Project Directory Name" />
      </section>
      <section>
        <label for="image">Image</label>
        <input id="image" name="img_upload" type="file" />
      </section>
      <section>
        <label for="blurb">blurb</label>
        <input id="blurb" name="project_blurb" type="text" size="30" placeholder="Project Blurb (Max 255 Characters)" />
      </section>
      <section>
        <label for="description">Description</label>
        <textarea id="description" name="project_description" rows="4" cols="30" placeholder="Project Description (Max 500 Characters)"></textarea>
      </section>
      <section>
        <label for="date">Date</label>
        <input id="date" name="project_date" type="date" />
      </section>
      <section>
        <label for="featured">Feature Project?</label>
        <input id="featured" name="featured" type="checkbox" />
      </section>
      <section>
        <label for="primary_link">Primary Link</label>
        <input id="primary_link" name="p_link" type="text" size="30" placeholder="URL" />
        <br />
        <label for="primary_link_text">Primary Link Text</label>
        <input id="primary_link_text" name="p_text" type="text" size="30" placeholder="Text" />
      </section>
      <section>
        <label for="secondary_link">Secondary Link</label>
        <input id="secondary_link" name="s_link" type="text" size="30" placeholder="URL" />
        <br />
        <label for="secondary_link_text">Secondary Link Text</label>
        <input id="secondary_link_text" name="s_text" type="text" size="30" placeholder="Text" />
      </section>
      <section>
        <label for="tertiary_link">Tertiary Link</label>
        <input id="tertiary_link" name="s_link" type="text" size="30" placeholder="URL" />
        <br />
        <label for="tertiary_link_text">Tertiary Link Text</label>
        <input id="tertiary_link_text" name="s_text" type="text" size="30" placeholder="Text" />
      </section>
      <section>
        <input type="submit" value="Add Project" name="submit">
        <input type="reset" value="Reset" />
      </section>
    </form> -->
		<?php
			include('../../templates/footer.html');
		?>
  </body>
</html>
