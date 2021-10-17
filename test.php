<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test</title>
  </head>
  <body>
    <?php

    echo 'dirname(__FILE__)' . dirname(__FILE__) . '\n';
    echo 'getcwd();' . getcwd() . '\n';
    echo 'basename(getcwd())' . basename(getcwd()) . '\n';
    echo 'basename(__DIR__)' . basename(__DIR__) . '\n';

     ?>
  </body>
</html>
