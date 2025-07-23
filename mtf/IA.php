<?php
// Procesamiento del formulario y llamada a la API
$answer = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'];

    // ⚠️ Reemplaza esta variable por una forma segura (variable de entorno en producción)
    $apiKey = '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';

    $postData = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => $question]
        ]
    ];

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);
    curl_setopt($chCURLOPT_POSTFIELDS, json_encode($postData));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    $answer = $data['choices'][0]['message']['content'] ?? 'Error al recibir respuesta de la IA.';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistente de IA con PHP</title>
</head>
<body>
    <h1>Pregúntale a la IA</h1>
    <form method="POST">
        <label for="question">Tu pregunta:</label><br>
        <textarea name="question" id="question" rows="5" cols="60" required></textarea><br><br>
        <input type="submit" value="Enviar pregunta">
    </form>

    <?php if (!empty($answer)): ?>
        <h2>Respuesta de la IA:</h2>
        <p><?= nl2br(htmlspecialchars($answer)) ?></p>
    <?php endif; ?>
</body>
</html>