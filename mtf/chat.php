<?php
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

$respuesta = curl_exec($ch);
curl_close($ch);

$resultado = json_decode($respuesta, true);
$texto = $resultado['choices'][0]['message']['content'] ?? 'Error al generar respuesta.';

echo json_encode(['respuesta' => $texto]);