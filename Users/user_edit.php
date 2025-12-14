<?php
include __DIR__ . '/../config.php';
if (!session_id()) session_start();

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid user ID.");
}

// Fetch existing data for the form
$sql = "SELECT name, email, password FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$user){
    die("User not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($password))
      {
        $password = password_hash($password, PASSWORD_DEFAULT);
      } else {
        $password = $user['password'];
      }
    
    $sql = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $password, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('User updated successfully!'); window.location.href='/intern_app/Dashboard/admin_dashboard.php';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<h2>Edit User</h2>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
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

  <button type="submit" class="btn btn-primary">edit</button>
</form>
</body>
</html>
