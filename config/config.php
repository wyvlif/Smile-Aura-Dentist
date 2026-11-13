<?php
// Copy this file to config.local.php and edit the settings there.
// Keep credentials out of public source control and never expose API keys in JavaScript.
return [
    'db' => [
        'host' => '127.0.0.1',
        'port' => 3306,
        'database' => 'smile_aura_clinic',
        'username' => 'root',
        'password' => '', // Default XAMPP MariaDB setup is often blank; set your own password if configured.
        'charset' => 'utf8mb4',
    ],
    'clinic' => [
        'name' => 'SMILE AURA DENTIST',
        'timezone' => 'Africa/Kigali',
        'whatsapp' => '250787575201',
        'appointment_slots' => ['08:30', '09:45', '11:00', '13:30', '15:00', '16:15', '17:30', '18:15'],
    ],
    'ai' => [
        'provider' => 'openai',
        'api_key' => '', // Add your OpenAI API key here on the server only, or use an environment variable.
        'model' => 'gpt-6-astra',
    ],
];
