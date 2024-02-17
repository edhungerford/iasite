<?php
require_once(BLOG_PATH . '/blogpost.php');

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

//check if id is present and set
if (!is_archive()) {
    $blogpost = new blogpost($_GET['id']);
}
?>

<h1>BLOG</h1>
<?php 
echo "<div class='navigationContainer'>";
echo "<select class='blogSwitch'>";
echo "<option value='' disabled selected>Select a post</option>";
for ($i = 1; $i <= count_posts(); $i++) {
    $blogpost = new blogpost($i);
    echo "<option value='" . $i . "'>" . $blogpost->date . ": " . $blogpost->title . "</option>";

}
echo "</select></div>";
?>
<?php
if (!is_archive()) {
    echo '<h2>' . $blogpost->title . '</h2>';
$blogpost->display();
echo '<p><a href="/blog">Return to blog</a></p>';
} else {
for ($i = count_posts(); $i > 0; $i--) {
    echo "<div class='post'>";
$blogpost = new blogpost($i);
echo '<h2>' . $blogpost->title . '</h2>';
$blogpost->display_excerpt();
echo '<p><a href="/blog/?id=' . $i . '">Read full post</a></p>';
echo "</div>";
}

}
?>
