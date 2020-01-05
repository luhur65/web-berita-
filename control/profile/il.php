<?php
require '../tmp/header.php';

if (isset($_POST['edit'])) {
    if (editProfile($_POST) > 0) {
        $editSuccess = true;
    } else {
        $editFailed = true;
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
			<h4 class="h3 text-primary"></h4>
			<!-- Topbar Navbar -->
			<ul class="navbar-nav ml-auto">
				<div class="topbar-divider d-none d-sm-block"></div>
				<!-- Nav Item - User Information -->
				<li class="nav-item dropdown no-arrow">
					<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php foreach ($query as $row): ?>
						<span class="mr-2 d-lg-inline text-gray-600 small">
							<?=$row['full_name'];?>
						</span>
						<img class="img-profile rounded-circle" src="../../img/user-icon/<?=$row['icon']?>">
					</a>
					<!-- Dropdown - User Information -->
					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="../profile/il?see=<?=$row['id']?>" id="profile">
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
		<!-- Page Content -->
		<?php if (isset($editFailed)) {
    echo '<div class="alert alert-danger">Data Akun Anda GAGAL Di Update !!</div>';
}
if (isset($editSuccess)) {
    echo '<div class="alert alert-success">Akun Berhasil Di Update !! . Silakan Logout dan Login Kembali Untuk Melihat Hasilnya. ...<a href="../logout" class="btn btn-link">Log Out Disini</a> </div>';
}?>
		<div class="row">
			<div class="col-lg-6 mx-3">
				<h3 class="h3 text-primary">My Profile</h3>
				<hr class="bg-primary">
				<div class="row">
					<div class="col-sm">
						<img src="../../img/user-icon/<?=$row['icon']?>" class="img-profile rounded img-fluid" >
					</div>
				</div>
				<div class="row">
					<div class="col-sm mt-3 mb-5">
						<table cellpadding="7" cellspacing="10">
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
								<td> <i class="fas fa-fw fa-user-circle"></i> Username Akun</td>
								<td>: <span class="font-weight-bold text-gray-800"><?=$row['username']?></span></td>
							</tr>
							<tr>
								<td><i class="fas fa-fw fa-cog"></i> Status Akun</td>
								<td>: <?php if ($row['is_active'] > "0") {
    echo '<span class="btn btn-primary btn-sm">Active</span>';
} else if ($row['is_active'] < "1") {
    echo '<span class="btn btn-danger btn-sm">Blocked</span>';
}?></td>
							</tr>
							<tr>
								<td> <i class="fas fa-fw fa-phone"></i> No.Handphone</td>
								<td>: <span class="font-weight-bold text-gray-800">+62 <?=substr($row['hp'], 1)?></span></td>
							</tr>
							<tr>
								<td> <i class="fas fa-fw fa-user-shield"></i> Tipe Akun</td>
								<td>: <?php if ($row['role'] == "admin") {
    echo '<span class="btn btn-primary"><i class="fas fa-fw fa-star"></i> Administrator</span>';
} else if ($row['role'] == "user") {
    echo '<span class="btn btn-danger"><i class="fas fa-fw fa-users"></i> Member Web</span>';
}?></td>
							</tr>
							<tr>
								<td colspan="8">
									<?php if ($row['user_role'] == "2") {
    echo '<a href="../User" class="btn btn-outline-danger btn-block">Kembali Ke Dashboard Anda</a>';
} else if ($row['user_role'] == "1") {
    echo '<a href="../Admin" class="btn btn-outline-danger btn-block">Kembali Ke Dashboard Admin</a>';
}
?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-lg mx-3">
				<h2 class="h3 text-primary">Edit My Profile</h2>
				<hr class="bg-primary">
				<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?=$row['id']?>">
					<input type="hidden" name="is_active" value="<?=$row['is_active']?>">
					<input type="hidden" name="user_role" value="<?=$row['user_role']?>">
					<div class="form-group">
						<label for="full_name" class="form-control-label">Nama Lengkap</label>
						<input type="text" name="full_name" autocomplete="off" value="<?=$row['full_name']?>" class="form-control"  id="full_name" required>
					</div>
					<div class="form-group">
						<label for="tgllahir" class="form-control-label">Tanggal Lahir</label>
						<input type="date" name="tgllahir" autocomplete="off" value="<?=$row['tgllahir']?>" class="form-control"  id="tgllahir" required>
					</div>
					<div class="form-group">
						<label for="jenis_gender" class="form-control-label">Jenis Kelamin</label>
						<input type="text" name="jenis_gender" autocomplete="off" value="<?=$row['jenis_gender']?>" class="form-control"  id="jenis_gender" required>
					</div>
					<div class="form-group">
						<label for="alamat" class="form-control-label">Alamat</label>
						<input type="text" name="alamat" autocomplete="off" value="<?=$row['alamat']?>" class="form-control"  id="alamat" required>
					</div>
					<div class="form-group">
						<label for="hp" class="form-control-label">No.Handphone</label>
						<input type="text" name="hp" autocomplete="off" value="<?=$row['hp']?>" class="form-control"  id="hp" required>
					</div>
					<div class="form-group">
						<label for="email" class="form-control-label">Email Akun</label>
						<input type="text" name="email" autocomplete="off" value="<?=$row['email']?>" class="form-control"  id="email" required>
					</div>
					<div class="form-group">
						<label for="username" class="form-control-label">Username</label>
						<input type="text" name="username" autocomplete="off" value="<?=$row['username']?>" class="form-control"  id="username" readonly>
					</div>
					<div class="form-group">
						<span class="text-dark">Profil Picture</span> <br>
						<img width="120" src="../../img/user-icon/<?=$row['icon']?>" class="img-fluid img-profile rounded mb-3">
						<div class="custom-file mt-2">
							<input type="file" name="gambar" class="custom-file-input" id="gambar" required>
							<label for="gambar" class="custom-file-label">
								Pilih Gambar Untuk Profil Anda
							</label>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" name="edit" class="btn btn-success btn-block">
							Save Changes
						</button>
					</div>
					<div class="form-group">
					<?php if ($row['user_role'] == "2") {
    echo '<a href="../User" class="btn btn-outline-danger btn-block">Kembali Ke Dashboard Anda</a>';
} else if ($row['user_role'] == "1") {
    echo '<a href="../Admin" class="btn btn-outline-danger btn-block">Kembali Ke Dashboard Admin</a>';
}
?>
					</div>
				</form>
			</div>
		</div>
		<?php endforeach;?>
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