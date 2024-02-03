<?php
define("ROOT_PATH", __DIR__);
define("BLOG_PATH", __DIR__ . "/blogs"); 
define("MAINTENANCE", true); 
require "functions.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An expression in the shape of a duck.">
    <?php $request = $_SERVER['REQUEST_URI']; 

    $title = "IA IA IA";
    switch ($request) {
        case '':
        case '/':
            
            break;
        case (!!preg_match('/read\/*/', $request)):
        case '/read':
            $title = $title . " | Read";
            break;
        case '/blog':
        case (!!preg_match('/blog\//', $request)):
            $title = $title . " | Blog";
            break;
        default:
            $title = $title . " | 404";
            break;
    }
    
    echo "<title>$title</title>";
    ?>
    
    <link rel="stylesheet" type="text/css" href="/main.css" />
    <link rel="icon" type="image/jpeg" href="/duckico.png" />
</head>
<body>
<?php require ROOT_PATH  ."/components/header.php"; ?>
    <?php
    
    route_pages($request);
?>
<?php require ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>