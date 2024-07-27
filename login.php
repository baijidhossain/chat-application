<?php

include("database.php");

if ($_SERVER['REQUEST_METHOD']) {

  if ($_SERVER['REQUEST_METHOD'] === "POST") {


    $email = $_POST['email'] ?? "";

    $password = $_POST['password'] ?? "";

    if (empty($email) || empty($password)) {

      $_SESSION['error_message'] = "Fill all the required field";
    }

    // $password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "SELECT * FROM users WHERE email = '" . $email . "' AND `password` = '" . $password . "' LIMIT 1 ";

    $data =   mysqli_query($conn, $sql);

    echo $data->num_rows;

    if ($data->num_rows > 0) {

      $_SESSION['login'] = 1;

      while ($row = mysqli_fetch_assoc($data)) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_image'] = $row['image'];
      }

      header("Location: index.php");
    }

    echo '<div class="bg-danger text-white">User not available</div>';
  }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>User Login</title>

  <link rel="stylesheet" href="bootstrap.min.css">

  <style>
    .form-control:focus {
      border-color: #86b7fe;
      outline: 0;
      box-shadow: 0 0 0 0 rgba(13, 110, 253, .25);
    }
  </style>
</head>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h2 class="text-center">User Login</h2>
          </div>

          <div class="card-body">
            <form action="" method="post">

              <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control">
              </div>
              <div class="form-group mb-3">
                <label for="password"> Password </label>
                <input type="text" id="password" name="password" class="form-control">
              </div>

              <button type="submit" class="btn btn-info">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>