<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../error-session");
    exit;
}

require '../Function.php';

$id = $_GET['iBer'];

if (deleteBerita($id) > 0) {
    if (deleteComment($id) > 0) {
        # your Code will Be here
    }
    // echo "Berita Berhasil Dihapus";
    echo "<script>
    alert('Berita Berhasil Di Hapus');
    document.location.href = '../Admin';
    </script>";
} else {
    echo "<script>
		alert('Berita Gagal Di Hapus');
		document.location.href = '../Admin';
		</script>";
    echo mysqli_error($conn);
}

?>