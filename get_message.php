<?php
include("database.php");

if (empty($_SESSION['login'])) {
  header("Location: login.php");
  die();
}

$receiver_id = $_POST['receiver_id'];

$sql = "SELECT 
    m.message,
    m.sender_id,
    m.receiver_id,
    sender_u.image AS sender_image,
    sender_u.name AS sender_name,
    receiver_u.image AS receiver_image,
    receiver_u.name AS receiver_name
FROM 
    messages m
JOIN 
    users AS sender_u ON m.sender_id = sender_u.id
LEFT JOIN 
    users AS receiver_u ON m.receiver_id = receiver_u.id
WHERE 
    (m.sender_id = '".$receiver_id."' OR m.receiver_id = '".$receiver_id."')
    AND m.group_id IS NULL
ORDER BY 
    m.created_at ASC;
";

$data =   mysqli_query($conn, $sql);

$messages = [];

while ($row = mysqli_fetch_assoc($data)) {
  $messages[] = $row;
}

$threads = json_encode($messages);

echo  $threads;
