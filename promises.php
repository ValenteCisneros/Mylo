<?php
$documentPath = 'data.json';
$data = json_decode(file_get_contents($documentPath), true);

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
// API Endpoints
$apiEndpoints = [
    'https://cse.google.com/cse?cx=6642e4a73ce914e46/MILO3.php',
    'https://cse.google.com/cse?cx=6642e4a73ce914e46/procesar_edenapi.php',
    'https://esm.run/@google/generative-ai'
];

// Initialize the Guzzle client
$client = new Client();

// Prepare the promises
$promises = [
    'api1' => $client->postAsync($apiEndpoints[0], ['json' => $data]),
    'api2' => $client->postAsync($apiEndpoints[1], ['json' => $data]),
    'api3' => $client->postAsync($apiEndpoints[2], ['json' => $data]),
];

// Wait for the requests to complete
$results = Promise\settle($promises)->wait();

// Process the responses
foreach ($results as $key => $result) {
    if ($result['state'] === 'fulfilled') {
        echo $key . ' response: ' . $result['value']->getBody() . PHP_EOL;
    } else {
        echo $key . ' error: ' . $result['reason'] . PHP_EOL;
    }
}

?>
