CREATE DATABASE IF NOT EXISTS smile_aura_clinic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE smile_aura_clinic;

CREATE TABLE IF NOT EXISTS staff_users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','receptionist','dentist') NOT NULL DEFAULT 'receptionist',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS appointments (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  patient_name VARCHAR(120) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  email VARCHAR(190) NOT NULL,
  service VARCHAR(100) NOT NULL,
  appointment_date DATE NOT NULL,
  appointment_time TIME NOT NULL,
  reminder_channel VARCHAR(20) NOT NULL DEFAULT 'SMS',
  status ENUM('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_appointment_date (appointment_date),
  KEY idx_appointment_status (status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS appointment_slot_locks (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  appointment_id BIGINT UNSIGNED NOT NULL UNIQUE,
  appointment_date DATE NOT NULL,
  appointment_time TIME NOT NULL,
  UNIQUE KEY uq_active_appointment_slot (appointment_date, appointment_time),
  CONSTRAINT fk_slot_appointment FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE
) ENGINE=InnoDB;
