<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../error-session");
    exit;
}
require '../Function.php';

$id = $_GET['id'];

if (roleMember($_POST) > 0) {
    echo "<script>
		alert('Akun Berhasil Menjadi Member');
		document.location.href = '../Admin';
		</script>";
} else {
    echo "<script>
		alert('Gagal Mengganti Role Akun ');
		document.location.href = '../Admin';
		</script>";
    echo mysqli_error($conn);
}

?>