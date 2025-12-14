<?php
include __DIR__ . '/../config.php';
if (!session_id()) session_start();
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = ($_POST['name']);
    $email =($_POST['email']);
    $year = ($_POST['password']);

    $sql = "INSERT INTO users (name, email, password ) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $year);

    if (mysqli_stmt_execute($stmt)) {
        echo "data inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    // Redirect to admin dashboard after adding user
    header("Location: /intern_app/Dashboard/admin_dashboard.php");
    exit();
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>
<h2>Add User</h2>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add user</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
<form method ="post">
  <div class="mb-3">
    <label>name</label>
    <input type="text" class="form-control" name="name" required>
  </div>
   <div class="mb-3">
    <label>email</label>
    <input type="email" class="form-control" name="email" required>
  </div>
     <div class="mb-3">
    <label>password</label>
    <input type="password" class="form-control" name="password" required>
  </div>

  <button type="submit" class="btn btn-primary">add</button>
</form>
</body>
</html>

