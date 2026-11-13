<?php
require __DIR__ . '/bootstrap.php';
require_method('POST');
require_csrf();
$data = request_json();
$username = clean_string($data['username'] ?? '', 80);
$password = (string)($data['password'] ?? '');
if ($username === '' || $password === '') json_response(['message' => 'Enter your username and password.'], 422);
// Basic per-session throttling; production deployments should also enforce rate limits at the web server/WAF.
$_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? ['count' => 0, 'at' => time()];
if (time() - $_SESSION['login_attempts']['at'] > 900) $_SESSION['login_attempts'] = ['count' => 0, 'at' => time()];
if ($_SESSION['login_attempts']['count'] >= 8) json_response(['message' => 'Too many attempts. Wait 15 minutes and try again.'], 429);
try {
    $stmt = db()->prepare('SELECT id, username, password_hash, role, is_active FROM staff_users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if (!$user || !(bool)$user['is_active'] || !password_verify($password, $user['password_hash'])) {
        $_SESSION['login_attempts']['count']++;
        json_response(['message' => 'Incorrect username or password.'], 401);
    }
    session_regenerate_id(true);
    $_SESSION['staff'] = ['id' => (int)$user['id'], 'username' => $user['username'], 'role' => $user['role']];
    $_SESSION['login_attempts'] = ['count' => 0, 'at' => time()];
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    json_response(['authenticated' => true, 'staff' => $_SESSION['staff'], 'csrfToken' => $_SESSION['csrf_token']]);
} catch (Throwable $e) {
    error_log($e->getMessage());
    json_response(['message' => 'Staff sign-in is temporarily unavailable.'], 500);
}
