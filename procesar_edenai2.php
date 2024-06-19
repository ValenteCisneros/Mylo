<?php
// Definir la URL del endpoint y las cabeceras de autorización
$url = "https://api.edenai.run/v2/text/plagia_detection";
$headers = [
    "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiYThjZmFjYjUtODMzYy00MmI3LWFkNWUtZmRmZGYwY2RjOGRhIiwidHlwZSI6ImFwaV90b2tlbiJ9.DVLq7wes3e_jVL7d_1NaSEra_JSdVnFLno3fM412ufg",
    "Content-Type: application/json"
];

// Crear el payload con los datos del formulario
$payload = [
    "providers" => "originalityai",
    "text" => $_POST['text'], // Asumiendo que 'text' es el nombre del campo del formulario
    "title" => $_POST['title'] // Tomando el valor del campo 'title' del formulario
];

// Configurar opciones cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

// Ejecutar la solicitud y capturar la respuesta
$response = curl_exec($ch);

// Manejar errores
if (curl_errno($ch)) {
    echo 'Error en la solicitud cURL: ' . curl_error($ch);
} else {
    $response_data = json_decode($response, true);
    // Procesar la respuesta
    echo "<h2>Respuesta de EdenAI:</h2>";
    echo "<pre>";
    print_r($response_data);
    echo "</pre>";
}

// Cerrar la sesión cURL
curl_close($ch);
?>
