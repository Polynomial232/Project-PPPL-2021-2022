<?php
session_start();
include 'dbconnect.php';

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
    <title>Menu</title>
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
        <div id="menu" class="text-uppercase">
            <h1 class="text-center">Testimoni Terbaru</h1>
            <section id="main">
              <div class="row">
                <?php
                  $q = mysqli_query($conn, "SELECT * FROM `testimoni` WHERE `deskripsi`!='' ORDER BY `id` DESC");
                  while($r = mysqli_fetch_array($q)){
                    $userid = $r['id_user'];
                    $idproduk = $r['id_produk'];

                    $q2 = mysqli_query($conn, "SELECT * FROM `login` WHERE `userid`='$userid'");
                    $r2 = mysqli_fetch_array($q2);

                    $q3 = mysqli_query($conn, "SELECT * FROM `produk` WHERE `idproduk`='$idproduk'");
                    $r3 = mysqli_fetch_array($q3);
                ?>
                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title"><?= $r3['namaproduk'] ?></h5>  
                        <?php
                            $star = 0;
                          	while($star < $r['rate']){
                              echo '<i class="fa-solid fa-star" style="color: #FFD700;"></i>';
                              $star++;
                            }
                        ?>
                        <p class="card-text"><?= $r['deskripsi'] ?></p>
                        <h6>by: <?= $r2['namalengkap'] ?></h6>
                      </div>
                    </div>
                    <br>
                  </div>
                <?php
                  }
                ?>
              </div>
            </section>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>