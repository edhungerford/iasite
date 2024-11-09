<?php
require "db-methods.php";
$db = new Database($database);
$request = strtok($_SERVER["REQUEST_URI"], '?');
define("ROOT_PATH", __DIR__);
define("BLOG_PATH", __DIR__ . "/blogs"); 
define("MAINTENANCE", false); 
require "functions.php"; 
if(preg_match('/api\/*/', $request)):
    require "api.php";
else:
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An expression in the shape of a duck.">
    <?php 
    
    echo "<title>" . route_title($request) . "</title>";
    ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo route_stylesheet($request); ?>" />
    <link rel="icon" type="image/jpeg" href="/duckico.png" />
    <script src="/main.js"></script>
</head>
<body>
<?php require ROOT_PATH  ."/components/header.php"; ?>
    <?php
    
    require route_page($request);
?>
<?php require ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
<?php endif; ?>