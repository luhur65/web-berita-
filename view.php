<?php
include 'control/login.php';
require 'control/comment.php';

$id     = $_GET['mod'];
$query  = "SELECT * FROM tb_news INNER JOIN penulis on tb_news.penulis  = penulis.id WHERE idberita  = '$id'";
$berita = query($query);
// Menampilkan Komentar Public
$komentar        = query("SELECT * FROM comment INNER JOIN tb_news on comment.berita = tb_news.idberita WHERE idberita = '$id' Order By comKey DESC");
$jumlahKomentar  = count(query("SELECT * FROM comment INNER JOIN tb_news on comment.berita = tb_news.idberita WHERE idberita = '$id' Order By comKey DESC"));
$balasanKomentar = query("SELECT * FROM reply_send JOIN tb_news on reply_send.tempatberita = tb_news.idberita JOIN penulis on tb_news.penulis = penulis.id WHERE tempatberita = '$id'");
$jumlahReply     = count(query("SELECT * FROM reply_send JOIN tb_news on reply_send.tempatberita = tb_news.idberita JOIN penulis on tb_news.penulis = penulis.id WHERE tempatberita = '$id'"));
mysqli_error($conn);
?>
<!DOCTYPE html>
<html lang="id">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog News - NewsInternational</title>
  <!-- Icon Bar -->
  <link rel="icon" type="ico" href="img/favicon.ico">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">

  <!-- Custom styles for this template -->
  <link href="css/blog-home.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Blog Web News</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#socialMedia">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <?php foreach ($berita as $news): ?>
        <h1 class="mt-4"><?=$news['judul']?></h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="control/profile/Oauth?mod=<?=$news['full_name']?>&icon=<?=$news['id']?>"><?=$news['full_name']?></a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p> <i class="fas fa-calendar-alt"></i> Posted On <span class="text-primary"><?=$news['tglberita']?> </span>  At <?=$news['jamberita']?> </p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" width="500" src="img/news-icon/<?=$news['gambar']?>">

        <hr>

        <!-- Post Content -->
        <p class="lead"></p>

        <blockquote class="blockquote">
          <p class="mb-0"><?=$news['berita']?></p>
          <footer class="blockquote-footer">
            <cite title="Source Title"></cite>
          </footer>
        </blockquote>

        <p><?=$news['isi_lengkap']?></p>

        <hr>
        <?php endforeach;?>
        <div class="mb-4 mt-2">
          <a href="index" class="btn btn-primary btn-sm"> &larr; Kembali Ke Halaman Utama</a>
        </div>
         <!-- Single Comment -->
         <?php if ($jumlahKomentar > 0 && $jumlahReply > 0): ?>
           <h3 class="h4 text-dark font-weight-bold">Comments Public</h3>
        <span class="text-primary small"><?=$jumlahKomentar?> Commenters</span>
        <span class="text-danger small mx-3"><?=$jumlahReply;?> Reply</span>
        <hr>
         <?php endif?>
        <div class="divider-hr"></div>
        <?php foreach ($komentar as $kmtr): ?>
        <div class="media mb-4">
          <img width="50" src="img/<?=$kmtr['img']?>" alt="Profile Commenter" class="img-fluid img-profile rounded mx-2">
          <div class="media-body">
            <h5 class="mt-0"> <span class="text-dark"><?=$kmtr['Name']?></span></h5>
            <p><?=$kmtr['Comments']?></p>
            <p class="small text-muted"> <i class="fas fa-calendar-alt"></i> <?=$kmtr['write']?></p>
            <?php foreach ($balasanKomentar as $list): ?>
            <?php if ($list['id_commentar'] == $kmtr['comKey']): ?>
            <div class="mb-4 mt-2">
              <div class="media mb-4">
                <img width="50" src="img/user-icon/<?=$list['icon']?>" alt="Profile Admin" class="img-fluid img-profile rounded mx-2">
                <div class="media-body">
                  <h5 class="mt-0">
                    <span class="text-primary text-uppercase">
                      <?=$list['pengirim']?>
                      </span>
                  </h5>
                    <span class="text-muted small">
                      <?=$list['pengirim']?> Membalas Komentar <?=$kmtr['Name']?>
                    </span>
                    <p><?=$list['balasan']?></p>
                    <p class="small text-muted"> <i class="fas fa-calendar-alt"></i> <?=$list['date']?></p>
                    <span class="text-primary float-right small">
                      <?php if ($list['user_role'] == "1"): ?>
                        Status : <i class="fas fa-star fa-fw"></i> Admin Web
                        <?php elseif ($list['user_role'] == "2"): ?>
                          Status : <i class="fas fa-users fa-fw"></i> Member Web
                      <?php endif?>
                    </span>
                </div>
              </div>
            </div>
          <?php endif?>
          <?php endforeach;?>
          </div>
        </div>
        <hr>
        <?php endforeach;?>
        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <?php

global $confirm;

if (isset($confirm)) {
    echo '<div class="alert alert-success">Komentar Berhasil Dipost</div>';
}
?>
            <form action="" method="post">
              <div class="form-group">
                <label for="nama">Your Name</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
              </div>
              <div class="form-group">
                <label for="comment">Your Comment</label>
                <textarea class="form-control" rows="3" name="comment" id="comment"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="send">Submit</button>
            </form>
          </div>
        </div>


      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

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

        <!-- Categories Widget -->
<?php

global $cekRole;
$dataLogin = '<div id="loginPanel">
        <div class="card my-4">
          <h5 class="card-header text-warning">
          <i class="fas fa-exclamation-triangle"></i> Warning !!!
          </h5>
          <div class="card-body">';
$dataLogin .= '<div class="alert alert-danger"> Anda Belum Logout </div>';
//$dataLogin .= '<input type="button" value="Back To Dashboard" onclick="history.back(-1)" class="btn btn-success btn-block mb-4">';
$dataLogin .= '<a href="control/logout" class="btn btn-outline-danger btn-block">Log Out </a>';

if (isset($cekRole)) {
    echo '<div class="alert alert-danger"> Akun Anda Telah Kami Blokir , Silakan Hubungi Admin Web Di Form Social Media  </div>';
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
}
;?>
          </div>
        </div>
      <!-- Akhir Form Login -->


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
  <!-- <script src="myscript.js"></script> -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>