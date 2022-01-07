<?php 
	session_start();
	include '../dbconnect.php';
			
	$id = $_GET['id'];
	$section = $_GET['section'];
	$cek = substr($id, 0, 3);
	$i = substr($id, 3);
	
	if($section == 'pembayaran'){
		$q = mysqli_query($conn, "DELETE FROM `pembayaran` WHERE `no` = '$id'");
		if($q){
			header('location: pembayaran.php');
		}
	}

	if($section == 'kategori'){
		$q = mysqli_query($conn, "DELETE FROM `$section` WHERE `idkategori` = '$id'");
		if($q){
			header('location: kategori.php');
		}
	}
	
	if($section == 'produk'){
		$q = mysqli_query($conn, "DELETE FROM `produk` WHERE `idproduk` = '$i'");
		echo $i;
		if($q){
			//header('location: produk.php');
		}
	}
	
?>