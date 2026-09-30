<div class="navigationContainer">

    <select class="pageSwitch">
        <option disabled selected value="">Browse...</option>
        <?php
        
        $realPageIndex = 0;
        foreach($book->chapters as $key => $chapter){
                echo "<optgroup label='$chapter->chapterTitle'>";
                foreach($chapter->pages as $value){

                    echo "<option value='$realPageIndex'>" . special_index_decider($request, $realPageIndex) . "</option>";
                    $realPageIndex++;
                }
                echo "</optgroup>";
        }
        ?>
    </select>
    <div class="break"></div>
    <div class="navigation">



    <?php
    if($request == "/read" || !!preg_match('/read\/*/', $request)) $basePath = "/read";
    if($request == "/black-magic-blues" || !!preg_match('/black-magic-blues\/*/', $request)) $basePath = "/black-magic-blues";
    if($request == "/nib" || !!preg_match('/nib\/*/', $request)) $basePath = "/nib";
    echo $pageIndex == 1? "<span>Oldest</span>" : "<a href='$basePath" . "/1'>Oldest</a>"; 
    echo $pageIndex == 1? "<span>Previous</span>" : "<a href='$basePath" . "/" . $pageIndex - 1 . "'>Previous</a>"; 
    echo $pageIndex == count($pages)? "<span>Next</span>" : "<a href='$basePath" . "/" . $pageIndex + 1 . "'>Next</a>"; 
    echo $pageIndex == count($pages)? "<span>Latest</span>" : "<a href='$basePath" . "/" . count($pages) . "'>Latest</a>";
    ?>
    
</div>
    </div>