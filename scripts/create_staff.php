<?php
// Run only from a terminal: php scripts/create_staff.php username admin
if (PHP_SAPI !== 'cli') { http_response_code(403); exit("CLI only.\n"); }
require __DIR__ . '/../backend/bootstrap.php';
$username = $argv[1] ?? '';
$role = $argv[2] ?? 'admin';
if (!preg_match('/^[a-zA-Z0-9._-]{3,80}$/', $username)) { fwrite(STDERR, "Usage: php scripts/create_staff.php username [admin|receptionist|dentist]\nUsername must be 3-80 letters, numbers, dots, underscores or hyphens.\n"); exit(1); }
if (!in_array($role, ['admin', 'receptionist', 'dentist'], true)) { fwrite(STDERR, "Role must be admin, receptionist or dentist.\n"); exit(1); }
fwrite(STDOUT, "New password (minimum 12 characters): ");
$password = trim((string)fgets(STDIN));
if (strlen($password) < 12) { fwrite(STDERR, "Password must be at least 12 characters.\n"); exit(1); }
try {
    $stmt = db()->prepare('INSERT INTO staff_users (username, password_hash, role, is_active) VALUES (?, ?, ?, 1)');
    $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $role]);
    fwrite(STDOUT, "Staff account created for {$username} ({$role}). Store the password securely.\n");
} catch (PDOException $e) {
    fwrite(STDERR, $e->getCode() === '23000' ? "That username already exists.\n" : "Could not create account: {$e->getMessage()}\n");
    exit(1);
}
