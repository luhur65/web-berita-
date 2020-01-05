<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../error-session");
    exit;
}
require '../Function.php';

$id = $_GET['id'];

if (deleteUser($id) > 0) {
    echo "<script>
		alert('User Berhasil Di Hapus');
		document.location.href = '../Admin';
		</script>";
} else {
    echo "<script>
		alert('User Gagal Di Hapus');
		document.location.href = '../Admin';
		</script>";
    echo mysqli_error($conn);
}

?>