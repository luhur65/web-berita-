<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../error-session");
    exit;
}
require '../Function.php';

$username = $_SESSION['login'];
$data     = "SELECT * FROM penulis INNER JOIN role ON role.id_role = penulis.user_role WHERE username = '$username'";
$query    = query($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Berita News">
  <meta name="author" content="Dharma Bakti Situmorang">
  <meta name="og:Berita Ngawur" property="og:Website Berita Ngawur" content="Website Berita">
  <meta name="robots" content="noindex , nofollow">
  <?php foreach ($query as $row): ?>
  <title> <?=$row['full_name']?> -Dashboard <?=$row['role']?> </title>
  <link rel="icon" type="image/icon" href="../../img/user-icon/<?=$row['icon']?>">
  <?php endforeach;?>
  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- My style -->
  <link href="../../css/style.css" rel="stylesheet">

</head>

<body id="page-top">