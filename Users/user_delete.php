<?php
include __DIR__ . '/../config.php';
if (!session_id()) session_start();
?>
<?php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('User deleted successfully!'); window.location.href='../admin_panel.php';</script>";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
header("Location: ../Dashboard/admin_dashboard.php");
exit();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>