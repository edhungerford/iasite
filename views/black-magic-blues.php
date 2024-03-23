<h1>BLACK MAGIC BLUES</h1>

<?php 

            $request = $_SERVER['REQUEST_URI'];
            $page = str_replace("-", "", filter_var(basename($request), FILTER_SANITIZE_NUMBER_INT));
            if(!$page) $page = 1;
        ?>
        <?php include ROOT_PATH . "/components/navigation.php"; ?>
        
        <div class="page">
           <img src="<?php echo find_page($request); ?>" />
        </div>
        <?php include ROOT_PATH . "/components/navigation.php"; ?>
