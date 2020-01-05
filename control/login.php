<?php

session_start();

require 'control/Function.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM penulis WHERE penulis.username = '$username'");

// cek username
    if (mysqli_num_rows($query) === 1) {
        // cek passwordnya
        $row = mysqli_fetch_assoc($query);
        // Cek Apakah Akun aktif Atau belum ?
        if ($row['is_active'] < "1") {
            $cekRole = true;

            return false;
        }

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = $username;
            // cek role akun
            if ($row['user_role'] == "1") {
                $_SESSION['login'] = $username;

                header("Location: control/Admin");
                exit;
            } else {
                ($row['user_role'] == "2");
                $_SESSION['login'] = $username;

                header("Location: control/User");
                exit;
            }
        }
    }

    $error = true;
    echo mysqli_error($conn);
}

?>
