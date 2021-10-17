<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test</title>
  </head>
  <body>
    <?php

    echo 'dirname(__FILE__)' . dirname(__FILE__) . '<br />';
    echo 'getcwd();' . getcwd() . '<br />';
    echo 'basename(getcwd())' . basename(getcwd()) . '<br />';
    echo 'basename(__DIR__)' . basename(__DIR__) . '<br />';

     ?>
  </body>
</html>
