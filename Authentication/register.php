<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../functions.php';
if (!session_id()) session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || !$password) {
        $error = "All fields are required.";
    } else {
        // Check email exists
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "Email already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $st = mysqli_prepare($conn, $insert);
            mysqli_stmt_bind_param($st, "sss", $name, $email, $hash);
            if (mysqli_stmt_execute($st)) {
                $_SESSION['user_id'] = mysqli_insert_id($conn);
                $_SESSION['name'] = $name;
                $_SESSION['role'] = 'user';
                header("Location: Dashboard/user_dashboard.php");
                exit();
            } else {
                $error = "DB error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<h2>Register</h2>
<!-- 
<form method="post">
  <label>Name</label><br>
  <input type="text" name="name" required><br><br>
  <label>Email</label><br>
  <input type="email" name="email" required><br><br>
  <label>Password</label><br>
  <input type="password" name="password" required><br><br>
  <button type="submit">Register</button>
</form> -->

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

  <button type="submit" class="btn btn-primary">Register</button>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
