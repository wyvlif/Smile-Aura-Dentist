<?php
require __DIR__ . '/bootstrap.php';
require_method('GET');
$date = $_GET['date'] ?? '';
$dt = DateTime::createFromFormat('Y-m-d', $date);
if (!$dt || $dt->format('Y-m-d') !== $date) json_response(['message' => 'Choose a valid appointment date.'], 422);
$today = new DateTime('today');
if ($dt < $today) json_response(['message' => 'Appointments cannot be booked in the past.'], 422);
try {
    $stmt = db()->prepare("SELECT TIME_FORMAT(appointment_time, '%H:%i') AS appointment_time FROM appointment_slot_locks WHERE appointment_date = ?");
    $stmt->execute([$date]);
    $booked = array_column($stmt->fetchAll(), 'appointment_time');
    global $config;
    $available = array_values(array_diff($config['clinic']['appointment_slots'], $booked));
    if ($date === (new DateTime('today'))->format('Y-m-d')) {
        $now = new DateTime();
        $available = array_values(array_filter($available, function ($slot) use ($now) {
            $slotTime = DateTime::createFromFormat('Y-m-d H:i', $now->format('Y-m-d') . ' ' . $slot);
            return $slotTime && $slotTime > $now;
        }));
    }
    json_response(['date' => $date, 'availableSlots' => $available, 'bookedSlots' => $booked]);
} catch (Throwable $e) {
    error_log($e->getMessage());
    json_response(['message' => 'Appointment availability is temporarily unavailable.'], 500);
}
