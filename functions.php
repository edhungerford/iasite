<?php 

function check_maintenance_or_route($path){
    if(MAINTENANCE){
        require ROOT_PATH . '/views/maintenance.php';
    } else 
        require ROOT_PATH . $path;
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

?>