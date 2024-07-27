<?php
include("database.php");

if (empty($_SESSION['login'])) {
  header("Location: login.php");
  die();
}

$thread_id = $_POST['thread_id'];

$user_id = $_POST['user_id'];

$message = $_POST['message'];

$sql = "INSERT INTO `message`( `content`, `thread_id`, `sender_id`) VALUES ('" . $message . "','" . $thread_id . "','" . $user_id . "')";

$send_message =   mysqli_query($conn, $sql);

if ($send_message) {
  echo json_encode([
    "error" => 0,
    "message" => "success"
  ]);
} else {
  echo json_encode([
    "error" => 1,
    "message" => "Message send failed"
  ]);
}


echo $message;


// $messages = [];

// while ($row = mysqli_fetch_assoc($data)) {
//   $messages[] = $row;
// }

// $threads = json_encode($messages);

// echo  $threads;
