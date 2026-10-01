<?php 

function check_maintenance_or_route($page){
    if(MAINTENANCE){
        return ROOT_PATH . '/views/maintenance.php';
    } else 
        return $page;
}

function prettify_filename($filename){
    $filename = str_replace("-", " ", $filename);
    $filename = str_replace(".jpg", "", $filename);
    return $filename;
}

function fix_indices($comicArray, $fk, $index, $sortItem){
    //Split the array into its books or chapters
    $chunkedArrays = array();
    $thingy = 0;
    foreach($comicArray as $item){
        $key = $item[$fk];
        $chunkedArrays[$key][] = $item;
    }

    //Sort the chunks
    $new_array = array();
    foreach($chunkedArrays as $key=>$chunk){
        $sortable_array = array();
        foreach($chunk as $chunkItem){
            $sortable_array[] = $chunkItem[$sortItem];
        }
        sort($sortable_array, SORT_NATURAL);
        foreach($sortable_array as $key2 => $sortableArrayItem){
            $new_array[$thingy][$fk] = $key;
            $new_array[$thingy][$index] = $key2;
            $new_array[$thingy][$sortItem] = $sortableArrayItem;
            $thingy++;
        }
    }
    return $new_array;

}

function route_title($request){
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
        case '/wizards':
            $title = "A Short Guide to Wizards";
            break;
        case (!!preg_match('/nib\/*/', $request)):
            $title = "NIB";
            break;
        default:
            $title = $title . " | 404";
            break;
    }
    return $title;
}

function route_stylesheet($request){
    switch ($request) {
        case '/wizards':
            $stylesheet = "/wizards.css";
            break;
        default:
            $stylesheet = '/main.css';
            break;
    }
    return $stylesheet;
}

function route_page($request){
    switch ($request) {
        case '':
        case '/':
            $page = ROOT_PATH . '/views/home.php';
            break;
        case (!!preg_match('/read\/*/', $request)):
        case '/read':
            $page = ROOT_PATH . '/views/read.php';
            break;
        case '/blog':
        case (!!preg_match('/blog\//', $request)):
            $page = ROOT_PATH . '/views/blog.php';
            break;
        case (!!preg_match('/black-magic-blues\/*/', $request)):
        case '/black-magic-blues':
            $page = ROOT_PATH . '/views/black-magic-blues.php';
            break;
        case '/wizards':
            $page = ROOT_PATH . '/views/wizards.php';
            break;
        case (!!preg_match('/nib\/*/', $request)):
            $page = ROOT_PATH . '/views/nib.php';
            break;
        default:
            http_response_code(404);
            $page = ROOT_PATH . '/views/404.php';
            break;
    }
    return check_maintenance_or_route($page);
}

function count_posts()
{
    $totalposts = file_get_contents(BLOG_PATH . '/blogs.csv');
    $totalposts = explode("\n", $totalposts);
    $totalposts = count($totalposts) - 1;
    return $totalposts;
}

function is_archive()
{
    if (isset($_GET['id'])) {
        return false;
    } else {
        return true;
    }
}

function get_title()
{
    if (!is_archive()) {
        $blogpost = new blogpost($_GET['id']);
        return strtoupper($blogpost->title);
    } else {
        return 'BLOG';
    }
}

function special_index_decider($request, $realPageIndex){
    if($request == "/nib" || !!preg_match('/nib\/*/', $request)){
        $comicDate = date_create("2026-10-04");
        $interval = DateInterval::createFromDateString($realPageIndex . ' days');
        $adjustedComicDate = date_add($comicDate, $interval);

        return date_format($adjustedComicDate, "l, F j, o");
    }
    return $realPageIndex + 1;
}

?>