<?php
include __DIR__ . '/../config.php';
if (!session_id()) session_start();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

include __DIR__ . '/../auth.php';
requireAdmin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin pannal </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <a class="btn btn-primary" href="/intern_app/Users/user_add.php" role="button">add user</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">opration</th>
    </tr>
</thead>
<?php
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>" . ($row['id']) . "</td>
                <td>" . ($row['name']) . "</td>
                <td>" . ($row['email']) . "</td>
                <td><a href='/intern_app/Users/user_delete.php?id=" . $row['id'] . "'class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this user?');\">
                       Delete
                    </a></td>
                <td><a href='/intern_app/Users/user_edit.php?id=" . $row['id'] . "'class='btn btn-info'>Edit</a></td>
              </tr>";


    }
} else {
    echo "0 results";
}
?>
</body>
</html>
