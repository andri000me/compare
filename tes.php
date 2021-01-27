<form action="tes.php" method="get">
    <input type="date" name="dt" id="">
    <button type="submit" name="btnSubmit">Ubah Tanggal</button>
</form>

<?php 
if(isset($_GET['dt'])) {
    $dt_input = $_GET['dt'];
    $dt_input_2 = date('Y-m-d', strtotime($dt_input));

    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

    echo $dt_awal. "</br>";
    echo $dt_input_2. "</br>";
}
elseif(empty($_GET['btnSubmit'])) {
    echo "silahkan pilih tanggal";
}
?>
