<?php



if (!empty($_SESSION['login'])) {
  unset($_SESSION['login']);
}

session_destroy();

header("Location: login.php");

die();
