<?php

// Config Database
$hostname     = "localhost";
$username     = "root";
$password     = "";
$databasename = "web-berita";

// Connect Ke MySQLI
$conn = mysqli_connect($hostname, $username, $password, $databasename);

// function Query Database
function query($query) {

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// function registrasi
function daftar($data) {

    global $conn;

    $full_name    = htmlspecialchars(stripslashes($data['full_name']));
    $tgllahir     = htmlspecialchars(addslashes($data['tgllahir']));
    $jeniskelamin = htmlspecialchars(stripslashes($data['jeniskelamin']));
    $alamat       = htmlspecialchars(addslashes($data['alamat']));
    $noHp         = htmlspecialchars($data['noHp']);
    $username     = strtolower(stripslashes($data['username']));
    $email        = addslashes(strip_tags(stripslashes($data['email'])));
    $password     = mysqli_real_escape_string($conn, $data['password']);
    $password2    = mysqli_real_escape_string($conn, $data['password2']);
    $join         = date("Y-m-d");
    $active       = 1;
    $role         = 2;
    // bagian upload icon profil
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Cek Username Sudah Terdaftar Atau Tidak ???
    $result = mysqli_query($conn, "SELECT username FROM penulis WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo '<div class="row">
  <div class="col-sm-9 mx-auto">
  <div class="alert alert-danger mt-3 text-center">Failed Created !! Username Has Been Registered By Someone else ,Change it !</div>
</div>
</div>';

        return false;
    }

    // Cek Email sudah Terdaftar Atau Tidak ??
    $result2 = mysqli_query($conn, " SELECT email FROM penulis WHERE email = '$email'");

    if (mysqli_fetch_assoc($result2)) {
        echo '<div class="row">
  <div class="col-sm-9 mx-auto">
  <div class="alert alert-danger mt-3 text-center">Failed Created !! Email Has Been Registered By Someone else ,Change it !</div>
</div>
</div>';

        return false;
    }

    // Cek  Konfirmasi Password
    if ($password !== $password2) {
        echo '<div class="row">
  <div class="col-sm-9 mx-auto">
  <div class="alert alert-danger mt-3 text-center">Failed Created !! Password Did not Macth , Check it !</div>
</div>
</div>';

        return false;
    }

    // Enkrypsikan password
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    // menambahkan user ke database

    mysqli_query($conn, "INSERT INTO penulis VALUES (null,'$full_name','$tgllahir','$jeniskelamin','$alamat','$noHp','$gambar','$join','$active','$username','$email','$password','$role')");

    return mysqli_affected_rows($conn);
}

// function upload gambar user (Register User)
function upload() {

    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar diupload

    if ($error === 4) {
        echo "<script>
        alert('Gambar Belum Di Upload');
        </script>";

        return false;
    }

    // cek apakah gyg diupload adalah gambar

    $ekstensiGambarValid = ['png', 'jpg', 'jpeg', 'gif'];
    $ekstensiGambar      = explode('.', $namaFile);
    $ekstensiGambar      = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Anda Bukan Mengupload gambar');
        </script>";
    }
    // cek jika ukurannya besar

    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran Gambar Terlalu Besar');
        </script>";
    }

    // lolos pengecekan gambar siap di upload

    // generate nama baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/user-icon/' . $namaFileBaru);

    return $namaFileBaru;
}

// function upload gambar berita
function gambarBerita() {

    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar diupload

    if ($error === 4) {
        echo "<script>
        alert('Gambar Belum Di Upload');
        </script>";

        return false;
    }

    // cek apakah gyg diupload adalah gambar

    $ekstensiGambarValid = ['png', 'jpg', 'jpeg', 'gif'];
    $ekstensiGambar      = explode('.', $namaFile);
    $ekstensiGambar      = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Anda Bukan Mengupload gambar');
        </script>";
    }
    // cek jika ukurannya besar

    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran Gambar Terlalu Besar');
        </script>";
    }

    // lolos pengecekan gambar siap di upload

    // generate nama baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../../img/news-icon/' . $namaFileBaru);

    return $namaFileBaru;
}

// Function Hapus User Member
function deleteUser($id) {

    global $conn;

    $pilih      = mysqli_query($conn, "SELECT * FROM penulis WHERE id ='$id'");
    $result     = mysqli_fetch_assoc($pilih);
    $dataGambar = $result['icon'];
    unlink('../../img/user-icon/' . $dataGambar);

    mysqli_query($conn, "DELETE FROM penulis WHERE penulis.id = '$id'");

    return mysqli_affected_rows($conn);
}

