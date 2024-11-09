<?php  
	session_start();
	include 'koneksi.php';

	$keranjangid 	= "";
	$username  		= "";
	$price  		= $_POST['price'];
	$productid		= $_POST['productid'];
	$quantity		= $_POST['quantity'];
	$catatanorder	= $_POST['catatanorder'];
	$size		= $_POST['size'];
	$ice		= $_POST['ice'];
	$total_harga	= $price*$quantity;
	

	$sql = "INSERT INTO keranjang VALUES('$keranjangid','$username', '$total_harga', '$productid', '$quantity', '$catatanorder','$size','$ice')";
	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		header("location:menu.php?message=tambah_berhasil");
	} else {
		header("location:menu.php?message=failed");
	}
?>