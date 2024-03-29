<?php

  // Configure Head Tag Info

  // FILENAME declared above include for this file on each page
  // homepage
  if (FILENAME == 'home') {
    $page_name = 'Tyler Wittig | Web Developer';
    $description = "Full-Stack Web Developer in South Texas, specializing in custom websites, website redesigns, and game development.";
    $og_url_extension = '';
    $og_description_extension = '';
  }
  // other pages
  else {
    $page_name = 'Tyler Wittig | '.ucfirst(FILENAME);
    $description = "Tyler Wittig's " . ucfirst(FILENAME) . " Page";
    $og_url_extension = FILENAME;
    $og_description_extension = ' - '.ucfirst(FILENAME);
  }

  // Handle Article Posts
  $title = $page_name;
  if (defined('BLOGPOSTNAME')) {
    $title = BLOGPOSTNAME;
    $description = "Tyler Wittig's Blog Post - " . $title;
    $og_url_extension = FILENAME."?post=".join("-", explode(" ", strtolower($title)));
    $og_description_extension = ' - '.BLOGPOSTNAME;
  }

  // Cache Busting Function - append last modified date to filenames
  $timestamp = function($file_path) {
    return date('Ymd-His',filemtime($_SERVER["DOCUMENT_ROOT"].$file_path));
  };

  echo <<<TOP
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <title>{$title}</title>
      <meta name="description" content="{$description}" />
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="theme-color" content="#06632c" />
      <!-- Social Media Card -->
      <meta name="author" content="Tyler Wittig" />
      <meta property="og:title" content="{$title}"/>
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://tylerwittig.com/{$og_url_extension}" />
      <meta property="og:image" content="/img/site-card.png" />
      <meta property="og:description" content="Tyler Wittig's Portfolio Website{$og_description_extension}" />
      <!-- make the og:image larger -->
      <meta name="twitter:card" content="summary_large_image">
      <!-- end of social media card -->
      <link rel="icon" href="/img/logo.png" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="/css/main.css?v={$timestamp('/css/main.css')}" />
      <script src="/js/main.js?v={$timestamp('/js/main.js')}" defer></script>
  TOP;


  // Page-Specific Tags
  (FILENAME == 'index') ? $curr_page = 'home' : $curr_page = FILENAME;
  // CSS
  echo "\n\t".'<link rel="stylesheet" type="text/css" href="/css/'.$curr_page.'.css?v='. $timestamp('/css/'.$curr_page.'.css') .'" />';
  // JS
  if (in_array(
    $curr_page,
    array('home', 'contact')
    )
  ) {
    echo "\n\t".'<script src="/js/'.$curr_page.'.js?v='. $timestamp('/js/'.$curr_page.'.js') .'" defer></script>';
  }

?>
