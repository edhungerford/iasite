<div class="navigationContainer">
    <?php
    $chapters = scandir(ROOT_PATH . "/pages");
    $chapters = array_slice($chapters, 2, count($chapters) - 3);
    $flat_pages = [];
    
    foreach ($chapters as $chapter) {
        $pages = scandir(ROOT_PATH . "/pages/" . $chapter);
        $pages = array_slice($pages, 2, count($pages) - 2);
        $index = 1;
        foreach ($pages as $indpage) {
            if($index == 1){
                array_push($flat_pages, ["chapter" => $chapter, "path" => "/pages/" . rawurlencode($chapter) . "/" . $indpage, "chapter_start" => "true"]);
            } else {
                array_push($flat_pages, ["chapter" => $chapter, "path" => "/pages/" . rawurlencode($chapter) . "/" . $indpage, "chapter_start" => "false"]);
            }
            $index++;
        }
        
    }
    ?>

    <select class="pageSwitch">
        <option disabled selected value="">Browse...</option>
        <?php for ($i=1; $i < count($flat_pages) + 1; $i++) { 
            if($i == 1 || $flat_pages[$i]["chapter_start"] == "true"){
                echo "<option disabled value='$i'>" . $flat_pages[$i]["chapter"] . "</option>";
            }
            echo $page == $i ? "<option disabled value='$i'>$i</option>" : "<option value='$i'>$i</option>";
        }
        ?>
    </select>
    <div class="navigation">

    <?php
    
    echo $page == 1? "<span>Oldest</span>" : "<a href='/read/1'>Oldest</a>"; 
    echo $page == 1? "<span>Previous</span>" : "<a href='/read/" . $page - 1 . "'>Previous</a>"; 
    echo $page == count($flat_pages)? "<span>Next</span>" : "<a href='/read/" . $page + 1 . "'>Next</a>"; 
    echo $page == count($flat_pages)? "<span>Latest</span>" : "<a href='/read/" . count($flat_pages) . "'>Latest</a>"; ?>
</div>
</div>