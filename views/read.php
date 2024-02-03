<h1>READ</h1>
<?php 
            $request = $_SERVER['REQUEST_URI'];
            $page = filter_var(basename($request), FILTER_SANITIZE_NUMBER_INT);
            if(!$page) $page = 1;
        ?>
        <?php include ROOT_PATH . "/components/navigation.php"; ?>
        <div class="page">
            <img src="<?php echo $flat_pages[$page - 1]["path"] ?>" />
        </div>
        <?php include ROOT_PATH . "/components/navigation.php"; ?>
