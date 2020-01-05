<?php
include 'control/login.php';

// Query Database Berita
$query = "SELECT * FROM tb_news INNER JOIN penulis on tb_news.penulis  = penulis.id Order By idberita DESC";
// pagination
// konfigurasi
$jumlahDataPerHalaman = 3;
$jumlahData           = count(query($query));
$jumlahHalaman        = ceil($jumlahData / $jumlahDataPerHalaman);

$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData     = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$berita = query("SELECT * FROM tb_news INNER JOIN penulis on tb_news.penulis  = penulis.id Order By idberita DESC LIMIT $awalData, $jumlahDataPerHalaman");
# Mencari Berita
// search form
if (isset($_POST["cari"])) {
    $berita = cariBerita($_POST["search"]);
    if (!$berita = cariBerita($_POST["search"])) {
        $error404 = true;
        echo mysqli_error($conn);
    }
}

mysqli_error($conn);
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Dharma Bakti Situmorang">
    <meta name="og:Berita Ngawur" property="og:Website Berita Ngawur" content="Website Berita">
  <meta name="robots" content="noindex , nofollow">
    <title>Ngawur News - Website Berita</title>
    <!-- Icon Bar -->
    <link rel="icon" type="ico" href="img/favicon.ico">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">NgawurNewsIndoPeople</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#searchInfo">Search</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#loginPanel">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#socialMedia">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://webberitasaya.000webhostapp.com/" target="_blank">Berita Lain</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <h1 class="my-4">Berita Terkini </h1>
          <?php if (isset($error404)): ?>
          <?php echo '<div class="alert alert-danger text-center"> <i class="fas fa-fw fa-exclamation-triangle"></i> 404 Berita Tidak Ditemukan </div>' ?>
          <?php endif?>
          <!-- Blog Post Beriat User -->
          <?php foreach ($berita as $news): ?>
          <div id="dataTable">
            <div class="card mb-4" id="container">
              <img src="img/news-icon/<?=$news['gambar']?>" class="card-img-top img-fluid rounded" width="300">
              <div class="card-body">
                <h2 class="card-title"><?=$news['judul']?></h2>
                <span class="card-subtitle small"><?=$news['berita']?></span>
                <p class="card-text"><?=substr(stripslashes($news['isi_lengkap']), 0, 50);?>......</p>
                <a href="view?mod=<?=$news['idberita']?>" class="btn btn-primary">Read More &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                <i class="fas fa-calendar-alt"></i> Posted on <?=$news['tglberita']?> by
                <a href="control/profile/Oauth?mod=<?=$news['full_name']?>&icon=<?=$news['id']?>"><?=$news['full_name']?></a>
              </div>
            </div>
          </div>
          <?php endforeach;?>
          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            <?php if ($halamanAktif > 1): ?>
              <li class="page-item mr-2">
                <a class="page-link rounded-circle" href="?halaman=<?=$halamanAktif - 1;?>">
                  &laquo;
                </a>
            </li>
            <?php endif?>

            <?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
              <?php if ($i == $halamanAktif): ?>
                <li class="page-item font-weight-bold ">
                <a class="btn btn-primary rounded-circle" href="?halaman=<?=$i?>">
                  <?=$i;?>
                </a>
            </li>
              <?php else: ?>
                <li class="page-item">
                <a class="page-link rounded-circle" href="?halaman=<?=$i?>">
                  <?=$i;?>
                </a>
            </li>
              <?php endif?>
          <?php endfor;?>

          <?php if ($halamanAktif < $jumlahHalaman): ?>
              <li class="page-item ml-2">
                <a class="page-link rounded-circle" href="?halaman=<?=$halamanAktif + 1;?>">
                   &raquo;
                </a>
            </li>
            <?php endif?>

          </ul>
        </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <!-- Search Widget -->
          <div id="searchInfo"></div>
          <div class="card my-4">
            <h5 class="card-header">Search News</h5>
            <div class="card-body">
              <form action="" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search for..." id="search" name="search" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="cari">
                <i class="fas fa-search"></i> Cari Berita ...
                </button>
              </form>
            </div>
          </div>
          <!-- Categories Widget -->
          <div id="loginPanel">
            <div class="card my-4">
              <h5 class="card-header">Login Panel</h5>
              <div class="card-body">
                <?php
global $cekRole;
$dataLogin = '<div class="alert alert-danger"> Anda Belum Logout </div>';
//$dataLogin .= '<input type="button" value="Back To Dashboard" onclick="history.back(-1)" class="btn btn-success btn-block mb-4">';
$dataLogin .= '<a href="control/logout" class="btn btn-outline-danger btn-block">Log Out </a>';
if (isset($cekRole)) {
    echo '<div class="alert alert-danger"> <i class="fas fa-fw fa-exclamation-triangle"></i> Banned , Access Denied By Admin </div>';
}
if (isset($error)) {
    echo '<div class="alert alert-danger"> Password Atau Username Salah </div>';
}
if (isset($_SESSION['login'])) {
    $username = $_SESSION['login'];
    $query    = mysqli_query($conn, "SELECT * FROM penulis WHERE penulis.username = '$username'");
    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);
        if ($row['user_role'] == "2") {
            echo $dataLogin;
            echo "<br/>";
            echo '<a href="control/User" class="btn btn-primary btn-block">Dashboard Saya</a>';
        } else if ($row['user_role'] == "1") {
            echo $dataLogin;
            echo "<br/>";
            echo '<a href="control/Admin" class="btn btn-primary btn-block">Dashboard Admin</a>';
        }
    }
} else if (!isset($_SESSION['login'])) {
    echo '<form action="" method="post">
                  <div class="form-group">
                    <input class="form-control" type="text" name="username" placeholder="enter username" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="enter password" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="login">
                    Login
                    </button>
                  </div>
                  <div class="divider"></div>
                  <div class="form-group">
                    <a href="control/register" class="btn btn-outline-danger btn-block">
                      Daftar Akun
                    </a>
                  </div>
                </form>

            ';
}
;?>

              </div>
            </div>
            <!-- Side Widget -->
            <div id="socialMedia"></div>
            <div class="card my-4">
              <h5 class="card-header">Social Media Account</h5>
              <div class="card-body">
                <div>
                  <i class="fab fa-fw fa-facebook"></i>
                  <a href="http://www.facebook.com/Adiknya.situmorang">
                    Dharma Situmorang
                  </a>
                </div>
                <div class="divider"></div>
                <div>
                  <i class="fab fa-fw fa-instagram"></i>
                  <a href="http://www.instagram.com/dharma_situmorang">
                    @dharma_situmorang
                  </a>
                </div>
                <div class="divider"></div>
                <div>
                  <i class="fab fa-fw fa-github"></i>
                  <a href="http://www.github.com/luhur65">
                    luhur65
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Made With <i class="fas fa-fw fa-heart text-danger"></i> Blog-News 2019</p>
      </div>
      <!-- /.container -->
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/gamesSuwit.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>