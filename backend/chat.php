<?php
require __DIR__ . '/bootstrap.php';
require_method('POST');
$data = request_json();
$message = clean_string($data['message'] ?? '', 1200);
if ($message === '') json_response(['message' => 'Please enter a question.'], 422);
if (mb_strlen($message) > 1200) json_response(['message' => 'Please keep your question under 1,200 characters.'], 422);
$apiKey = getenv('OPENAI_API_KEY') ?: ($config['ai']['api_key'] ?? '');
if (!$apiKey || !function_exists('curl_init')) json_response(['reply' => 'Our AI assistant is currently in FAQ mode. You can ask about brushing, gum health, tooth pain, scaling, braces, whitening or appointments. For individual advice, please book an examination or contact reception.']);
$instructions = 'You are the patient information assistant for SMILE AURA DENTIST in Kigali, Rwanda. Answer in clear, concise, friendly language. Provide general evidence-informed dental education only; never diagnose, prescribe, or claim certainty. Encourage booking an examination for individual concerns. For facial swelling with fever, difficulty breathing or swallowing, uncontrolled bleeding, or significant trauma, advise urgent in-person medical/dental care. Do not request sensitive personal or payment information. Do not invent clinic fees, availability, or policies. Keep responses under 130 words.';
$payload = ['model' => $config['ai']['model'] ?? 'gpt-6-astra', 'instructions' => $instructions, 'input' => $message, 'max_output_tokens' => 220, 'store' => false];
$ch = curl_init('https://api.openai.com/v1/responses');
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Authorization: Bearer ' . $apiKey],
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_TIMEOUT => 25,
]);
$body = curl_exec($ch);
$status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);
if ($body === false || $status < 200 || $status >= 300) {
    error_log('Dental assistant API error: ' . $curlError . ' HTTP ' . $status . ' ' . substr((string)$body, 0, 500));
    json_response(['reply' => 'I am having trouble connecting to the AI assistant right now. I can still help with general FAQs, or you can contact the clinic on WhatsApp.']);
}
$result = json_decode($body, true);
$reply = '';
foreach (($result['output'] ?? []) as $item) {
    if (($item['type'] ?? '') === 'message') {
        foreach (($item['content'] ?? []) as $part) if (($part['type'] ?? '') === 'output_text') $reply .= ($part['text'] ?? '');
    }
}
$reply = trim($reply);
if ($reply === '') $reply = 'I could not prepare an answer just now. Please contact reception or book an appointment with the dentist.';
json_response(['reply' => mb_substr($reply, 0, 1800)]);
