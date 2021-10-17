<?php

include('../templates/head.php');
echo <<<HEAD_END
\n
    <!-- map -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
    <!--  -->
  </head>
	<body>
HEAD_END;

include('../templates/header.php');

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

	include('../templates/footer.php');

  echo <<<PAGE_END
  \n
    </body>
  </html>
  PAGE_END;

?>
