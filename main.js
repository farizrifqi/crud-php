$(document).ready(function(){
	$("#sdh").on("click", function(){
		var dataid = $(this).attr("data-id");
		//console.log($("td[name=nama_barang]").html());
		$('#isimodal').html("Nama barang: "+$('td[data-id='+dataid+'][name=nama_barang]').html()+"<br/>Yang diperlukan: "+$('td[data-id='+dataid+'][name=need]').html()+"<br/><br/><b>Diproduksi</b><br/><input type='number' name='diproduksi' class='form-control'/><br/>");
		$('#modbutton').attr("data-id", dataid);
	});
});