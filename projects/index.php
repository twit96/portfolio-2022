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

include('../templates/header.html');
include('../php/all_projects.php');
include('../templates/footer.html');

echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
