<?php
// Função para receber o sms
function sendSMS($data) {
    $url = '-';
    $apiKey = '-';
    // Variavel para passar o header
    $headers = array(
        'Authorization: App ' . $apiKey,
        'Content-Type: application/json',
        'Accept: application/json'
    );
    // payload recebe o json que está sendo armazenado em $data
    $payload = json_encode($data);
    // curl que vai enviar o json
    $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        
    $response = curl_exec($ch);
    curl_close($ch);
    // se receber o json, executar o curl e mesmo assim nao enviar, dá esse erro
    if (!$response) {
        die('Erro ao enviar a requisição.');
    };

    echo $response;

};
// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados JSON do corpo da requisição
    $jsonData = file_get_contents('php://input');
    
    // Decodifica o JSON em um array associativo
    $data = json_decode($jsonData, true);
    
    // Verifica se a decodificação foi bem-sucedida
    if ($data !== null) {
    // Imprime o JSON decodificado
        echo "JSON Recebido\n";
        sendSMS($data);
    } else {
        // Se a decodificação falhou
        echo "Erro ao decodificar o JSON.";
    }
} else {
    // Se a requisição não for do tipo POST
    echo "Este arquivo PHP espera uma requisição POST com JSON.";
};
//Código feito por Flávio Leonel Marynowski, qualquer duvida só chamar no LinkedIn
?>