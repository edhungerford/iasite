<?php 

function check_maintenance_or_route($path){
    if(MAINTENANCE){
        require ROOT_PATH . '/views/maintenance.php';
    } else 
        require ROOT_PATH . $path;
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
        case (!!preg_match('/black-magic-blues\/*/', $request)):
        case '/black-magic-blues':
            require ROOT_PATH . '/views/black-magic-blues.php';
            break;
        default:
            http_response_code(404);
            require ROOT_PATH . '/views/404.php';
            break;
    }
}

function get_options($request){
    if($request == "/read" || !!preg_match('/read\/*/', $request)) $request = "/ia-ia-ia";
    if($request == "/black-magic-blues" || !!preg_match('/black-magic-blues\/*/', $request)) $request = "/black-magic-blues";
    // Build a associative array of files with their respective directories
    $files = array();
    $dir = new DirectoryIterator(ROOT_PATH . "/comics/" . $request);
    foreach ($dir as $fileinfo) {
        if ($fileinfo->isFile()) {
            $files[] = $fileinfo->getFilename();
        } else if ($fileinfo->isDir() && !$fileinfo->isDot()) {
            $subdir = new DirectoryIterator($fileinfo->getPathname());
            $files[$fileinfo->getFilename()] = array();
            foreach ($subdir as $subfileinfo) {
                if ($subfileinfo->isFile()) {
                    $files[$fileinfo->getFilename()][] = prettify_filename($subfileinfo->getFilename());
                }
            }
            asort($files[$fileinfo->getFilename()]);
        }
    }
    return $files;
}

function find_page($request){
    if($request == "/read" || $request == "/black-magic-blues"){
        $page = "1";
    } else {
        if(isset($_GET["id"])){
            $page = $_GET["id"];
        } else {
            $thingy = explode("/", $request);
            $page = $thingy[count($thingy) - 1];
        }
    }
    $files = get_options($request);
    if($request == "/read" || !!preg_match('/read\/*/', $request)) $path = "/comics/ia-ia-ia/";
    if($request == "/black-magic-blues" || !!preg_match('/black-magic-blues\/*/', $request)) $path = "/comics/black-magic-blues/";
    
    foreach($files as $key => $value){
        foreach($value as $subvalue){
            if($page === $subvalue){
                $path .= $key . "/" . $subvalue;
            }
        }
    }
    return "$path.jpg";
}

function prettify_filename($filename){
    $filename = str_replace("-", " ", $filename);
    $filename = str_replace(".jpg", "", $filename);
    return $filename;
}

function return_flattened_page_count($files){
    $pages = array();
    foreach($files as $key => $value){
        foreach($value as $subvalue){
            $pages[] = $subvalue;
        }
    }
    return count($pages);
}

?>