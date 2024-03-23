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
    if(dirname($request) !== "\\"){
        echo $page == 1? "<span>Oldest</span>" : "<a href='" . dirname($request) . "/1'>Oldest</a>"; 
        echo $page == 1? "<span>Previous</span>" : "<a href='" . dirname($request) . "/" . $page - 1 . "'>Previous</a>"; 
        echo $page == return_flattened_page_count($files)? "<span>Next</span>" : "<a href='" . dirname($request) . "/" . $page + 1 . "'>Next</a>"; 
        echo $page == return_flattened_page_count($files)? "<span>Latest</span>" : "<a href='" . dirname($request) . "/" . return_flattened_page_count($files) . "'>Latest</a>";
    } else {
        echo $page == 1? "<span>Oldest</span>" : "<a href='" . $request . "/1'>Oldest</a>"; 
        echo $page == 1? "<span>Previous</span>" : "<a href='" . $request . "/" . $page - 1 . "'>Previous</a>"; 
        echo $page == return_flattened_page_count($files)? "<span>Next</span>" : "<a href='" . $request . "/" . $page + 1 . "'>Next</a>"; 
        echo $page == return_flattened_page_count($files)? "<span>Latest</span>" : "<a href='" . $request . "/" . return_flattened_page_count($files) . "'>Latest</a>";
    }
    
    ?>
    
</div>
    </div>