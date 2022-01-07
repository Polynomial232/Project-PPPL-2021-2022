<?php
    session_start();
    include('dbconnect.php');

    if(isset($_GET['co'])){
        $idcart = $_GET['co'];
        $checkout = mysqli_query($conn, "UPDATE `cart` SET `status`='pending'
                WHERE `idcart`='$idcart'");
        header('location: login.php');
        die();
    }

    $idproduk = $_GET['id'];

    if(!isset($_SESSION['id'])){
        echo '<script>alert("Login Dulu!")</script>';
        header('location: login.php');
        die();
    }

    $userid = $_SESSION['id'];

    $unique_id = time() . mt_rand() . $userid;

    $p = mysqli_query($conn, "SELECT * FROM `cart` WHERE `userid`='$userid' AND `status`='cart'");
    if(mysqli_num_rows($p) == 0){
        $q = mysqli_query($conn, "INSERT INTO `cart`(`idcart`, `orderid`, `userid`, `tglorder`, `status`)
                        VALUES (NULL,'$unique_id','$userid', NULL,'cart')");
        $q2 = mysqli_query($conn, "INSERT INTO `detailorder`(`detailid`, `orderid`, `idproduk`, `qty`)
                        VALUES (NULL,'$unique_id','$idproduk', 1)");
    }else{
        $r = mysqli_fetch_array($p);
        $order = $r['orderid'];
        $p2 = mysqli_query($conn, "SELECT * FROM `detailorder` WHERE `orderid`='$order' AND `idproduk`='$idproduk'");
        $r2 = mysqli_fetch_array($p2);
        if($r2['idproduk'] == $idproduk){
            $add = $r2['qty'] + 1;
            $addqty = mysqli_query($conn, "UPDATE `detailorder` SET `qty`='$add'
                WHERE `orderid`='$order' AND `idproduk`='$idproduk'");
        }else{
            $q3 = mysqli_query($conn, "INSERT INTO `detailorder`(`detailid`, `orderid`, `idproduk`, `qty`)
                VALUES (NULL,'$order','$idproduk', 1)") or die($conn->error);
        }
    }

    header('location: menu.php?id='.$idproduk);

?>