// Ganti Role Akun Admin / Member (Ubah Data)
function roleAdmin($data) {

    global $conn;

    $id   = $_GET['id'];
    $role = 1;

    $query = "UPDATE penulis SET
                    user_role = '$role'
                WHERE id = $id
                    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function roleMember($data) {

    global $conn;

    $id   = $_GET['id'];
    $role = 2;

    $query = "UPDATE penulis SET
                    user_role = '$role'
                WHERE id = $id
                    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Aktivasi / Blokir Akun (Ubah Data)
function Aktivasi($data) {

    global $conn;

    $id        = $_GET['id'];
    $is_active = 1;

    $query = "UPDATE penulis SET
                    is_active = '$is_active'
                WHERE id = $id
                    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function Blokir($data) {

    global $conn;

    $id        = $_GET['id'];
    $is_active = 0;

    $query = "UPDATE penulis SET
                    is_active = '$is_active'
                WHERE id = $id
                    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function Upload Berita
function uploadBerita($data) {

    global $conn;

    $judulBerita   = htmlspecialchars($data['judul']);
    $ringkasBerita = htmlspecialchars($data['ringkas']);
    $isiBerita     = htmlspecialchars($data['isi']);
    $tglBerita     = date("Y-m-d");
    $jamBerita     = date("h:i:s");
    $penulis       = $data['penulis'];

// bagian upload icon berita
    $gambar = gambarBerita();
    if (!$gambar) {
        return false;
    }

// Input Berita Ke Database
    $query = "INSERT INTO tb_news
                    VALUES
                    (null,'$judulBerita','$ringkasBerita','$tglBerita','$jamBerita','$penulis','$gambar','$isiBerita')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function Edit My Berita
function EditBerita($data) {

    global $conn;

    $id         = $data['id'];
    $penulis    = $data['penulis'];
    $judul      = htmlspecialchars($data['judul']);
    $subBerita  = htmlspecialchars($data['ringkas']);
    $isiBerita  = htmlspecialchars($data['isi']);
    $tglBerita  = date("Y-m-d");
    $jamBerita  = date("h:i:s");
    $gambarLama = htmlspecialchars($data['gambarLama']);

    global $gambar;
    // upload gmbr
    if ($_FILES['gambar'] === 4) {
        $gambar === $gambarLama;
    } else {
        $gambar = gambarBerita();
    }

    $query = "UPDATE tb_news SET
                    judul = '$judul',
                    berita = '$subBerita',
                    tglberita = '$tglBerita',
                    jamberita = '$jamBerita',
                    penulis = '$penulis',
                    gambar = '$gambar',
                    isi_lengkap = '$isiBerita'
                WHERE idberita = '$id' ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function Hapus Index Berita
function deleteBerita($id) {

    global $conn;

    $pilih      = mysqli_query($conn, "SELECT * FROM tb_news WHERE idberita ='$id'");
    $result     = mysqli_fetch_assoc($pilih);
    $dataGambar = $result['gambar'];
    unlink('../../img/news-icon/' . $dataGambar);

    mysqli_query($conn, "DELETE FROM tb_news WHERE tb_news.idberita = '$id'");

    return mysqli_affected_rows($conn);
}

// Function Edit Berita
function deleteComment($id) {

    global $conn;

    mysqli_query($conn, "DELETE FROM comment WHERE comment.berita = '$id'");

    return mysqli_affected_rows($conn);
}

// Function Input Comment
function Comment($data) {

    global $conn;

    $berita     = $_GET['mod'];
    $nama       = htmlspecialchars($data['nama']);
    $comment    = htmlspecialchars($data['comment']);
    $tgl        = date("Y-m-d");
    $ditanggapi = 0;
    $img        = 'comenters.png';

    // menambahkan Komentar Public ke database

    mysqli_query($conn, "INSERT INTO `comment`(`comKey`, `Name`, `Comments`, `write`, `berita`, `ditanggapi`, `img`) VALUES ('null','$nama','$comment','$tgl','$berita','$ditanggapi','$img')");

    return mysqli_affected_rows($conn);
}

// Function Sudah Ditanggapi Belum
function Done($data) {
    global $conn;

    $id         = $_GET['id'];
    $ditanggapi = 1;

    $query = "UPDATE comment SET
                    ditanggapi = '$ditanggapi'
                WHERE comKey = $id
                    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function Input Comment
function balasComment($data) {

    global $conn;

    $berita   = $data['IDberita'];
    $comentar = $data['idcomentar'];
    $pengirim = htmlspecialchars($data['pengirim']);
    $penerima = htmlspecialchars($data['penerima']);
    $comment  = htmlspecialchars($data['textarea']);
    $tgl      = date("Y-m-d");

    // menambahkan Komentar Public ke database

    mysqli_query($conn, "INSERT INTO reply_send VALUES (null,'$pengirim' ,'$penerima' , '$comment','$tgl','$comentar','$berita')");

    return mysqli_affected_rows($conn);
}

// function upload gambar user
function editImg() {

    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar diupload

    if ($error === 4) {
        echo "<script>
        alert('Gambar Belum Di Upload');
        </script>";

        return false;
    }

    // cek apakah gyg diupload adalah gambar

    $ekstensiGambarValid = ['png', 'jpg', 'jpeg', 'gif'];
    $ekstensiGambar      = explode('.', $namaFile);
    $ekstensiGambar      = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Anda Bukan Mengupload gambar');
        </script>";
    }
    // cek jika ukurannya besar

    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran Gambar Terlalu Besar');
        </script>";
    }

    // lolos pengecekan gambar siap di upload

    // generate nama baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../../img/user-icon/' . $namaFileBaru);

    return $namaFileBaru;
}

function editProfile($data) {

    global $conn;

    $full_name    = htmlspecialchars(stripslashes($data['full_name']));
    $tgllahir     = htmlspecialchars(addslashes($data['tgllahir']));
    $jeniskelamin = htmlspecialchars(stripslashes($data['jenis_gender']));
    $alamat       = htmlspecialchars(addslashes($data['alamat']));
    $noHp         = htmlspecialchars($data['hp']);
    $username     = strtolower(stripslashes($data['username']));
    $email        = addslashes(strip_tags(stripslashes($data['email'])));
    //$password     = mysqli_real_escape_string($conn, $data['password']);
    //$password2    = mysqli_real_escape_string($conn, $data['password2']);
    $active = $data['is_active'];
    $role   = $data['user_role'];
    $id     = $data['id'];
    // bagian upload icon profil
    global $gambar;
    // upload gmbr
    if ($_FILES['gambar'] === 4) {
        $gambar === $gambarLama;
    } else {
        $gambar = editImg();
    }

    $query = "UPDATE penulis SET
                    full_name = '$full_name',
                    tgllahir = '$tgllahir',
                    jenis_gender = '$jeniskelamin',
                    alamat = '$alamat',
                    hp = '$noHp',
                    icon = '$gambar',
                    is_active = '$active',
                    username = '$username',
                    email = '$email',
                    user_role = '$role'
                WHERE id = '$id' ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function Pencarian Data Berita (PHP)
function cariBerita($search) {

    $dataBerita = "SELECT * FROM tb_news INNER JOIN penulis on tb_news.penulis  = penulis.id WHERE  judul LIKE '%$search%' OR
                  berita LIKE '%$search%' OR
                  full_name LIKE '%$search%' OR
                  isi_lengkap LIKE '%$search%' ";

    return query($dataBerita);
}

// Like & Dislike
function like($data) {

    global $conn;

    $name = $_GET['mod'];
    $id   = $_GET['user'];
    $like = 1;

    $query = "INSERT INTO support VALUES (null,'$id','$like')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function dislike($data) {

    global $conn;

    $name = $_GET['mod'];
    $id   = $_GET['user'];
    $hate = 1;

    $query = "INSERT INTO hate VALUES (null,'$id','$hate')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function Input Comment
function Message($data) {

    global $conn;

    $idtujuan = $data['idtujuan'];
    $nama     = htmlspecialchars($data['name']);
    $pesan    = htmlspecialchars($data['pesan']);
    $tgl      = date("Y-m-d");
    $check    = 0;

    // menambahkan Komentar Public ke database

    mysqli_query($conn, "INSERT INTO `pesan`(`idpesan`, `pengirim`, `idtujuan`, `pesan`, `tglkirim`, `checkList`) VALUES (null,'$nama','$idtujuan','$pesan','$tgl','$check')");

    return mysqli_affected_rows($conn);
}

?>
