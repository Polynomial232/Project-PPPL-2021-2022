<?php
    include 'dbconnect.php';

    $act = $_GET['act'];
    $id = $_GET['id'];
    $current = $_GET['current'];

    if($act == 'plus'){
        $current = $current + 1;
        $q = mysqli_query($conn, "UPDATE `detailorder` SET `qty`='$current' WHERE `detailid`='$id'");
        if($q){
            header('location: keranjang.php');
        }
    }else if($act == 'minus'){
        $current = $current - 1;
        $q = mysqli_query($conn, "UPDATE `detailorder` SET `qty`='$current' WHERE `detailid`='$id'");
        if($q){
            header('location: keranjang.php');
        }
    }
?>