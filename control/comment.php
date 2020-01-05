<?php

$id = $_GET['mod'];

if (isset($_POST['send'])) {
    if (Comment($_POST) > 0) {
        echo mysqli_error($conn);
        $confirm = true;
    } else {
        echo "Gagal Mengirim Komentar Anda";
        echo mysqli_error($conn);
    }
}
?>