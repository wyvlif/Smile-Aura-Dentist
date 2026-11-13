<?php
require __DIR__ . '/bootstrap.php';
require_method('POST');
require_csrf();
$data = request_json();
$name = clean_string($data['name'] ?? '', 120);
$phone = clean_string($data['phone'] ?? '', 30);
$email = clean_string($data['email'] ?? '', 190);
$service = clean_string($data['service'] ?? '', 100);
$date = clean_string($data['date'] ?? '', 10);
$time = clean_string($data['time'] ?? '', 5);
$reminder = clean_string($data['reminder'] ?? 'SMS', 20);
if ($name === '' || $phone === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $service === '' || $reminder === '') json_response(['message' => 'Please complete all required booking fields correctly.'], 422);
$dt = DateTime::createFromFormat('Y-m-d', $date);
if (!$dt || $dt->format('Y-m-d') !== $date || $dt < new DateTime('today')) json_response(['message' => 'Please choose a valid future date.'], 422);
if ($date === (new DateTime('today'))->format('Y-m-d')) { $requested = DateTime::createFromFormat('Y-m-d H:i', $date . ' ' . $time); if (!$requested || $requested <= new DateTime()) json_response(['message' => 'Please choose a future time.'], 422); }
global $config;
if (!in_array($time, $config['clinic']['appointment_slots'], true)) json_response(['message' => 'That appointment time is not available. Please select another slot.'], 422);
try {
    $pdo = db();
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO appointments (patient_name, phone, email, service, appointment_date, appointment_time, reminder_channel, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->execute([$name, $phone, $email, $service, $date, $time, $reminder]);
    $id = (int)$pdo->lastInsertId();
    $lock = $pdo->prepare('INSERT INTO appointment_slot_locks (appointment_id, appointment_date, appointment_time) VALUES (?, ?, ?)');
    $lock->execute([$id, $date, $time]);
    $pdo->commit();
    json_response(['success' => true, 'appointment' => ['id' => $id, 'reference' => 'SA-' . str_pad((string)$id, 6, '0', STR_PAD_LEFT), 'name' => $name, 'date' => $date, 'time' => $time, 'status' => 'pending']], 201);
} catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) $pdo->rollBack();
    if ($e->getCode() === '23000') json_response(['message' => 'Sorry, that time was just booked. Please choose another available slot.'], 409);
    error_log($e->getMessage());
    json_response(['message' => 'We could not save your appointment. Please contact the clinic directly.'], 500);
}
