<?php
include 'koneksi.php';
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Gulaliqu</title>
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
		    <h2>Pesan Produk</h2>
            <hr/><br/>
            <center><h4>Informasi Pembeli</h4></center>
            <hr/>
		    <form action="" method="POST">
		    	<b>Nama Lengkap</b><br/>
		    	<input type="text" name="nama" class="form-control" placeholder="Masukkan nama"><br/>
		    	<b>Nomor Ponsel</b><br/>
                <input type="number" name="no_hp" class="form-control" placeholder="Masukkan nomor ponsel"><br/>
                <b>Alamat</b><br/>
                <textarea name="alamat" class="form-control" style="height:100px;" placeholder="Masukkan alamat"></textarea><br/>
                <br/>
                <center><h4>Detail Pesanan</h4></center>
                <hr/> 
                <div class="row">
                    <div class="col-md-6">
                        <b>Pilihan Produk</b><br/>
                        <div id="produk">
                        <select class="form-control" name="produk">
                            <?php
                                $q = $koneksi->query("SELECT * FROM barang order by nama_barang asc");
                                while($r = $q->fetch_assoc()){
                                    echo "<option value='".$r['id']."'>".$r['nama_barang']." - Rp".number_format($r['harga'], 2, ',', '.')."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <b>Jumlah</b><br/>
                        <div id="jumlah">
                        <input type="number" name="no_hp" class="form-control" placeholder="Masukkan jumlah">
                    </div>
                    </div>
                </div>
                <br/>
                <button style="width:100%;" class="btn btn-primary" onclick="tambah()" name="submit">Tambah Varian</button>
                <hr/>
		    	<button type="submit" class="btn btn-success" name="submit"><span class="fa fa-cart"></span> Checkout</button>
		    </form>
		  </div>
		</div>
		<br/>
    </div>
    <center><i>&copy; GulaliQu 2020. All rights reserved.</i></center><br/>
    <!-- Optional JavaScript -->
    <script>
        function tambah(){
            var para = document.createElement("p");
            var node = document.createTextNode("This is new.");
            para.appendChild(node);

            var element = document.getElementById("div1");
            element.appendChild(para);
        }
</script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>