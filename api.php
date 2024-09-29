<?php
header('Content-Type: application/json');
require "db-methods.php";

$database = new Database($database);
$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];
header('Content-Type: application/json');

if($method != "GET"){
    die("This database is read-only.");
}
if ($endpoint === '/api') {
    echo $database->getAll();
} elseif (preg_match('/^\/api\/(\d+)$/', $endpoint, $matches)) {
    $bookId = $matches[1];
    $book = $database->getBook($bookId);
    echo $book;
}

?>