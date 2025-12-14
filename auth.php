<?php
// auth.php - session and role helpers
if (!session_id()) session_start();

function isLoggedIn() {
    return !empty($_SESSION['user_id']);
}

function isAdmin() {
    return !empty($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /intern_app/Authentication/login.php");
        exit();
    }
}

function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        echo "Access denied. Admins only.";
        exit();
    }
}
?>


