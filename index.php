<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    define("ROOT_PATH", __DIR__);
    define("BLOG_PATH", __DIR__ . "/blogs"); 
    echo "<title>$title</title>";
    ?>
    
    <link rel="stylesheet" type="text/css" href="/main.css" />
    <link rel="icon" type="image/jpeg" href="/duckico.png" />
</head>
<body>
<?php require ROOT_PATH  ."/components/header.php"; ?>
    <?php
    
    switch ($request) {
        case '':
        case '/':
            require ROOT_PATH . '/views/home.php';
            break;
        case (!!preg_match('/read\/*/', $request)):
        case '/read':
            require ROOT_PATH . '/views/read.php';
            break;
        case '/blog':
        case (!!preg_match('/blog\//', $request)):
            require ROOT_PATH . '/views/blog.php';
            break;
        default:
            http_response_code(404);
            require ROOT_PATH . '/views/404.php';
            break;
    }
?>
<?php require ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>