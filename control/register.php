<?php
require 'Function.php';
if (isset($_POST['daftar'])) {
    if (daftar($_POST) > 0) {
        echo mysqli_error($conn);
        $confirm = true;
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Regiter Akun</title>
		<!-- Bootstrap core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="../vendor/fontawesome-free/css/all.min.css">
		<!-- Custom styles for this template -->
		<link href="../css/blog-home.css" rel="stylesheet">
	</head>
	<body>
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a class="navbar-brand" href="#">
					<i class="fas fa-newspaper"></i> Blog Web News
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
					</ul>
				</div>
			</div>
		</nav>
		<!-- Page Content -->
		<div class="container">
			<h1 class="h3 text-primary h-100 mb-4 mt-3">
			<i class="fas fa-user-circle"></i>
			Pendaftaran Akun
			</h1>
			<?php if (isset($confirm)) {
    echo '<div class="alert alert-success">Berhasil Terdaftar Selamat <a href="../index" class="btn btn-link text-danger">Login Sekarang</a> </div>';
}?>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="full_name" class="form-control-label">Nama Lengkap</label>
					<input type="text" name="full_name" id="full_name" class="form-control" autocomplete="off" placeholder="Nama Lengkap Anda" required>
				</div>
				<div class="form-group">
					<label for="tgllahir" class="form-control-label">Tanggal Lahir</label>
					<input type="date" name="tgllahir" id="tgllahir" class="form-control" autocomplete="off" placeholder="Tanggal Lahir" required>
				</div>
				<div class="form-group">
					<label for="jeniskelamin" class="form-control-label">Jenis Kelamin</label>
					<select class="form-control" id="jeniskelamin" name="jeniskelamin" required>
						<option value="Laki-Laki">Laki-Laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label for="alamat" class="form-control-label">Alamat</label>
					<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" placeholder="Masukkan Alamat Anda" required>
				</div>
				<div class="form-group">
					<label for="noHp" class="form-control-label">No. Hp</label>
					<input type="text" name="noHp" id="noHp" class="form-control" autocomplete="off" placeholder="Masukkan No Telp Anda" required>
				</div>
				<div class="form-group mb-3 mt-4">
					<span class="text-dark">Pilih Profil Akun</span>
					<div class="custom-file mt-2">
						<input type="file" name="gambar" class="custom-file-input" id="gambar" required>
						<label for="gambar" class="custom-file-label">Choose File</label>
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="form-control-label">Username</label>
					<input type="text" name="username" id="username" class="form-control" autocomplete="off" placeholder="Buat Username Akun Anda" required>
				</div>
				<div class="form-group">
					<label for="email" class="form-control-label">Email</label>
					<input type="email" name="email" id="email" class="form-control" autocomplete="off" placeholder="Masukkan Email Aktif" required>
				</div>
				<div class="form-group">
					<label for="password" class="form-control-label">Password</label>
					<input type="password" name="password" id="password" class="form-control" autocomplete="off" placeholder="Password Anda ( min 8 huruf)" required>
				</div>
				<div class="form-group">
					<label for="password2" class="form-control-label">Konfirmasi Password</label>
					<input type="password" name="password2" id="password2" class="form-control" autocomplete="off" placeholder="Konfirmasi Password Anda" required>
				</div>
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3">
						<input type="checkbox" class="custom-control-input" id="agree" name="agree">
						<label class="custom-control-label" for="agree"> I Have Read and Agree With Your <a href="">Terms & Conditions</a> </label>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-lg-7">
						<button type="submit" name="daftar" class="btn btn-primary btn-block">
						Selesai Daftar
						</button>
					</div>
					<div class="form-group col-lg-5">
						<a href="../index" class="btn btn-outline-danger btn-block">Batalkan</a>
					</div>
				</div>
				<div class="form-group">
					<a href="../" class="btn btn-link btn-sm">Sudah Punya Akun ??? Login</a>
				</div>
			</form>
		</div>
		<!-- Footer -->
		<footer class="py-5 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">Copyright &copy; Your Website <?=date('Y')?></p>
			</div>
			<!-- /.container -->
		</footer>
		<!-- Bootstrap core JavaScript -->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script>
		$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
		});
		</script>
	</body>
</html>