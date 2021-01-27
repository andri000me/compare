<?php

$start = $_GET['start'];
$dt_start = strtotime($start);
$dd_start = date('Y-m-d', $dt_start);

$end = $_GET['end'];

echo $dd_start. "</br>";
echo $end;