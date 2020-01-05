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

if (like($_POST > 0)) {
    echo "<script>
    alert('Success Giving Like');
    document.location.href = '../../';
    </script>";
} else {
    echo "<script>
    alert('Failed Giving Like');
    document.location.href = '../../';
    </script>";
    // echo "Gagal";
    // var_dump($_POST);
    // echo mysqli_error($conn);
}

?>
