<?php
require '../tmp/header.php';
// Commentar Public
$dataKomentar    = "SELECT * FROM comment JOIN tb_news ON tb_news.idberita = comment.berita JOIN penulis ON tb_news.penulis = penulis.id WHERE username = '$username' Order By comKey DESC";
$checkKom        = "SELECT * FROM comment JOIN tb_news ON tb_news.idberita = comment.berita JOIN penulis ON tb_news.penulis = penulis.id WHERE username = '$username' and ditanggapi = 0 ";
$countCheck      = count(query($checkKom));
$commentarPublic = count(query($dataKomentar));
$listCommentar   = query($dataKomentar);
// Berita yg Diupload User
$dataBerita = "SELECT * FROM tb_news INNER JOIN penulis ON tb_news.penulis = penulis.id WHERE username = '$username'";
#Query Berita
$berita     = count(query($dataBerita));
$beritaUser = query($dataBerita);
# Mecari Berita
$cariBerita = query($dataBerita);
// search form
if (isset($_POST["cari"])) {
    if ($cariBerita = cariBerita($_POST["search"])) {
        $ok200 = true;
    } else {
        $error404 = true;
        echo mysqli_error($conn);
    }
}
// Pesan
$dataPesan  = "SELECT * FROM pesan JOIN penulis On penulis.id = pesan.idtujuan WHERE username = '$username' Order By idpesan DESC";
$pesan      = query($dataPesan);
$checkPesan = "SELECT * FROM pesan JOIN penulis On penulis.id = pesan.idtujuan WHERE username = '$username' and checkList = 0";
$countPesan = count(query($checkPesan));
?>
<!-- Page Wrapper -->
<div id="wrapper">
	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
			<div class="sidebar-brand-icon rotate-n-15">
				<i class="fas fa-newspaper"></i>
			</div>
			<div class="sidebar-brand-text mx-3">Blog News</div>
		</a>
		<!-- Divider -->
		<hr class="sidebar-divider">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item">
			<a class="nav-link" href="../../">
				<i class="fas fa-newspaper fa-fw"></i>
				<span>Blog Home Berita</span></a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider">
			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="">
					<i class="fas fa-home fa-fw"></i>
					<span>My Dashboard</span></a>
				</li>
				<!-- Divider -->
				<hr class="sidebar-divider">
				<!-- Heading -->
				<div class="sidebar-heading">
					Management Panel
				</div>
				<!-- Nav Item - Pages Collapse Menu -->
				<?php foreach ($query as $row): ?>
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-cog"></i>
						<span>Account Set</span>
					</a>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Account Set</h6>
							<a class="collapse-item" id="linkHapus" href="el?user_id=<?=$row['id'];?>">
							<i class="fas fa-fw fa-trash-alt"></i> Delete My Profile</a>
							<a class="collapse-item" href="../profile/il?see=<?=$row['id']?>">
							<i class="fas fa-fw fa-edit"></i> Edit My Profile</a>
							<a class="collapse-item" href="../logout" data-toggle="modal" data-target="#logoutModal">
							<i class="fas fa-fw fa-sign-out-alt"></i> log out </a>
						</div>
					</div>
				</li>
				<!-- Nav Item - Utilities Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
						<i class="fas fa-fw fa-chart-bar"></i>
						<span>Berita Saya</span>
					</a>
					<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header"> Berita Saya : </h6>
							<a class="collapse-item" href="../berita/upload"> <i class="fas fa-fw fa-upload"></i>
							Upload Berita Baru</a>
							<a class="collapse-item" href="#myberita"> <i class="fas fa-fw fa-globe"></i>
							Berita Saya</a>
						</div>
					</div>
				</li>
				<!-- Nav Item - Utilities Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#games" aria-expanded="true" aria-controls="games">
						<i class="fas fa-gamepad fa-fw"></i>
						<span>Games Sederhana</span>
					</a>
					<div id="games" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header"> All Games : </h6>
							<a class="collapse-item" href="" id="gamejawa">
							<i class="fas fa-hand-peace fa-fw"></i> Suwit Jawa </a>
							<a class="collapse-item" href="" id="tebakAngka">
							<i class="fas fa-dice fa-fw"></i> Game Tebak Angka </a>
						</div>
					</div>
				</li>
				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">
				<!-- Sidebar Toggler (Sidebar) -->
				<div class="text-center d-none d-md-inline">
					<button class="rounded-circle border-0" id="sidebarToggle"></button>
				</div>
			</ul>
			<!-- End of Sidebar -->
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
							<!-- Nav Item - Alerts -->
							<li class="nav-item dropdown no-arrow mx-1">
								<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-bell fa-fw"></i>
									<!-- Counter - Alerts -->
									<?php if ($countCheck > 0): ?>
									<span class="badge badge-danger badge-counter"><?=$countCheck?></span>
									<?php else: ?>
									<span class="badge badge-danger badge-counter"></span>
									<?php endif?>
								</a>
								<!-- Dropdown - Alerts -->
								<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
									<h6 class="dropdown-header">
									Commentar Notif
									</h6>
									<?php foreach ($listCommentar as $list): ?>
									<?php if ($list['ditanggapi'] == "1"): ?>
									<!-- Tidak Usah Ditampilkan Apapun -->
									<?php elseif ($list['ditanggapi'] == "0"): ?>
									<a class="dropdown-item d-flex align-items-center" href="reply?public=<?=$list['Name']?>&id=<?=$list['comKey']?>">
										<div class="mr-3">
											<div class="icon-circle bg-primary">
												<i class="fas fa-users text-white"></i>
											</div>
										</div>
										<div>
											<div class="small text-gray-500"><?=$list['write']?></div>
											<span class="font-weight-bold"><?=substr(stripslashes($list['Comments']), 0, 25)?>......</span>
										</div>
									</a>
									<?php endif;?>
									<?php endforeach?>
									<!-- <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a> -->
								</div>
							</li>
							<!-- Nav Item - Messages -->
							<li class="nav-item dropdown no-arrow mx-1">
								<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-envelope fa-fw"></i>
									<!-- Counter - Messages -->
									<?php if ($countPesan > 0): ?>
									<span class="badge badge-danger badge-counter">
										<?=$countPesan;?>
									</span>
									<?php else: ?>
									<span class="badge badge-danger badge-counter"></span>
									<?php endif?>
								</a>
								<!-- Dropdown - Messages -->
								<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
									<h6 class="dropdown-header">
									Message Center
									</h6>
									<?php foreach ($pesan as $psn): ?>
									<?php if ($psn['checkList'] == '0'): ?>
									<a class="dropdown-item d-flex align-items-center" href="#">
										<div class="dropdown-list-image mr-3">
											<img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
											<!-- <div class="status-indicator bg-success"></div> -->
										</div>
										<div class="font-weight-bold">
											<div class="text-truncate"><?=$psn['pesan']?></div>
											<div class="small text-gray-500"><?=$psn['pengirim']?> · <?=$psn['tglkirim']?></div>
										</div>
									</a>
									<?php else: ?>
									<!-- bersih -->
									<?php endif?>
									<?php endforeach?>
									<!--  <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a> -->
								</div>
							</li>
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
							<h1 class="h2 mb-0 text-gray-800">My Dasboard</h1>
							<p class="text-primary small"><?=$row['full_name']?></p>
						</div>
						<?php endforeach;?>
						<div class="row">
							<!-- Earnings (Monthly) Card Example -->
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card border-left-primary shadow h-100 py-2">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Banyak Berita Yg Saya Upload</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800">
													<?=$berita;?> Terupload
												</div>
											</div>
											<div class="col-auto">
												<i class="fas fa-fw fa-newspaper fa-2x text-gray-300"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card border-left-danger shadow h-100 py-2">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Public Yg Mengomentari Berita Saya</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800">
													<?=$commentarPublic;?> Orang Komentar
												</div>
											</div>
											<div class="col-auto">
												<i class="fas fa-fw fa-user fa-2x text-gray-300"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Card Berita -->
						<div id="myberita"></div>
						<div class="card border-left-success shadow h-100 py-2">
							<div class="card-body">
								<h5 class="h5 text-gray-800">
								<i class="fas fa-fw fa-list"></i> List Berita Saya
								</h5>
								<hr class="bg-primary">
								<div class="row mb-4 mt-2">
									<div class="col-md">
										<form class="form-group" action="" method="post">
											<div class="input-group">
												<input type="text" class="form-control bg-gray-200 small text-primary" placeholder="Cari Berita Anda" aria-label="Search" aria-describedby="basic-addon2" name="search" autocomplete="off" id="keyword" >
												<div class="input-group-append">
													<button class="btn btn-info" type="submit" name="cari" id="tombol-cari">
													<i class="fas fa-search fa-sm fa-fw"></i>
													</button>
												</div>
											</div>
										</form>
									</div>
									<div class="col-md-4">
										<a href="../berita/upload" class="btn btn-primary btn-block"> <i class="fas fa-upload"></i> Upload Berita</a>
									</div>
								</div>
								<?php if (isset($error404)): ?>
								<?='<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> 404 Berita Anda Tidak Ditemukan</div>';?>
								<?php elseif (isset($ok200)): ?>
								<?='<div class="alert alert-success"> Berita Anda Telah Ditemukan</div>';?>
								<?php endif;?>
								<table cellpadding="8" cellspacing="8" class="table table-responsive table-hover">
									<thead>
										<tr class="table-success text-gray-800 ">
											<th>#</th>
											<th>JudulBerita</th>
											<th>RingkasanBerita</th>
											<th>TglUpload</th>
											<th>JamUpload</th>
											<th>Gambar</th>
											<th>Edit</th>
											<th>SitusBeritaSaya</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1?>
										<?php foreach ($beritaUser as $brtUser): ?>
										<tr>
											<td><?=$i++?></td>
											<td><?=$brtUser['judul']?></td>
											<td><?=$brtUser['berita']?></td>
											<td><?=$brtUser['tglberita']?></td>
											<td><?=$brtUser['jamberita']?></td>
											<td>
												<img src="../../img/news-icon/<?=$brtUser['gambar']?>" class="img-fluid img-thumbnail">
											</td>
											<td>
												<a href="it?mod=<?=$brtUser['idberita']?>" class="btn  btn-outline-warning btn-circle" id="editberita"><i class="fas fa-fw fa-pencil-alt"></i></a>
											</td>
											<td>
												<a href="../../view?mod=<?=$brtUser['idberita']?>" class="btn btn-link btn-block"><i class="fas fa-link fa-fw"></i> Link</a>
											</td>
										</tr>
										<?php endforeach;?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- Akhir List Berita -->
						<!-- List Commentar -->
						<div class="card border-left-dark shadow h-100 py-2 my-4">
							<div class="card-body">
								<h5 class="h5 text-gray-800 mb-2">
								<i class="fas fa-fw fa-list"></i> List Comentar Public</h5>
								<hr class="bg-primary">
								<?php if (isset($confirm)): ?>
								<div class="alert alert-success">Berhasil Membalas Komentar Public</div>
								<?php endif;?>
								<table cellpadding="6" cellspacing="6" class="table table-responsive table-hover">
									<thead>
										<tr class="table-warning text-dark font-weight-bold">
											<th>#</th>
											<th>DefaultImg</th>
											<th>Pengkomentar</th>
											<th>Komentarnya</th>
											<th>ActionToPublicCom</th>
											<th>FeedBack</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;?>
										<?php foreach ($listCommentar as $list): ?>
										<tr>
											<td><?=$i++;?></td>
											<td><img width="50" src="../../img/<?=$list['img']?>" alt="Profile" class="img-fluid img-profile"></td>
											<td><?=$list['Name']?></td>
											<td><?=substr(stripslashes($list['Comments']), 0, 17)?></td>
											<td>
												<?php if ($list['ditanggapi'] == "1"): ?>
												<a href="reply?public=<?=$list['Name']?>&id=<?=$list['comKey']?>" class="btn btn-outline-dark btn-sm"> <i class="fas fa-paper-plane fa-fw"></i> Sending Again </a>
												<?php else: ?>
												<a href="reply?public=<?=$list['Name']?>&id=<?=$list['comKey']?>" class="btn btn-success btn-sm"> <i class="fas fa-paper-plane fa-fw"></i> Sending Reply </a>
												<?php endif?>
											</td>
											<td>
												<?php if ($list['ditanggapi'] == "1"): ?>
												<i class="fas fa-check-circle fa-fw text-primary"></i> Sudah
												<?php elseif ($list['ditanggapi'] == "0"): ?>
												<i class="fas fa-times fa-fw text-danger"></i> Belum
												<?php endif;?>
											</td>
										</tr>
										<?php endforeach;?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- Akhir Card List Commentar -->
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