<?php
include 'koneksi.php';
session_start();
$getUserLogin = $koneksi->query("SELECT * FROM pengguna where username='".$_SESSION['username']."'")->fetch_assoc();
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
    	if($getUserLogin['sebagai'] == 'warehouse'){
		?>
		<h1>Warehouse</h1>
    	<hr/>
       	<?php
    		if (isset($_POST['submit'])){
    			if ($_POST['jml'] <= $_POST['max-jml'] or $_POST['min-jml'] >= $_POST['max-jml']){
	    			$add = $koneksi->query("INSERT INTO barang (nama_barang, harga, qty, max_qty, min_qty) values ('".$_POST['nama']."','".$_POST['harga']."', '".$_POST['jml']."', '".$_POST['max-jml']."','".$_POST['min-jml']."')");
	    			if($add){
	    				echo '<div class="alert alert-success" role="alert">Berhasil menginput data</div>';
	    			}else{

	    				echo '<div class="alert alert-danger" role="alert">Gagal menginput data</div>';
	    			}
    			}else{
	    				echo '<div class="alert alert-danger" role="alert">Gagal menginput data. Jumlah barang tidak boleh melebihi maksimal.</div>';
    			}
    		}
    	?>
    	<div class="btn-group" role="group" aria-label="Basic example">
    	<font size="5">Selamat datang, <?= $getUserLogin['username']; ?>!</font> &nbsp;
 				<a href="sales.php";><button type="button" class="btn btn-primary">Report</button> 
  				<a href="Logout.php";><button type="button" class="btn btn-primary">Logout</button></a>	
	</div>
    	<div class="row">
    		<div class="col-md-6">
    	<div class="card">
		  <div class="card-body">
		    <h2>Input Barang</h2>
		    <hr/>
		    <form action="" method="POST">
		    	<b>Nama Barang</b><br/>
		    	<input type="text" name="nama" class="form-control" placeholder="Masukkan nama barang"><br/>
		    	<b>Harga Barang</b><br/>
		    	<input type="number" name="harga" class="form-control" placeholder="Masukkan harga barang"><br/>
		    	<b>Jumlah Barang</b><br/>
		    	<input type="number" name="jml" class="form-control" placeholder="Masukkan jumlah barang" value="0"><br/>
		    	<b>Jumlah minimal Barang</b><br/>
		    	<input type="number" name="min-jml" class="form-control" placeholder="Masukkan minimal Jumlah barang"><br/>
		    	<b>Jumlah maksimal Barang</b><br/>
		    	<input type="number" name="max-jml" class="form-control" placeholder="Masukkan maksimal Jumlah barang"><br/>
		    	<input type="submit" class="btn btn-primary" name="submit" value="Submit data barang"/>
		    </form>
		  </div>
		</div>
	</div>
		<br/><br/>
		<div class="col-md-6">
		<div class="card">
		  <div class="card-body">
		    <h2>Barang</h2>
		    <hr/>
		    <table  style="text-align:center;" class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">Barang</th>
			      <th scope="col">Minimal Stock</th>
			      <th scope="col">Qty</th>
			      <th scope="col">Maksimal Stock</th>
			    </tr>
			  </thead>
			  <tbody>
			   <?php
			   		$get = $koneksi->query("SELECT * FROM barang order by nama_barang");
			   		while ($row = $get->fetch_assoc()){
			   			echo "<tr>";
			   			echo "<td>".$row['nama_barang']."</td>";
			   			echo "<td>".$row['min_qty']."</td>";
			   			if ($row['qty']-15 <= $row['min_qty']){
			   				echo "<td><font color='red'>".$row['qty']."</font></td>";
			   			}else if ($row['qty'] > $row['max_qty']){
			   				echo "<td><font color='green'>".$row['qty']."</font></td>";
			   			}else{
			   				echo "<td>".$row['qty']."</td>";
			   			}
			   			echo "<td>".$row['max_qty']."</td>";
			   			echo "</tr>";
			   		}
			   ?>
			  </tbody>
			</table>
		  </div>
		</div></div></div> 
		<?php
    	}else if ($getUserLogin['sebagai'] == 'produksi'){
    		?>
    		<h1>Produksi</h1>
  		<hr/>
  	<div>
  		<font size="5">Selamat datang, <?= $getUserLogin['username']; ?>!</font> &nbsp;
  			<a href="Logout.php";><button type="button" class="btn btn-primary">Logout</button></a>	
	</div>
	<br>
  		<div class="card">
		  <div class="card-body">
		    <h2>Barang yang harus diproduksi</h2>
		    <hr/>
		    <table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">Nama Barang</th>
			      <th scope="col">Perlu Diproduksi</th>
			      <th scope="col">Aksi</th> 
			  <tbody>
			  	<?php
			  		$get = $koneksi->query("SELECT id, nama_barang, sum(max_qty-qty) as need from barang where qty<max_qty");
			  		while ($rows = $get->fetch_assoc()){
			  			echo "<tr>";
			  			echo "<td name=\"nama_barang\" data-id=\"".$rows['id']."\">".$rows['nama_barang']."</td>";
			  			echo "<td name=\"need\" data-id=\"".$rows['id']."\">".$rows['need']." Buah</td>";
			  			echo "<td><button data-id=\"".$rows['id']."\" class=\"btn btn-primary\" id=\"sdh\" data-toggle=\"modal\" data-target=\"#produksi\">Sudah diproduksi</button></td>";
			  			echo "</tr>";
			  		}
			  	?>
			  </tbody>
			</table>
		  </div>
		</div>
  	</div>
<div class="modal fade" id="produksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="isimodal">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-id="" id="modbutton" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> 
    		<?php
    	}else{
    ?>
    <h1>SALES</h1>
	  	 <hr/>
    	<?php
    }
    	?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>