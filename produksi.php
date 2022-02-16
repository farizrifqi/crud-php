<?php
	include 'koneksi.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Gulaliqu Depart. Produksi</title>
  </head>
  <body>
  	<br/>
  	<div class="container">
  		<h1>Produksi</h1>
  		<hr/>
  		<?php 
    	if($getUserLogin['sebagai'] == 'Produksi'){
		?>
  	<div>
  			<font size="5">Selamat datang, <?= $getUserLogin['username']; ?>!</font> &nbsp;
  			<a href="Logout.php";><button type="button" class="btn btn-primary">Logout</button></a>	
	</div>
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
    <!-- Optional JavaScript -->
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="main.js" type="text/javascript"></script>
  </body>
</html>