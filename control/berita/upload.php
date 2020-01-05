<?php
require '../tmp/header.php';

// apakah tombol submit sudah ditekan ?
if (isset($_POST['upload'])) {
    // apakah data berhasil ditambahkan ?
    if (uploadBerita($_POST) > 0) {
        $berhasil = true;
    } else {
        $gagal = true;
        echo mysqli_error($conn);
    }
}

?>

<!-- Page Wrapper -->
<div id="wrapper">

			<?php foreach ($query as $row): ?>

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
					<i class="fa fa-bars"></i>
					</button>
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<div class="topbar-divider d-none d-sm-block"></div>
						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-lg-inline text-gray-600 small">
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
					</ul>
				</nav>
				<!-- End of Topbar -->
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h2 mb-0 text-gray-800">
						<i class="fas fa-upload"></i> Upload Berita Anda
						</h1>
						<?=date("l , d M Y");?>
					</div>
					<?php endforeach;?>
					<?php if (isset($berhasil)) {
    if ($row['user_role'] == "2") {
        echo '<div class="alert alert-success">Berhasil Mengupload Berita Dari Member !! <a href="../User">Lihat Berita Saya</a></div>';
    } else if ($row['user_role'] == "1") {
        echo '<div class="alert alert-success">Berhasil Mengupload Berita Admin !! <a href="../Admin">Lihat Berita Saya</a></div>';
    }
}?>
					<?php if (isset($gagal)) {
    echo '<div class="alert alert-danger">Gagal Mengupload Berita Anda !! Mohon Maaf !!</div>';
}?>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="judul" class="form-control-label">Judul Berita</label>
							<input type="text" name="judul" id="judul" class="form-control" autocomplete="off" placeholder="Masukkan Judul Untuk Berita Anda" required/>
						</div>
						<div class="form-group">
							<label for="ringkas" class="form-control-label"> Subtitle Berita</label>
							<input type="text" name="ringkas" id="ringkas" class="form-control" required placeholder="Bagian ini Akan Menjadi Subtitle Judul">
						</div>
						<div class="form-group">
							<label for="isi" class="form-control-label"> Penjelasan Penuh Berita</label>
							<textarea cols="40" rows="8" name="isi" id="isi" class="form-control" required placeholder="Deskripsikan Berita Anda"></textarea>
						</div>
						<div class="form-group mb-3 mt-4">
							<span class="text-dark">Masukkan Gambar Berita</span>
							<div class="custom-file mt-2">
								<input type="file" name="gambar" class="custom-file-input" id="gambar" required>
								<label for="gambar" class="custom-file-label">
									Pilih Gambar Untuk Berita Anda
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="penulis" class="form-control-label">ID Penguploap</label>
							<input type="text" name="penulis" id="penulis" class="form-control" value="<?=$row['id'];?>" readonly/>
						</div>
						<div class="form-group">
							<label for="namaUpload" class="form-control-label">Nama Penguploap</label>
							<input type="text" name="namaUpload" id="namaUpload" class="form-control" value="<?=$row['full_name'];?>" readonly/>
						</div>
						<div class="row">
							<div class="col-md-7">
								<button type="submit" name="upload" class="btn btn-primary btn-block mb-3">
								<i class="fas fa-upload"></i> Upload
								</button>
							</div>
							<div class="col-md">
								<?php if ($row['user_role'] == "2") {
    echo '<a href="../User" class="btn btn-outline-danger btn-block">Cancel</a>';
} else if ($row['user_role'] == "1") {
    echo '<a href="../Admin" class="btn btn-outline-danger btn-block">Cancel</a>';
}
?>

							</div>
						</div>
					</form>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->
			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Blog News Made With <i class="fas fa-fw fa-heart text-danger"></i> By <a href="https://instagram.com/dharma_situmorang" target="_blank">Me</a> <?=date('Y')?></span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
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
	<?php require '../tmp/footer.php';?>