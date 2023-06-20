<?php
require "../koneksi.php";
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}


$id = $_GET['p'];
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id'");
$data = mysqli_fetch_array($query);

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css1/style.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/owl.carousel.min.css">
    <link rel="stylesheet" href="../lib/owl.theme.default.min.css">
    <link rel="icon" href="../images/fav.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Nunito:400,700" rel="stylesheet">
    <link rel="stylesheet" href="lib/animate.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
</head>
<style>
    form div{
        margin-bottom: 10px;
    }
</style>
<body>
    <nav class="navbar navbar-expand-md  sticky  fixed-top r-nav">
    <div class="container">

      <a class="navbar-brand animated fadeInLeft" href="#">Desa Karangpakel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarId" >
        <span><i class="fas fa-bars hamburger"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarId">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="kategori.php">Kategori</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="produk.php">Produk</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="berita.php">Berita</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="pesanan.php">Pesanan</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="video.php">Video</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="kelola.php">Kelola</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="logout.php"><?php echo $_SESSION['admin_name'] ?> | Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div>
    <br><br><br>
    <div class="container mt-5">
    <h2>Detail Berita</h2>

    <div class="col-12 col-md-6">
        <form action="" method="POST">
            <div>
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $data['judul']; ?>">
            </div>
            <div>
            <label for="Konten">Konten</label>
            <textarea type="text" name="konten" id="konten" class="form-control" value=""><?php echo $data['konten']; ?></textarea>
            </div>
            <div>
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['kategori']; ?>">
            </div>

            <div class="mt-5 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                <button type="submit" class="btn btn-danger" name="deleteBtn">Hapus</button>
            </div>
        </form>

        <?php
        if(isset($_POST['editBtn'])){
            $judul = htmlspecialchars($_POST['judul']);
            $konten = htmlspecialchars($_POST['konten']);
            $kategori = htmlspecialchars($_POST['kategori']);

            if($data['judul']==$judul){
                header('location:berita.php');
                ?>
                
                <?php
            }
            else{
                $query = mysqli_query($conn, "SELECT * FROM berita WHERE judul='$judul' ");
                $jumlahData = mysqli_num_rows($query);
                
                if($jumlahData > 0){
                    ?>
                    <div class="alert alert-secondary mt-3" role="alert">
                        judul Sudah Ada
                       </div>
                    <?php
                }
                else{
                    $querySimpan = mysqli_query($conn, "UPDATE berita SET judul='$judul', konten='$konten', kategori='$kategori' WHERE id_berita=$id ");
                    if($querySimpan){
                        ?>
                        <div class="alert alert-secondary mt-3" role="alert">
                            Berita Berhasil Diupdate
                        </div>

                        <meta http-equiv="refresh" content="2; url=berita.php"/>
                        <?php
                    }
                    else{
                        echo mysqli_error($conn);
                    }
                }
            }
        }

        if(isset($_POST['deleteBtn'])){
            
            $queryDelete = mysqli_query($conn, "DELETE FROM berita WHERE id_berita=$id");

            if ($queryDelete){
                ?>
                <div class="alert alert-secondary mt-3" role="alert">
                    Kategori Berhasil Dihapus
                </div>

                <meta http-equiv="refresh" content="2; url=berita.php"/>
                <?php
            }else{
                        echo mysqli_error($conn);
                    }
        }
        ?>

    </div>
    </div>
    </div>
    <br><br><br><br><br>
    

    <footer>
    <div class="container h-100 d-flex align-items-center justify-content-center">
      <div class="row">
        <div class="col">
          <div class="r-icon text-center mt-3">
            <ul>
              <li class="list-inline-item animated slideInUp"><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
              <li class="list-inline-item animated slideInUp"><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
              <li class="list-inline-item animated slideInUp"><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
            </ul>
          </div>
          <p class="text-muted" style="font-size:14px;">&copy; Copyright Ricky Primayuda Putra | 2023 All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>



    <script src="../lib/jquery-3.3.1.min.js"></script>
    <script src="../lib/popper.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/jquery.smooth-scroll.js"></script>
    <script src="../lib/imagesloaded.pkgd.min.js"></script>
    <script src="../lib/owl.carousel.min.js"></script>
    <script src="../lib/typed.js"></script>
    <script src="../js1/app.js"></script>

</body>
</html>