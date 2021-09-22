<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Tyler Wittig | Contact</title>
    <meta charset="utf-8" />
    <meta name="description" content="Full-Stack Web Developer in South Texas, specializing in custom websites, website redesigns, and game development." />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/img/icon.png" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="/js/main.js" defer></script>
    <script src="/js/contact.js" defer></script>
  </head>

  <body>
    <?php
			include('../templates/header.html');
		?>

    <section>
      <h2>Contact Me</h2>
      <p id="ajax_container">
        If you have feedback or questions about the dungeon, send us a
        direct message here!
      </p>
      <form id="contact-form" method="POST">
        <label>Name: <input type="text" id="name" name="c_name" placeholder="Name" required /></label>
        <label>Email: <input type="text" id="email" name="c_email" placeholder="Email" required /></label>
        <label>Subject: <input type="text" id="subject" name="c_subject" placeholder="Subject" required /></label>
        <label>Message: <textarea id="message" name="c_message" placeholder="Message" required></textarea></label>
        <div class="buttons">
          <input class="btn" type="button" onclick="ajaxFunction()" value="Send Message"/>
        </div>
      </form>
    </section>

    <?php
			include('../templates/footer.html');
		?>
  </body>

</html>
