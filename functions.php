<?php 

function check_maintenance_or_route($path){
    if(MAINTENANCE){
        require ROOT_PATH . '/views/maintenance.php';
    } else 
        require $path;
}

function route_pages($request){
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
            check_maintenance_or_route('/views/blog.php');
            break;
        default:
            http_response_code(404);
            require ROOT_PATH . '/views/404.php';
            break;
    }
}

?>