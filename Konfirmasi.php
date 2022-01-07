<?php
    session_start();
    include('dbconnect.php');

    if(!isset($_SESSION['id'])){
      header('location: login.php');
    }

    $userid = $_SESSION['id'];

    $q = mysqli_query($conn, "SELECT * FROM `cart` WHERE `userid`='$userid' ORDER BY `tglorder` DESC");

    if(isset($_POST["konfir"])) {

      $orderid = $_POST['orderid'];
      $nama_file = $_FILES['uploadgambar']['name'];
      $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
      $random = crypt($nama_file, time());
      $ukuran_file = $_FILES['uploadgambar']['size'];
      $tipe_file = $_FILES['uploadgambar']['type'];
      $tmp_file = $_FILES['uploadgambar']['tmp_name'];
      $path = "./konfirmasi/".$orderid.'.'.$ext;
      $pathdb = "konfirmasi/".$orderid.'.'.$ext;
  
  
      if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
        if($ukuran_file <= 5000000){ 
          if(move_uploaded_file($tmp_file, $path)){ 
        
            $sql = mysqli_query($conn, "INSERT INTO `konfirmasi`(`idkonfirmasi`, `orderid`, `userid`, `payment`, `tglsubmit`)
                                      VALUEs (NULL, '$orderid', '$userid', '$pathdb',NULL)");
            $updae = mysqli_query($conn, "UPDATE `cart` SET `status`='dibayar' WHERE `orderid`='$orderid'");
            header('location: konfirmasi.php');
            // Eksekusi/ Jalankan query dari variabel $query
          }
        }
      }
    };
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Polynomial232/Project-PPPL-2021-2022@master/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
      $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })
    </script>
    <title>Pembayaran</title>
