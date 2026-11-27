<?php
// ============================================================
// LOGOUT: hapus token di database, hapus cookie, hapus session
// ============================================================
require_once 'includes/auth.php';

if (sudah_login()) {
    $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}

setcookie('remember_me', '', time() - 3600, '/');  // hapus cookie
session_unset();
session_destroy();

header("Location: login.php");
exit;
