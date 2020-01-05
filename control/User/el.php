<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../error-session");
    exit;
}

require '../Function.php';

$id = $_GET['user_id'];

// bila ada data yg dipilih
if (deleteUser($id) > 0) {
    echo "
    <script>
        alert('Data Berhasil Dihapus');
        document.location.href = '../logout';
    </script>
    ";
} else {

    echo "
	<script>
		alert('Data Gagal Dihapus');
		document.location.href = '';
	</script>";
    echo mysqli_error($conn);
}

// bila tidak ada data yg dipilih
// tampilkan ini
if (!isset($id)) {
    header("Location: error.html");
    exit;
}
?>


