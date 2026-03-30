<?php

include_once './src/Database.php';
include_once './src/models/Person.php';

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => 'https://randomuser.me/api/?results=5',
    CURLOPT_RETURNTRANSFER => true
]);

$response = curl_exec($ch);

$data = json_decode($response, true);
// print '<pre>';
// print_r($data);
// print '</pre>';

try {
    $db = new Database('localhost', 'persons_api', 'root', '');
    $person = new Person($db);
    $person->postToDB($data, 5);
    echo json_encode(['OK' => 'Data added to DB']);
} catch (Throwable $e) {
    echo json_encode(['Error' => 'Something wrong with db']);
    echo json_encode(["error" => $e->getMessage()]);
}