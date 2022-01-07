<?php
    session_start();
    include 'dbconnect.php';

    $orderid = $_GET['id'];

    $a = mysqli_query($conn, "SELECT * FROM `cart` WHERE `orderid`='$orderid'");
    $b = mysqli_fetch_array($a);
    if($b['status'] == 'Selesai2'){
        header('location: konfirmasi.php');
        die();
    }
    $id = $_SESSION['id'];

    if(isset($_POST['kirim'])){
        $n = $_POST['n'];
        for($i = 1; $i <= $n; $i++){
            $des = $_POST['des'.$i];
            $rate = $_POST['rate'.$i];
            $idproduk = $_POST['id'.$i];

            $q = mysqli_query($conn, "INSERT INTO `testimoni`(`id`, `id_produk`, `id_user`, `deskripsi`, `rate`)
                            VALUES (NULL, '$idproduk', '$id', '$des', '$rate')");
            $q2 = mysqli_query($conn, "UPDATE `cart` SET `status`='Selesai2' WHERE `orderid`='$orderid'");
        }
        header("refresh: 0");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./images/logo.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&family=Ruluko&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Index</title>
        <style>
            *{
                margin: 0;
                padding: 0;
            }
            .rate {
            }
            .rate:not(:checked) > input {
                position:absolute;
                top:-9999px;
            }
            .rate:not(:checked) > label {
                float: right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ccc;
            }
            .rate:not(:checked) > label:before {
                content: '★ ';
            }
            .rate > input:checked ~ label {
                color: #ffc700;    
            }
            .rate:not(:checked) > label:hover,
            .rate:not(:checked) > label:hover ~ label {
                color: #deb217;  
            }
            .rate > input:checked + label:hover,
            .rate > input:checked + label:hover ~ label,
            .rate > input:checked ~ label:hover,
            .rate > input:checked ~ label:hover ~ label,
            .rate > label:hover ~ input:checked ~ label {
                color: #c59b08;
            }
            .test{
                width: 70%;
                margin-top: 5em;
            }
            @media only screen and (max-width: 900px) {
                .test{
                    width: 100%;
                }

            }
        </style>
    </head>
    <body>
        <div class="container test">
            <h2 class="text-center">Berikan Testimoni</h2>
            <hr>
            
            <form method="post">
            <div class="row">
                    <?php

                        $no = 0;
                        $q = mysqli_query($conn, "SELECT * FROM `detailorder` WHERE `orderid` = '$orderid'");
                        while($r = mysqli_fetch_array($q)){
                            $idproduk = $r['idproduk'];
                            $q2 = mysqli_query($conn, "SELECT * FROM `produk` WHERE `idproduk` = '$idproduk'");
                            $r2 = mysqli_fetch_array($q2);
                            if($r2['hargaafter'] == 0){
                                $harga = $r2['hargabefore'];
                            }else{
                                $harga = $r2['hargaafter'];
                            }
                            $no++;
                            ?>
                                    <div class="col-md-3">
                                        <img src="./<?= $r2['gambar'] ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" value="<?= $r2['idproduk'] ?>" name="id<?= $no ?>" hidden>
                                        <?= $r2['namaproduk'] ?><br><?= $harga ?>
                                    </div>
                                    <div class="col-md-3">
                                        <textarea id="" class="form-control" cols="20" rows="3" name="des<?= $no ?>" placeholder="Deskripsi" require></textarea>
                                    </div>
                                    <div class="col-md-3 rate">
                                        <input type="radio" id="star5<?= $no ?>" name="rate<?= $no ?>" value="5" />
                                        <label for="star5<?= $no ?>" title="text">5 stars</label>
                                        <input type="radio" id="star4<?= $no ?>" name="rate<?= $no ?>" value="4" />
                                        <label for="star4<?= $no ?>" title="text">4 stars</label>
                                        <input type="radio" id="star3<?= $no ?>" name="rate<?= $no ?>" value="3" />
                                        <label for="star3<?= $no ?>" title="text">3 stars</label>
                                        <input type="radio" id="star2<?= $no ?>" name="rate<?= $no ?>" value="2" />
                                        <label for="star2<?= $no ?>" title="text">2 stars</label>
                                        <input type="radio" id="star1<?= $no ?>" name="rate<?= $no ?>" value="1" />
                                        <label for="star<?= $no ?>1" title="text">1 star</label>
                                    </div>
                            <?php
                        }
                    ?>
                    <input type="number" name="n" value="<?= $no ?>" hidden>
                    <input type="submit" value="Kirim" class="btn btn-success form-control" name="kirim" style="margin-top: 1em">
            </div>
            </form>
        </div>
    </body>
</html>