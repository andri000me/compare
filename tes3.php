<?php


// for($m=1; $m<=12; ++$m){
//     echo date('F', mktime(0, 0, 0, $m, 1)).'<br>';
// }

// $date = mktime(0,0,0,4,4,2021); //The get's the first of March 2009
// $links = array();
// for($n=1;$n <= date('t',$date);$n++){
//   echo $n. "</br>";
// }

$bulan = "2020-11";
echo $day = date('t', strtotime($bulan)). "<hr>";
for($i=1; $i< $day; $i++){
    echo date("Y-m-$i"). "</br>";
}
?>