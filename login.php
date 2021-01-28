<?php
include "koneksi.php";

session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Halaman Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Enter email" name="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="pass">
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="btnSubmit">Login</button>
        </form>
        <?php
        if(isset($_POST['btnSubmit'])) {
          $user = $_POST['email'];
          $pass = $_POST['pass'];
          // $id = "";
          $query = mysqli_query($koneksi, "SELECT * FROM USER WHERE username='$user' AND PASSWORD='$pass'");
          $hitung_data = mysqli_num_rows($query);
          if($hitung_data > 0 ) {
            $get_data = mysqli_fetch_assoc($query);

            if($get_data['level'] == 'admin') {
              // buat session loginnya
              $_SESSION['id'] = $get_data['id'];
              $_SESSION['nama'] = $get_data['nama'];
              $_SESSION['username'] = $user;
              $_SESSION['password'] = $pass;
              $_SESSION['level'] = "admin";
              header("location:dashboard.php");
            }
            else {
              $_SESSION['id'] = $get_data['id'];
              $_SESSION['nama'] = $get_data['nama'];
              $_SESSION['username'] = $user;
              $_SESSION['password'] = $pass;
              $_SESSION['level'] = "user";
              header("location:dashboard.php");
            }
          }
        }
        ?>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
