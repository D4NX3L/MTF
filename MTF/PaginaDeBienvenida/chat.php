<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Reemplaza con tu clave de API de OpenAI
$apiKey = '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';

header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);
$pregunta = $input['pregunta'] ?? '';

if (!$pregunta) {
    echo json_encode(['respuesta' => 'No se recibió una pregunta.']);
    exit;
}

$datos = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'system', 'content' => 'Eres un asesor experto en finanzas. Responde de forma clara y útil.'],
        ['role' => 'user', 'content' => $pregunta],
    ],
];

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey,
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));

// AQUÍ ESTABA FALTANDO ESTA LÍNEA CRUCIAL:
$respuesta = curl_exec($ch);

if (!$respuesta) {
    echo json_encode(['respuesta' => 'Error al conectar con la API de OpenAI.']);
    exit;
}

curl_close($ch);

$resultado = json_decode($respuesta, true);

if (isset($resultado['error'])) {
    echo json_encode(['respuesta' => 'Error de OpenAI: ' . $resultado['error']['message']]);
    exit;
}

$texto = $resultado['choices'][0]['message']['content'] ?? 'Respuesta vacía.';

echo json_encode(['respuesta' => $texto]);
