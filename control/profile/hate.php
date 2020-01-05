<?php

require '../Function.php';

// Jika Tidak Ada Id Author yang Di URL (Hacker)
if (!isset($_GET['mod'])) {
    echo "Access Denied";
    return false;
    if (empty($_GET['user'])) {
        echo "Access Denied";
        return false;
    }
} elseif (empty($_GET['mod'])) {
    echo "Access Denied";
    return false;
}

// Tangkap Data ID Author yg Di URL
$name = $_GET['mod'];
$user = $_GET['user'];

// var_dump($name);
// var_dump($user);

if (dislike($_POST)) {
    echo "<script>
    document.location.href = '../../';
    </script>";
} else {
    echo "<script>
    document.location.href = '../../';
    </script>";
}
?>