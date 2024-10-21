<?php
$request = strtok($_SERVER["REQUEST_URI"], '?');
define("ROOT_PATH", __DIR__);
define("BLOG_PATH", __DIR__ . "/blogs"); 
define("MAINTENANCE", false); 
require "functions.php"; 
if(preg_match('/api\/*/', $request)):
    require "api.php";
elseif(preg_match('/hunters\/*/', $request)):
    require "hunters.php";
else:

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An expression in the shape of a duck.">
    <?php $title = "IA IA IA";
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
        case (!!preg_match('/black-magic-blues\/*/', $request)):
        case '/black-magic-blues':
            $title = $title . " | Black Magic Blues";
            break;
        default:
            $title = $title . " | 404";
            break;
    }
    
    echo "<title>$title</title>";
    ?>
    
    <link rel="stylesheet" type="text/css" href="/main.css" />
    <link rel="icon" type="image/jpeg" href="/duckico.png" />
    <script src="/main.js"></script>
</head>
<body>
<?php require ROOT_PATH  ."/components/header.php"; ?>
    <?php
    
    route_pages($request);
?>
<?php require ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
<?php endif; ?>