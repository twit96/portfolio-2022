<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Error | Tyler Wittig</title>
    <meta name="description" content="Something went wrong. Please check the url and try again." />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff" />
    <link rel="icon" href="/img/icon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
    <script src="/js/main.js" defer></script>
    <link rel="stylesheet" href="/css/404.css">
  </head>
  <body>
    <?php
      DEFINE("FILENAME", 'post');
      require_once (__DIR__ .'/../src/View/common/header.php');
    ?>

    <main>
      <div class="wrapper">
        <div id="logo-container">
          <div id="main-logo-wrap">
            <img id="main-logo" src="/img/icon_lg.png" alt="site logo" />
            <span class="main-logo-overlay"></span>
          </div>
        </div>
        <h1>404 Error</h1>
        <h2>The requested URL doesn't exist on this website!</h2>
        <p id="home-link">
          Redirecting to homepage in
          <b><span id="counter">15</span> seconds.</b>
        </p>
      </div>
    </main>

    <script>
      var home_link = document.getElementById("home-link");
      home_link.onclick = function() {
        location.replace("https://tylerwittig.com/");
      }
      // timer countdown before redirect
      var counter = document.getElementById("counter");
      var time = counter.innerHTML;
      function checkTimer() {
        time = counter.innerHTML;
        if (time > 0) {
          counter.innerHTML--;
          setTimeout(function(){ checkTimer() }, 1000);
        } else {
          location.replace("https://tylerwittig.com/");
        }
      }
      // initial call to countdown
      setTimeout(function(){ checkTimer() }, 1000);
    </script>

    <?php
      require_once (__DIR__ .'/../src/View/common/footer.php');
    ?>
  </body>
</html>
