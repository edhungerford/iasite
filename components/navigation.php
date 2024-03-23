<div class="navigationContainer">

    <select class="pageSwitch">
        <option disabled selected value="">Browse...</option>
        <?php
        $files = get_options($request);
        foreach($files as $key => $value){
            if(is_array($value)){
                echo "<optgroup label='$key'>";
                foreach($value as $subvalue){
                    echo "<option value='$key/$subvalue'>$subvalue</option>";
                }
                echo "</optgroup>";
            } else {
                echo "<option value='$value'>$value</option>";
            }
        }
        ?>
    </select>
    <div class="break"></div>
    <div class="navigation">



    <?php
    if($request == "/read" || !!preg_match('/read\/*/', $request)) $book = "/read";
    if($request == "/black-magic-blues" || !!preg_match('/black-magic-blues\/*/', $request)) $book = "/black-magic-blues";
    echo $page == 1? "<span>Oldest</span>" : "<a href='$book" . "/1'>Oldest</a>"; 
    echo $page == 1? "<span>Previous</span>" : "<a href='$book" . "/" . $page - 1 . "'>Previous</a>"; 
    echo $page == return_flattened_page_count($files)? "<span>Next</span>" : "<a href='$book" . "/" . $page + 1 . "'>Next</a>"; 
    echo $page == return_flattened_page_count($files)? "<span>Latest</span>" : "<a href='$book" . "/" . return_flattened_page_count($files) . "'>Latest</a>";
    ?>
    
</div>
    </div>