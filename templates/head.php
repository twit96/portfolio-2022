<?php

  // Configure Head Tag Info
  $curr_dir = basename(getcwd());

  // homepage
  if ($curr_dir == 'html') {
    $page_name = 'Web Developer';
    $description = "Full-Stack Web Developer in South Texas, specializing in custom websites, website redesigns, and game development.";
    $og_url_extension = '';
    $og_description_extension = '';
  }
  // other pages
  else {
    $page_name = ucfirst($curr_dir);
    $description = "Tyler Wittig's " . $page_name . " Page";
    $og_url_extension = $curr_dir.'/';
    $og_description_extension = ' - '.$page_name;
  }


  // Cache Busting Function - append last modified date to filenames
  $timestamp = function($file_path) {
    return date('Ymd-His',filemtime($_SERVER["DOCUMENT_ROOT"].$file_path));
  };

  echo <<<TOP
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <title>Tyler Wittig | {$page_name}</title>
      <meta name="description" content="{$description}" />
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
  		<link rel="preconnect" href="https://fonts.googleapis.com">
  		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  		<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="/css/main.css?v={$timestamp('/css/main.css')}" />
  		<script src="/js/main.js?v={$timestamp('/js/main.js')}" defer></script>
  TOP;


  // Page-Specific Tags
  ($curr_dir == 'html') ? $curr_page = 'home' : $curr_page = $curr_dir;
  // CSS
  echo "\n\t".'<link rel="stylesheet" type="text/css" href="/css/'.$curr_page.'.css?v='. $timestamp('/css/'.$curr_page.'.css') .'" />';
  // JS
  if (in_array($curr_page, array('home', 'contact'))) {
    echo "\n\t".'<script src="/js/'.$curr_page.'.js?v='. $timestamp('/js/main.js') .'" defer></script>';
  }

?>
