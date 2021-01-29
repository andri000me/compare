<form action="tes2.php" method="get">
    <input type="date" name="dt">
    <button type="submit">Ubah Tahun</button>
</form>

<?php

if(isset($_GET['dt'])) {
    $dt = $_GET['dt'];
    echo $dt . "<hr>";

    if($dt > date('Y-m-d'))
    {
        echo "tanggal skrng";
    }
    else
    {
        echo "date:". $dt;
    }
}


?>