<?php
require __DIR__ . '/bootstrap.php';
if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
json_response(['csrfToken' => $_SESSION['csrf_token']]);
