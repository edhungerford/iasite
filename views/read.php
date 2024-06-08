<h1>READ</h1>

<?php 

            $request = $_SERVER['REQUEST_URI'];
            $page = filter_var(basename($request), FILTER_SANITIZE_NUMBER_INT);
            if(!$page) $page = 1;
        ?>
        <?php include ROOT_PATH . "/components/navigation.php"; ?>
        
        <div class="page">
            <?php if(last_page() !== $page) echo "<a href='/read/" . $page + 1 . "'>";?> 
               <img src="<?php echo find_page($request); ?>" />
            <?php if(last_page() !== $page) echo "</a>";?> 
        </div>
        <?php include ROOT_PATH . "/components/navigation.php"; ?>
