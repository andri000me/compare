<form action="tes2.php" method="get">
    <select name="tahun" id="">
        <option value="2020">2020</option>
        <option value="2021">2021</option>
    </select>
    <button type="submit">Ubah Tahun</button>
</form><br>

<style>.heart{color:#e25555;}</style>
Made with <span class="heart">❤</span> in Switzerland <br>

Made with <span style="color: #e25555;">&#9829;</span> in Switzerland
Made with <span style="color: #e25555;">&hearts;</span> in Switzerland <br>

Made with ❤ in Switzerland

<?php

if(isset($_GET['tahun'])) {
    $select_tahun = $_GET['tahun'];
    echo $select_tahun;
}


?>