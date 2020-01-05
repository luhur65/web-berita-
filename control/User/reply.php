<?php
require '../tmp/header.php';

$author = $_GET['id'];

$myReply = query("SELECT * FROM comment JOIN tb_news on comment.berita = tb_news.idberita JOIN penulis on tb_news.penulis = penulis.id WHERE comKey = '$author'");
//var_dump($myReply);

if (isset($_POST['kirim'])) {
    if (balasComment($_POST) > 0) {
        if (Done($_POST) > 0) {
            # code...
        }
        echo mysqli_error($conn);
        $confirm = true;
    } else {
        echo "Gagal Mengirim Balasan Komentar Anda";
        echo mysqli_error($conn);
    }
}

?>

 <!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <h1 class="h3 text-primary">Reply Comment </h1>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <?php foreach ($query as $row): ?>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-lg-inline d-none text-gray-600 small">
                  <?=$row['full_name'];?>
                </span>
                <img class="img-profile rounded-circle" src="../../img/user-icon/<?=$row['icon']?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../profile/il?see=<?=$row['id']?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
        <?php endforeach?>
      </ul>
    </nav>

    <div class="row mx-3">
    	<div class="col-lg-6">
    		<?php foreach ($myReply as $see): ?>
    		<div class="card o-hidden border-0 shadow-lg my-2">
			<div class="card p-2">
            <h5 class="card-header text-light font-weight-bold bg-primary">
            Comment Public</h5>
            <div class="card-body">
            	<?php if (isset($confirm)): ?>
            		<div class="alert alert-success">
            			<strong>Terkirim . !!!</strong>Balasan Anda Telah Dipost
            		</div>
            	<?php endif?>
              <div class="d-inline-block mb-3">
                <img width="45" class="img-fluid img-profile d-inline" src="../../img/<?=$see['img']?>">
              <span class="mr-2 h4 text-primary font-weight-normal">
          <?=$see['Name']?>
        </span>
              </div>
				<p class="text-muted small">
					<i class="fas fa-calendar fa-fw"></i> Menggomentari Pada Tanggal <?=$see['write']?>
				</p>
				<p class="text-dark">Tanggapan / Komentarnya : </p>
				<span class="text-primary text-center">
					" <?=$see['Comments']?> "
				</span><br><br>
        <?php if ($see['ditanggapi'] == '1'): ?>
          <div class="small mt-4">
            <button type="button" class="btn btn-success btn-sm">
              <i class="fas fa-check fa-fw"></i> Sudah Dibalas
            </button>
          </div>
          <hr class="bg-primary">
        <a href="../User" class="btn btn-outline-danger btn-block">Kembali Ke Dashboard Saya</a>
        <?php else: ?>
         <div class="small mt-4">
          <a href="#reply" class="btn btn-primary btn-sm">Ingin Menanggapi ??</a>
        </div>
        <span class="text-muted small">Klik button diatas bila Anda Ingin Membalas Komentar Tersebut</span>
        <hr class="bg-primary">
        <?php if (isset($confirm)): ?>
          <a href="../User" class="btn btn-outline-danger btn-block">Kembali Ke Dashboard Saya</a>
        <?php else: ?>
         <a href="../User" class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#confirmModal">Kembali Ke Dashboard Saya</a>
        <?php endif?>
        <?php endif?>
            </div>
          </div>
        </div>
    <?php endforeach?>
    	</div>
    	 <!-- Akhir View Comment Public -->


    	<div class="col-lg">
    		<!-- Comments Form -->
    		<?php foreach ($myReply as $see): ?>
    	 <div class="card o-hidden border-0 shadow-lg my-2">
        <div class="card p-2" id="reply">
          <h5 class="card-header text-dark font-weight-bold bg-warning">
          	Reply Comment </h5>
          <div class="card-body">
            <form action="" method="post">
              <!-- <div class="form-group"> -->
              	<input type="hidden" name="IDberita" value="<?=$see['idberita']?>">
            	<input type="hidden" name="idcomentar" value="<?=$see['comKey']?>">
              <!-- </div> -->
              <div class="form-group row">
              	<div class="col-sm-6 mb-3 mb-sm-0">
              	<label for="pengirim" class="form-control-label">From</label>
              	:<input class="form-control" type="text" name="pengirim" value="<?=$see['username']?>" readonly id="pengirim">
              	</div>
              	 <div class="col-sm-6">
              	 <label for="penerima" class="form-control-label">To</label>
              	:<input class="form-control" type="text" name="penerima" value="<?=$see['Name']?>" readonly id="penerima">
              	 </div>
              </div>
              <div class="form-group">
              	<label for="textarea" class="form-control-label">My Reply</label>
                <textarea class="form-control" rows="5" id="textarea" name="textarea" placeholder="Tuliskan Apa Balasan Anda" required></textarea>
              </div>
              <div class="form-group">
               	<button type="submit" class="btn btn-warning text-dark btn-block" name="kirim">
               	  <i class="fas fa-paper-plane"></i> Send My Reply
                </button>
              </div>
            </form>
        <?php endforeach?>
          </div>
        </div>
    </div>
    	</div>
    </div>

     <!-- Confirm Modal-->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
         <p class="text-dark font-weight-normal text-justify"> Anda Yakin ingin Keluar & Tidak Ingin Membalas Komentar Dari Public ??</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">
              Tetap Disini
          </button>
          <a class="btn btn-outline-danger" href="../User">Keluar laman</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir confirm Modal -->

	 <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Logout Modal -->

  </div>
  <!-- Akhir Main Content -->
</div>
<!-- Akhir Content Wrapper -->



<!-- Template Footer -->
<?php require '../tmp/footer.php';?>
