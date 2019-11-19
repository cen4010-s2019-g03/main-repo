<?php

echo($_GET['dateReported']);

echo('<br />');

echo(date('Y-m-d', strtotime('+1 day', strtotime($_GET['dateReported']))));

?>