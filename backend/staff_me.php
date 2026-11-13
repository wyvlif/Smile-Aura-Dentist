<?php
require __DIR__ . '/bootstrap.php';
require_method('GET');
if (empty($_SESSION['staff'])) json_response(['authenticated' => false], 401);
json_response(['authenticated' => true, 'staff' => $_SESSION['staff'], 'csrfToken' => $_SESSION['csrf_token'] ?? null]);
