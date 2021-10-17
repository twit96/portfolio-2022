<?php
  $curr_dir = basename(getcwd());
  if ($curr_dir == 'html') {
    $page_name = 'Web Developer';
    $og_url_extension = '';
    $og_description_extension = '';
  }
  else {
    $page_name = ucfirst($curr_dir);
    $og_url_extension = $curr_dir.'/';
    $og_description_extension = ' - '.$page_name;
  }

  // $timestamp = function($file_path) {
  //   return date('Ymd-His',filectime(basename($file_path)));
  // }
  $timestamp = function() {
    return date('Ymd',filectime(basename('/css/main.css')));
  }

  echo <<<TOP
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <title>Tyler Wittig | {$page_name}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Social Media Card -->
  		<meta name="author" content="Tyler Wittig" />
      <meta property="og:title" content="Tyler Wittig | {$page_name}"/>
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://tylerwittig.com/{$og_url_extension}" />
  		<meta property="og:image" content="/img/site-card.png" />
  		<meta property="og:description" content="Tyler Wittig's Portfolio Website{$og_description_extension}" />
      <!-- make the og:image larger -->
  		<meta name="twitter:card" content="summary_large_image">
  		<!-- end of social media card -->
      <link rel="icon" href="/img/icon.png" />
      <link rel="stylesheet" type="text/css" href="/css/main.css?v={$timestamp()}" />
  TOP;

  echo '</head>';

  echo <<<FILLER
    <body>
      <h1>Test</h1>
    </body>
  </html>
  FILLER;
?>
