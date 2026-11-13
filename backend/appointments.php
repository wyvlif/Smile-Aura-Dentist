<?php
require __DIR__ . '/bootstrap.php';
$staff = require_staff();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
try {
    if ($method === 'GET') {
        $date = clean_string($_GET['date'] ?? '', 10);
        $sql = 'SELECT id, patient_name AS name, phone, email, service, appointment_date AS date, appointment_time AS time, reminder_channel AS reminder, status, created_at FROM appointments';
        $params = [];
        if ($date !== '') { $sql .= ' WHERE appointment_date = ?'; $params[] = $date; }
        $sql .= ' ORDER BY appointment_date ASC, appointment_time ASC';
        $stmt = db()->prepare($sql); $stmt->execute($params);
        json_response(['appointments' => $stmt->fetchAll(), 'staff' => $staff]);
    }
    if ($method === 'PATCH') {
        require_csrf();
        if (!in_array($staff['role'], ['admin', 'receptionist'], true)) json_response(['message' => 'Only administrators and receptionists can update appointment status.'], 403);
        $data = request_json();
        $id = (int)($data['id'] ?? 0);
        $status = clean_string($data['status'] ?? '', 20);
        if ($id < 1 || !in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'], true)) json_response(['message' => 'Invalid appointment update.'], 422);
        $pdo = db();
        $pdo->beginTransaction();
        $find = $pdo->prepare('SELECT id, appointment_date, appointment_time, status FROM appointments WHERE id = ? FOR UPDATE');
        $find->execute([$id]); $existing = $find->fetch();
        if (!$existing) { $pdo->rollBack(); json_response(['message' => 'Appointment not found.'], 404); }
        if ($status === 'cancelled') {
            $release = $pdo->prepare('DELETE FROM appointment_slot_locks WHERE appointment_id = ?'); $release->execute([$id]);
        } elseif ($existing['status'] === 'cancelled') {
            $reserve = $pdo->prepare('INSERT INTO appointment_slot_locks (appointment_id, appointment_date, appointment_time) VALUES (?, ?, ?)');
            $reserve->execute([$id, $existing['appointment_date'], $existing['appointment_time']]);
        }
        $update = $pdo->prepare('UPDATE appointments SET status = ? WHERE id = ?'); $update->execute([$status, $id]);
        $pdo->commit();
        json_response(['success' => true, 'message' => 'Appointment status updated.']);
    }
    json_response(['message' => 'Method not allowed.'], 405);
} catch (Throwable $e) {
    if (isset($pdo) && $pdo instanceof PDO && $pdo->inTransaction()) $pdo->rollBack();
    if ($e instanceof PDOException && $e->getCode() === '23000') json_response(['message' => 'That time slot has already been taken by another booking.'], 409);
    error_log($e->getMessage());
    json_response(['message' => 'Could not load or update appointments.'], 500);
}