</head>
<body>
<div class="position-fixed wa">
        <a href="https://wa.me/6282325064743?text=Halo,%20Saya%20ingin%20bertanya%20tentang%20kue%20atau%20roti%20yang%20dijual" target="_blank">
            <div class="row bg-color p-1">
                <div class="col-7 text-end text-success">Hubungi Kami</div>
                <div class="col-5">
                    <img src="./images/wa.png" class="img-fluid">
                </div>
            </div>
        </a>
    </div>
    <div class="position-fixed ig">
        <a href="https://www.instagram.com/briana_bakery_/" target="_blank">
            <div class="row bg-color p-1">
                <div class="col-7 text-end">Instagram Kami</div>
                <div class="col-5">
                    <img src="./images/ig.png" class="img-fluid">
                </div>
            </div>
        </a>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light nav">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="navbar-brand" href="index.php"><img src="./images/logo.png" width="60" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu baru.php">Menu Baru</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="paling laku.php">Paling Laku</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="testimoni.php">Testimoni</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Konfirmasi.php">Konfirmasi Pembayaran</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Pembayaran.php">Cara Pembayaran</a>
                </li>
            </ul>
            <?php
			    if(isset($_SESSION['role'])){
                    if($_SESSION['role'] == 'Admin' ){
                        echo '<a class="d-flex me-3" href="./admin/">Dashboard</a>';
                    }
			    	echo '<a class="d-flex me-3" href="logout.php">Logout</a>';
			    }else{
			    	echo '<a class="d-flex me-3" href="login.php">Login</a>';
			    }
			?>
            <a class="d-flex" href="keranjang.php">
                <i class="fas fa-shopping-cart"></i>
            </a>
          </div>
        </div>
      </nav>
    
    <div class="container-xxl px-4">

        <!-- main -->
        <div id="Konfimasi" class="text-uppercase text-center">
            <h1>Konfimasi Pembayaran</h1>
            <div class="row">
                <div class="col-12" style="margin-top: 4em;">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No Order</th>
                        <th>Total Harga</th>
                        <th>Detail Order</th>
                        <th>Upload File</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(mysqli_num_rows($q) == 0){
                          echo '<td colspan=5>Tidak ada Order</td>';
                        }
                        while($r = mysqli_fetch_array($q)){
                          $orderid = $r['orderid'];
                          $total = 0;
                          $q2 = mysqli_query($conn, "SELECT * FROM `detailorder` WHERE `orderid`='$orderid'");
                      ?>
                      <div class="modal fade" id="exampleModalLong<?= $r['orderid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle"><?= $r['orderid'] ?></h5>
                            </div>
                            <div class="modal-body">
                              <?php
                                while($r2 = mysqli_fetch_array($q2)){
                                  $idproduk = $r2['idproduk'];
                                  $q3 = mysqli_query($conn, "SELECT * FROM `produk` WHERE `idproduk`='$idproduk'");
                                  $r3 = mysqli_fetch_array($q3);
                                  if($r3['hargaafter'] == 0){
                                    $harga = $r3['hargabefore'];
                                  }else{
                                    $harga = $r3['hargaafter'];
                                  }
                                  ?>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <img src="./<?= $r3['gambar'] ?>" class="img-fluid" alt="">
                                      </div>
                                      <div class="col-md-4 align-self-center">
                                        <h5><?= $r3['namaproduk'] ?></h5> 
                                      </div>
                                      <div class="col-md-4 align-self-center">
                                      (<?= $r2['qty'] ?>) Rp <?= number_format($harga * $r2['qty']) ?>
                                      </div>
                                    </div>
                                  <?php
                                  $total = ($harga * $r2['qty']) + $total;
                                }
                              ?>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <tr>
                        <form action="konfirmasi.php" method="post" enctype="multipart/form-data">
                          <td><?= $orderid ?></td>
                          <td>Rp <?= number_format($total) ?></td>
                          <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?= $r['orderid'] ?>">
                              Lihat Detail
                            </button>
                          </td>
                          <?php
                            if($r['status'] == 'pending' ){
                          ?>
                          <td><input type="file" name="uploadgambar"><input type="text" hidden value="<?= $orderid ?>" name="orderid"></td>
                          <td><input type="submit" value="Konfimasi" name="konfir" class="btn btn-success"></td>
                          <?php
                            }else if($r['status'] == 'Selesai'){
                          ?>
                          <td><a href="testimo.php?id=<?= $r['orderid'] ?>" class="btn btn-success">berikan testimoni</a></td>
                          <td class="bg-success text-white">Order Selesai</td>
                          <?php
                            }else{
                          ?>
                          <td colspan=2 class="<?php if($r['status'] != 'dikirim'){ echo 'bg-success text-white'; }else{ echo 'bg-warning text-white'; } ?>">
                          <?php
                             if($r['status'] == 'dibayar'){
                              echo 'Sudah Dibayar';
                             }
                             if($r['status'] == 'Selesai2'){
                              echo 'Order Selesai';
                             }
                             if($r['status'] == 'Pengiriman'){
                              echo 'Sedang Dikirim';
                             }
                          ?>
                          </td>
                          <?php
                            }
                          ?>
                        </form>
                      </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

    <section id="kontak" class="container w-75">
        <div class="row align-items-center">
            <div class="col-md-6">
                <a href="pembayaran.php">Cara Bayar</a>
                <h4 class="mt-3">Tentang Kami</h4>
                <p>
                    📍Pertigaan sblm Puskesmas Cikatomas (Dari Bank Mandiri)<br>
                        ⏰ 08.00-21.00 WIB<br>
                        📞 082325064743<br>
                        📞 081224575681
                </p>
            </div>
            <div class="col-md-6">
                <form action="kontak.php">
                    <input type="email" name="email" class="form-control my-1" placeholder="Email">
                    <input type="text" name="text" class="form-control my-1" placeholder="Saran Dan Pertanyaan">
                    <input type="submit" name="kirim" class="form-control my-1 btn btn-primary" value="Kirim">
                </form>
            </div>
        </div>
    </section>

    <footer>
        Copyright Briana Bakery &copy; 2021
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>