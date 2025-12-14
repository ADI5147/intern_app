<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../functions.php';
if (!session_id()) session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $error = "Both fields required.";
    } else {
        $sql = "SELECT id, name, password, role FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];
                
                // redirect to role-specific dashboard
                if ($row['role'] === 'admin') {
                    header("Location: Dashboard/admin_dashboard.php");
                } else {
                    header("Location: Dashboard/user_dashboard.php");
                }
                exit();
            } else {
                $error = "Invalid credentials.";
            }
        } else {
            $error = "User not found.";
        }
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>
<h2>Login</h2>
<?php if (!empty($error)): ?>
  <div class="alert alert-danger">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>
<form method ="post">
  <div class="mb-3">
   <div class="mb-3">
    <label>email</label>
    <input type="email" class="form-control" name="email" required>
  </div>
     <div class="mb-3">
    <label>password</label>
    <input type="password" class="form-control" name="password" required>
  </div>

  <button type="submit" class="btn btn-primary">login</button>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
