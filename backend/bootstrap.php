<?php
declare(strict_types=1);
$config = require __DIR__ . '/../config/config.php';
$localConfig = __DIR__ . '/../config/config.local.php';
if (is_file($localConfig)) {
    $overrides = require $localConfig;
    if (is_array($overrides)) {
        foreach ($overrides as $section => $values) {
            if (isset($config[$section]) && is_array($values)) $config[$section] = array_replace($config[$section], $values);
            else $config[$section] = $values;
        }
    }
}
date_default_timezone_set($config['clinic']['timezone'] ?? 'Africa/Kigali');
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
session_name('smileaura_staff');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $isHttps,
    'httponly' => true,
    'samesite' => 'Lax',
]);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

function json_response(array $data, int $status = 200): never {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store, max-age=0');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}
function request_json(): array {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw ?: '', true);
    return is_array($data) ? $data : [];
}
function db(): PDO {
    global $config;
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $d = $config['db'];
    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s', $d['host'], $d['port'], $d['database'], $d['charset']);
    $pdo = new PDO($dsn, $d['username'], $d['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}
function require_method(string $method): void {
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== $method) json_response(['message' => 'Method not allowed.'], 405);
}
function require_csrf(): void {
    $sent = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!$sent || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $sent)) {
        json_response(['message' => 'Your session token expired. Refresh the page and try again.'], 419);
    }
}
function require_staff(array $roles = []): array {
    if (empty($_SESSION['staff'])) json_response(['message' => 'Staff sign-in required.'], 401);
    $staff = $_SESSION['staff'];
    if ($roles && !in_array($staff['role'], $roles, true)) json_response(['message' => 'You do not have permission to perform this action.'], 403);
    return $staff;
}
function clean_string(mixed $value, int $max = 255): string {
    $value = trim((string)$value);
    return mb_substr($value, 0, $max);
}
