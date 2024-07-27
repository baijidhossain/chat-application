<?php
session_start();
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'chat_box';

$APP_URL = 'http://192.168.1.113';

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$conn) {
  echo "Database successfully failed!";
  die();
}
