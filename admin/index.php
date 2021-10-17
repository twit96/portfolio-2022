<?php

include('../templates/head.php');

include('../templates/header.html');
echo '<section id="entries">';
include('../php/admin_dashboard.php');
echo '</section>';
include('../templates/footer.html');

echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
