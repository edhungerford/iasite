<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];
header('Content-Type: application/json');

if($method != "GET"){
    die("This database is read-only.");
}
if ($endpoint === '/api') {
    echo $db->getAll();
} elseif (preg_match('/^\/api\/(\d+)$/', $endpoint, $matches)) {
    $bookId = $matches[1];
    $book = $db->getBook($bookId);
    echo $book;
}

?>