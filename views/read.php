<h1>READ</h1>

<?php 
$pages= json_decode($db->getPageList(0));   
$book = json_decode($db->getBook(0));
            $request = $_SERVER['REQUEST_URI'];
            $pageIndex = (int)str_replace("-", "", filter_var(basename($request), FILTER_SANITIZE_NUMBER_INT)); 
            if(($pageIndex) == 0) $pageIndex = 1;     
            $page = $pageIndex? $pages[$pageIndex - 1]: $pages[0];
        ?>
        <?php include ROOT_PATH . "/components/navigation.php"; ?>
        
        <div class="page">
            <?php if(count($pages) !== $pageIndex) echo "<a href='/read/" . $pageIndex + 1 . "'>";?> 
               <img src="<?php echo $page; ?>" />
            <?php if(count($pages) !== $pageIndex) echo "</a>";?> 
        </div>
        <?php include ROOT_PATH . "/components/navigation.php"; ?>
