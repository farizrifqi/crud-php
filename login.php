<?php
include 'koneksi.php';
session_start();
if(!empty($_SESSION['username'])){
	header('location: admin.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Warehouse Gulaliqu</title>
  </head>
  <body>
    <br/>
    <div class="container">
    	<?php
    	if (isset($_POST['submit'])){
    			$q = $koneksi->query("SELECT * FROM pengguna where username='".$_POST['username']."'");
    			if ($q->num_rows > 0){
    				if ($q->fetch_assoc()['password'] == $_POST['password']){
    					$_SESSION['username'] = $_POST['username'];
    					echo '<div class="alert alert-success" role="alert">Berhasil login. Akan diarahkan ke halaman selanjutnya...</div>';
    					header('refresh:2;url= admin.php');
    				}else{
    					echo '<div class="alert alert-warning" role="alert">Username atau password digunakan</div>';
    				}
    			}else{
    				echo '<div class="alert alert-warning" role="alert">Username atau password digunakan</div>';
    			}
    		}
    	?>
    	<div class="card">
		  <div class="card-body">
		    <h2>Login</h2>
		    <hr/>
		    <form action="" method="POST">
		    	<b>Username</b><br/>
		    	<input type="text" name="username" class="form-control" placeholder="Masukkan username"><br/>
		    	<b>Password</b><br/>
		    	<input type="password" name="password" class="form-control" placeholder="Masukkan password"><br/>
		    	<input type="submit" class="btn btn-primary" name="submit" value="Login Akun"/>
		    </form>
		  </div>
		</div>
		<br/>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>