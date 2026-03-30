<?php
declare(strict_types=1);            // for type declaration
ini_set("display_errors", "On");    // Off

include_once './2.daļa/src/Database.php';
include_once './2.daļa/src/models/RetPerson.php';
include_once './2.daļa/src/controllers/PersonController.php';

// header('Location: /api/users');
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// print_r($path);

$parts = explode('/', $path);
// print_r($parts);

$method = $_SERVER['REQUEST_METHOD'];
// print_r($method);
$resource = $parts[2] ?? null;
$id = isset($parts[3]) ? (int)$parts[3] : null; 

try {
    $db = new Database('localhost', 'persons_api', 'root', '');
    $person = new RetPerson($db);
    $controller = new PersonController($person);
    // echo '<pre>';
    $response = $controller->router($method, $id, $resource);
    $data = json_decode($response, true);
    // print_r($data);
    // echo '</pre>';
} catch (Throwable $e) {
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="api/users" method="GET">
        <button type="submit">all posts</button>
        <?php if (isset($data)) :?>
            <?php foreach($data as $d) : ?>
            <p>
                id: <?= $d['id'] ?><br>
                name: <?= $d['name'] ?><br>
                e-mail: <?= $d['e_mail'] ?><br>
                <img src="<?= $d['picture'] ?>" alt="thumbnail">
            </p>
            <?php endforeach; ?>
        <?php endif; ?>              
        </form>
    </div>
</body>
</html>