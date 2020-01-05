<?php

require '../Function.php';

// Jika Tidak Ada Id Author yang Di URL (Hacker)
if (!isset($_GET['mod'])) {
    echo "Access Denied";
    return false;
} elseif (empty($_GET['icon'])) {
    echo "Access Denied";
    return false;
}

// Tangkap Data ID Author yg Di URL
$name = $_GET['mod'];
$id   = $_GET['icon'];

// Query data Author
$data  = "SELECT * FROM penulis INNER JOIN role ON role.id_role = penulis.user_role WHERE full_name = '$name'";
$query = query($data);

// Beri Like
$like  = "SELECT * FROM support INNER JOIN penulis ON penulis.id = support.id WHERE support.id = '$id'";
$hasil = count(query($like));

// Tidak Suka
$hate   = "SELECT * FROM hate INNER JOIN penulis ON penulis.id = hate.id WHERE hate.id = '$id'";
$hasil2 = count(query($hate));

// Mengirim Pesan Publik
if (isset($_POST['send'])) {
    if (empty($_POST['name'] && $_POST['pesan'])) {
        $errorEmpty = true;
    } else {
        if (Message($_POST) > 0) {
            $sendSuccess = true;
        } else {
            $sendFailed = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <?php foreach ($query as $row): ?>
  <title> Author Profile - <?=$row['full_name']?> </title>
  <link rel="icon" type="image/icon" href="../../img/user-icon/<?=$row['icon']?>">
  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <h4 class="h3 text-primary">Author Profile</h4>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
      </ul>
    </nav>

        <div class="row mx-3">
          <div class="col-sm-3 mb-4">
            <img src="../../img/user-icon/<?=$row['icon']?>" class="img-profile rounded img-fluid" >
          </div>
          <div class="col-sm">
            <?php if (isset($sendSuccess)): ?>
              <div class="alert alert-success"> Pesan Anda <strong> Berhasil Terkirim !!! </strong> </div>
            <?php elseif (isset($sendFailed)): ?>
              <div class="alert alert-danger"> Pesan Anda <strong> Gagal Terkirim !!! </strong> </div>
            <?php elseif (isset($errorEmpty)): ?>
              <div class="alert alert-danger"> Pesan Tidak Ada <strong> Harap Isi Semua  !!! </strong> </div>
            <?php endif?>
            <table cellpadding="5" cellspacing="5">
              <tr>
                <td> <i class="fas fa-fw fa-user-alt"></i> Nama Lengkap </td>
                <td>: <span class="font-weight-bold text-gray-800"><?=$row['full_name']?></span></td>
              </tr>
              <tr>
                <td> <i class="fas fa-fw fa-venus-mars"></i> Jenis Kelamin </td>
                <td>: <span class="font-weight-bold text-gray-800"><?=$row['jenis_gender']?></span></td>
              </tr>
              <tr>
                <td> <i class="fas fa-fw fa-birthday-cake"></i> Tanggal Lahir</td>
                <td>: <span class="font-weight-bold text-gray-800"><?=$row['tgllahir']?></span></td>
              </tr>
              <tr>
                <td> <i class="fas fa-fw fa-address-card"></i> Alamat</td>
                <td>: <span class="font-weight-bold text-gray-800"><?=$row['alamat']?></span></td>
              </tr>
              <tr>
                <td> <i class="fas fa-fw  fa-mail-bulk"></i> Email Akun</td>
                <td>: <span class="font-weight-bold text-gray-800"><?=$row['email']?></span></td>
              </tr>
              <tr>
                <td>
                  <span class="d-block">Like Me ??</span>
                  <span class="d-inline">
                  <a href="like?mod=<?=$row['full_name']?>&user=<?=$row['id']?>" class="btn btn-link">
                    <i class="fas fa-thumbs-up fa-fw"></i> </a>
                    <?php if ($hasil > 0): ?>
                      <?=$hasil?>
                    <?php endif?>
                </span>
                </td>
                <td>
                  <span class="d-block">Or</span>
                  <span class="d-inline">
                    <a href="hate?mod=<?=$row['full_name']?>&user=<?=$row['id']?>" class="btn btn-link text-danger">
                    <i class="fas fa-thumbs-down fa-fw"></i>
                  </a>
                  <?php if ($hasil2 > 0): ?>
                      <?=$hasil2?>
                    <?php endif?>
                  </span>
                </td>
              </tr>
            </table>
          </div>
                </div>

          <div class="row mx-3">
            <div class="col-md-6">
              <div class="mt-3">
               <span class="text-center">
            <a href="" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#sendModal">
            <i class="fas fa-paper-plane fa-fw"></i> Send a Message</a>
          </span>
             </div>
            </div>
            <div class="col-md-6">
              <div class="mt-3">
          <span class="text-center">
          <a href="../../" class="btn btn-outline-danger btn-block">&larr; Kembali Ke Home Page
            </a>
          </span>
        </div>
            </div>
          </div>

      </div>
      <?php endforeach;?>

  </div>

<!-- Sending Message Modal-->
  <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send Your Message</h5>
          <button class="close text-danger" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <input type="hidden" name="idtujuan" value="<?=$row['id']?>">
            <div class="form-group">
              <label for="name" class="form-control-label">Nama Anda <sup class="text-danger">*</sup></label>
              <input type="text" name="name" id="name" class="form-control" autofocus />
            </div>
            <div class="form-group">
              <label for="pesan" class="form-control-label">Pesan Anda<sup class="text-danger">*</sup></label>
              <textarea cols="40" rows="8" name="pesan" id="pesan" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="send">
                Kirim
              </button>
            </div>
            <div class="form-group">
             <span class="small"><sup class="text-danger">*</sup> wajib diisi</span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>









  <!-- Bootstrap core JavaScript-->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../vendor/jquery/sb-admin-2.min.js"></script>

</body>
</html>