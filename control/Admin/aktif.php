<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../error-session");
    exit;
}
require '../Function.php';

$id = $_GET['id'];

if (Aktivasi($_POST) > 0) {
    echo "<script>
		alert('Berhasil Di Aktivasikan');
		document.location.href = '../Admin';
		</script>";
} else {
    echo "<script>
		alert('Gagal Di Aktifkan');
		document.location.href = '../Admin';
		</script>";
    echo mysqli_error($conn);
}

?>