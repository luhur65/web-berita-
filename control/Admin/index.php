<?php require '../tmp/header.php';?>
<?php
// Penghitungan Seluruh Data Yg Masuk Ke Database (RealTIme)
$userRegister = count(query("SELECT * FROM penulis"));
$beritaUpload = count(query("SELECT * FROM tb_news"));
$uploader     = count(query("SELECT penulis FROM tb_news INNER JOIN penulis on tb_news.penulis  = penulis.id WHERE user_role = 2"));
$comment      = count(query("SELECT * FROM comment"));
// cek role akun login
foreach ($query as $row) {
    if ($row['role'] == "user") {
        header("Location: ../User/");
        exit;
    }
}
// Index Berita View
$viewBerita = query("SELECT * FROM tb_news INNER JOIN penulis on tb_news.penulis  = penulis.id");
// user register view
$user_list = query("SELECT * FROM penulis INNER JOIN role on penulis.user_role = role.id_role WHERE user_role = 2");
$userRole  = query("SELECT * FROM penulis INNER JOIN role on penulis.user_role = role.id_role");
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
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="#">
        <i class="fas fa-fw fa-code"></i>
        <span>Dashboard Admin</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        cPanel
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Account Config</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Account Set</h6>
            <a class="collapse-item" href="#profile">
            <i class="fas fa-fw fa-user-alt"></i> My Profile</a>
            <a class="collapse-item" href="">
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
          <span>Data Goals</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">My Goals & Charts : </h6>
            <a class="collapse-item" href="">Account Sign in</a>
            <a class="collapse-item" href="">News Uploaded</a>
            <a class="collapse-item" href="">CRUD</a>
            <a class="collapse-item" href="../User">User Page</a>
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
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h2 mb-0 text-gray-800">
            Dashboard
            </h1>
            <?php endforeach;?>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Akun Yg Mendaftar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?=$userRegister?> Terdaftar
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Berita Yg Diupload</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?=$beritaUpload;?> Terupload
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-upload fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-12 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Public Comments</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?=$comment;?> Commenters <br>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Content Row -->
          <!-- Content Table Berita -->
          <!-- Heading Table -->
          <div class="card shadow h-100 py-2 my-4">
            <div class="card-body">
              <h5 class="h5 mb-3 text-dark">
              <i class="fas fa-list fa-fw"></i>  List Uploaded News</h5>
              <hr class="bg-primary">
              <div class="mb-3">
                <a href="../berita/upload" class="btn btn-primary">
                  <i class="fas fa-fw fa-plus"></i> Buat Berita Baru
                </a>
              </div>
              <table class="table table-responsive table-hover">
                <thead>
                  <tr class="table-warning text-dark font-weight-bold">
                    <th>#</th>
                    <th>JudulBerita</th>
                    <th>TglDiupload</th>
                    <th>JamDiupload</th>
                    <th>Pengupload</th>
                    <th>GambarBerita</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1?>
                  <?php foreach ($viewBerita as $brt): ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?=$brt['judul']?></td>
                    <td><?=$brt['tglberita']?></td>
                    <td><?=$brt['jamberita']?></td>
                    <td><?=$brt['full_name']?></td>
                    <td>
                      <img src="../../img/news-icon/<?=$brt['gambar']?>" alt="Source Berita Image" class="img-fluid rounded">
                    </td>
                    <td>
                      <a href="deler?iBer=<?=$brt['idberita']?>" class="btn btn-danger btn-circle">
                        <i class="fas fa-fw fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Content Table User -->
          <!-- Content Table Berita -->
          <!-- Heading Table -->
          <div class="card shadow h-100 py-2 my-4">
            <div class="card-body">
              <h5 class="h5 mb-3 text-dark">
              <i class="fas fa-list fa-fw"></i>
              List Akun Member
              </h5>
              <hr class="bg-primary">
              <table class="table table-responsive table-hover" cellspacing="10">
                <thead>
                  <tr class="table-warning text-dark">
                    <th>#</th>
                    <th>Username</th>
                    <th>NamaUser</th>
                    <th>TanggalLahir</th>
                    <th>JenisKelamin</th>
                    <th>Alamat</th>
                    <th>No.hp</th>
                    <th>Email</th>
                    <th>Join</th>
                    <th>Status</th>
                    <th>Profile</th>
                    <th>ControlStatus</th>
                    <th>DeleteAccount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1?>
                  <?php foreach ($user_list as $usr): ?>
                  <tr>
                    <td><?=$i++;?></td>
                    <td><?=$usr['username'];?></td>
                    <td><?=$usr['full_name'];?></td>
                    <td><?=$usr['tgllahir'];?></td>
                    <td><?=$usr['jenis_gender'];?></td>
                    <td><?=$usr['alamat'];?></td>
                    <td><?=$usr['hp'];?></td>
                    <td><?=$usr['email'];?></td>
                    <td><?=$usr['join'];?></td>
                    <td>
                      <?php if ($usr['is_active'] > "0") {
    echo '<span class="badge badge-success">Active</span>';
} else if ($usr['is_active'] < "1") {
    echo '<span class="badge badge-danger">Banned</span>';
}?>
                    </td>
                    <td>
                      <img src="../../img/user-icon/<?=$usr['icon'];?>" alt="Profile" class="img-fluid img-profile rounded">
                    </td>
                    <td>
                      <?php if ($usr['is_active'] > "0"): ?>
                      <a href="blokir?id=<?=$usr['id'];?>" class="btn btn-danger btn-sm btn-block rounded">Block Akun</a>
                      <?php else: ?>
                      <a href="aktif?id=<?=$usr['id'];?>" class="btn btn-primary btn-block btn-sm rounded" name="aktifkan">Aktifkan</a>
                      <?php endif?>
                    </td>
                    <td rowspan="3">
                      <a href="clean?id=<?=$usr['id'];?>" class="btn btn-danger rounded" title="Hapus Akun Ini">
                        <i class="fas fa-fw fa-trash-alt"></i> Delete
                      </a>
                    </td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card shadow h-100 py-2 my-4">
            <div class="card-body">
              <h5 class="h5 text-dark">
              <i class="fas fa-cog"></i>
              Role Access Account
              </h5>
              <hr class="bg-primary">
              <table class="table table-responsive table-hover">
                <thead>
                  <tr class="table table-warning">
                    <th>#</th>
                    <th>UsernameAkun</th>
                    <th>RoleAkun</th>
                    <th colspan="4">GantiRole</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1?>
                  <?php foreach ($userRole as $role): ?>
                  <?php if ($role['user_role'] == '1'): ?>
                  <!-- Role Admin Tidak Bisa Diubah -->
                  <?php else: ?>
                  <tr>
                    <td><?=$i++?></td>
                    <td><?=$role['username']?></td>
                    <td>
                      <?php if ($role['role'] == "admin") {
    echo '<span class="badge badge-primary">Administrator</span>';
} else if ($role['role'] == "user") {
    echo '<span class="badge badge-danger">Member Web</span>';
}?>
                    </td>
                    <td>
                      <?php if ($role['role'] == 'user'): ?>
                      <a href="ad?id=<?=$role['id']?>" class="btn btn-primary btn-block btn-sm" id='roleAdmin'>Admin</a>
                      <?php else: ?>
                      <a href="mem?id=<?=$role['id']?>" class="btn btn-danger btn-block btn-sm" id='roleMember'>Member</a>
                      <?php endif?>
                    </td>
                  </tr>
                  <?php endif?>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Blog News Made With <i class="fas fa-fw fa-heart text-danger"></i> By <a href="https://instagram.com/dharma_situmorang" target="_blank">Dharma Situmorang</a> <?=date('Y')?></span>
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