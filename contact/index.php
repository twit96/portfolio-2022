<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Tyler Wittig | Contact</title>
    <meta charset="utf-8" />
    <meta name="description" content="Full-Stack Web Developer in South Texas, specializing in custom websites, website redesigns, and game development." />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/img/icon.png" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
    <link rel="stylesheet" type="text/css" href="/css/contact.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="/js/main.js" defer></script>
    <script src="/js/contact.js" defer></script>
    <!-- map -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
    <!--  -->
  </head>

  <body>
    <?php
			include('../templates/header.html');
		?>

    <section id="contact">
      <h2>Contact Me</h2>
      <div class="flex">
        <div class="left">
          <p id="ajax_container">
            If you have questions, or are in need of a freelance developer for
            your next project, feel free to reach out to me.
          </p>
          <form id="contact-form" method="POST">
            <div class="paired">
              <input type="text" id="name" name="c_name" placeholder="Name" required />
              <input type="text" id="email" name="c_email" placeholder="Email" required />
            </div>
            <input type="text" id="subject" name="c_subject" placeholder="Subject" required />
            <textarea id="message" name="c_message" placeholder="Message" required></textarea>
            <input class="btn" type="button" onclick="ajaxFunction()" value="Send Message"/>
          </form>
        </div> <!-- /.left -->
        <div class="right">
          <div id="map"></div>
        </div> <!-- /.right -->
      </div> <!-- /.wrapper -->
    </section>

    <?php
			include('../templates/footer.html');
		?>
  </body>

</html>
