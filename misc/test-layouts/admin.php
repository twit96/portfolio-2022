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
		<meta name="robots" content="noindex">
	</head>

  <body>
		<?php
			DEFINE("FILENAME", 'admin');
			include('../../includes/templates/header.php');
		?>

		<main id="entries">
			<div class="wrapper">
				<h1>Admin Login</h1>

				<div id="login">
					<form method="POST" action="index.php">
						<p>
							Username:
							<input name="username" type="text" placeholder="Username" required />
						</p>
						<p>
							Password:
							<input name="password" type="password" placeholder="Password" required />
						</p>
						<p>
							<input name="login" type="submit" value="Submit" />
							<input type="reset" value="Reset" />
						</p>
					</form>
					<p>
						The place where super duper top secret things definitely do not occur...
					</p>
				</div>

				<h1>Database Entries</h1>
				<table id="projects-table">
					<col style="width:8%">
					<col style="width:7%">
					<col style="width:13%">
					<col style="width:7%">
					<col style="width:7%">
					<col style="width:6%">
					<col style="width:7%">
					<col style="width:6%">
					<col style="width:7%">
					<col style="width:6%">
					<col style="width:7%">
					<col style="width:6%">
					<col style="width:6%">
					<col style="width:7%">

					<thead>
						<tr>
							<th>Title</th>
							<th>Directory</th>
							<th>New Image</th>
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
							<th>Controls</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input form="goldschen-ohm-lab" name="title" type="text" value="Goldschen-Ohm-Lab" required />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="directory" type="text" value="goldschen-ohm-lab" required />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="image" type="file" />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="blurb" type="text" value="Mobile-Responsive Webpage Update" />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="description" type="text" value="Updating the HTML to use semantic HTML5 tags, as well as implementing a mobile-first responsive design with vanilla CSS, add mobile-responsiveness and increase the readability of the code base of a researcher's lab webpage." />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="date" type="date" value="2021-08-05" required />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="primary_link" type="text" value="https://marcel-goldschen-ohm.github.io/" />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="primary_link_text" type="text" value="View Website" />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="secondary_link" type="text" value="" />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="secondary_link_text" type="text" value="" />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="tertiary_link" type="text" value="" />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="tertiary_link_text" type="text" value="" />
							</td>
							<td>
								<input form="goldschen-ohm-lab" name="featured" type="text" value="0" required />
							</td>
							<td>
								<div>
									<input form="goldschen-ohm-lab" name="delete" type="checkbox" value="delete" />
									<input form="goldschen-ohm-lab" name="update" type="submit" value="Update" />
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<input form="minesweeper" name="title" type="text" value="Minesweeper" required />
							</td>
							<td>
								<input form="minesweeper" name="directory" type="text" value="minesweeper" required />
							</td>
							<td>
								<input form="minesweeper" name="image" type="file" />
							</td>
							<td>
								<input form="minesweeper" name="blurb" type="text" value="JavaScript Minesweeper Game" />
							</td>
							<td>
								<input form="minesweeper" name="description" type="text" value="A mobile-responsive, no-frameworks version of the classic game of minesweeper." />
							</td>
							<td>
								<input form="minesweeper" name="date" type="date" value="2021-06-09" required />
							</td>
							<td>
								<input form="minesweeper" name="primary_link" type="text" value="https://twit96.github.io/minesweeper/" />
							</td>
							<td>
								<input form="minesweeper" name="primary_link_text" type="text" value="Play Now" />
							</td>
							<td>
								<input form="minesweeper" name="secondary_link" type="text" value="https://github.com/twit96/minesweeper/" />
							</td>
							<td>
								<input form="minesweeper" name="secondary_link_text" type="text" value="View GitHub" />
							</td>
							<td>
								<input form="minesweeper" name="tertiary_link" type="text" value="" />
							</td>
							<td>
								<input form="minesweeper" name="tertiary_link_text" type="text" value="" />
							</td>
							<td>
								<input form="minesweeper" name="featured" type="text" value="3" required />
							</td>
							<td>
								<div>
									<input form="minesweeper" name="delete" type="checkbox" />
									<input form="minesweeper" name="update" type="submit" value="Update" />
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<input form="wittiggrass" name="title" type="text" value="Wittig Grass Sales" required />
							</td>
							<td>
								<input form="wittiggrass" name="directory" type="text" value="wittiggrass" required />
							</td>
							<td>
								<input form="wittiggrass" name="image" type="file" />
							</td>
							<td>
								<input form="wittiggrass" name="blurb" type="text" value="Business Website Redesign" />
							</td>
							<td>
								<input form="wittiggrass" name="description" type="text" value="This website redesign gives a new face to an outdated business website. Background image slideshows, custom informational card layouts, an optimized and filterable image gallery page, and numerous other tricks yield a clean and mobile-responsive design with pure CSS (no frameworks)." />
							</td>
							<td>
								<input form="wittiggrass" name="date" type="date" value="2021-05-10" required />
							</td>
							<td>
								<input form="wittiggrass" name="primary_link" type="text" value="https://twit96.github.io/wittiggrass/" />
							</td>
							<td>
								<input form="wittiggrass" name="primary_link_text" type="text" value="View Website" />
							</td>
							<td>
								<input form="wittiggrass" name="secondary_link" type="text" value="" />
							</td>
							<td>
								<input form="wittiggrass" name="secondary_link_text" type="text" value="" />
							</td>
							<td>
								<input form="wittiggrass" name="tertiary_link" type="text" value="" />
							</td>
							<td>
								<input form="wittiggrass" name="tertiary_link_text" type="text" value="" />
							</td>
							<td>
								<input form="wittiggrass" name="featured" type="text" value="4" required />
							</td>
							<td>
								<div>
									<input form="wittiggrass" name="delete" type="checkbox" />
									<input form="wittiggrass" name="update" type="submit" value="Update" />
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<input form="add-new-project" name="title" type="text" placeholder="New Title" required />
							</td>
							<td>
								<input form="add-new-project" name="directory" type="text" placeholder="new-directory" required />
							</td>
							<td>
								<input form="add-new-project" name="image" type="file" />
							</td>
							<td>
								<input form="add-new-project" name="blurb" type="text" placeholder="A Short Blurb" />
							</td>
							<td>
								<input form="add-new-project" name="description" type="text" placeholder="Project Description" />
							</td>
							<td>
								<input form="add-new-project" name="date" type="date" required />
							</td>
							<td>
								<input form="add-new-project" name="primary_link" type="text" placeholder="project-link1.com" />
							</td>
							<td>
								<input form="add-new-project" name="primary_link_text" type="text" placeholder="Link1 Button Text" />
							</td>
							<td>
								<input form="add-new-project" name="secondary_link" type="text" placeholder="project-link2.com" />
							</td>
							<td>
								<input form="add-new-project" name="secondary_link_text" type="text" placeholder="Link2 Button Text" />
							</td>
							<td>
								<input form="add-new-project" name="tertiary_link" type="text" placeholder="project-link3.com" />
							</td>
							<td>
								<input form="add-new-project" name="tertiary_link_text" type="text" placeholder="Link3 Button Text" />
							</td>
							<td>
								<input form="add-new-project" name="featured" type="number" value="0" required />
							</td>
							<td>
								<input form="add-new-project" name="update" type="submit" value="Add" />
							</td>
						</tr>

					</tbody>
				</table>

				<form id="logout" method="POST" action="index.php">
					<input name="logout" type="submit" value="Logout" />
				</form>
				<script type="text/javascript" src="/js/admin.js" defer></script>

				<form class="hidden" id="goldschen-ohm-lab" method="POST" action="index.php"></form>
				<form class="hidden" id="minesweeper" method="POST" action="index.php"></form>
				<form class="hidden" id="wittiggrass" method="POST" action="index.php"></form>
				<form class="hidden" id="add-new-project" method="POST" action="index.php"></form>

			</div>  <!-- ./wrapper -->
		</main>

		<?php
			include('../../includes/templates/footer.php');
		?>
  </body>
</html>
