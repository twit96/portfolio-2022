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
		?>

		<?php
			// include('../php/admin_dashboard.php');
		?>
		<section id="entries">
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
					</tr>
				</thead>
				<tbody>
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
					</tr>
				</tbody>
			</table>
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
			include('../templates/footer.html');
		?>
  </body>
</html>
