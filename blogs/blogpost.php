<?php

class blogpost
{
    public $id;
    public $title;
    public $content;
    public $date;

    public function __construct($id)
    {
        $this->id = $id;
        $this->load();
    }

    public function load()
    {
        $data = file_get_contents(BLOG_PATH . '/blogs.csv');
        $data = explode("\n", $data);
        $data = array_reverse($data);
        foreach ($data as $line) {
            $line = explode(',', $line);
            if (count($line) > 1) {
                if ($line[0] == $this->id) {
                    $this->title = $line[2]; 
                    $this->content = file_get_contents(BLOG_PATH . '/' . $line[0] . '.php');
                    $this->date = $line[1];
                }
            }
        }
        if($this->id > count($data)){
            $this->content = '<p>That blog post couldn\'t be found.</p>';
            $this->title = 'Invalid Post ID';
            $this->date = '';
        }
        $page_title = $this->title;
    }

    public function display()
    {
        echo '<p>' . $this->date . '</p>';
        echo '<p>' . $this->content . '</p>';
    }

    public function display_excerpt()
    {
        echo '<p>' . $this->date . '</p>';
        //Because posts are HTML, we don't want to end the excerpt on a tag, so we'll use a regex to find the second closing <p> tag and end the excerpt there.
        $excerpt = preg_split('/<\/p>/', $this->content, 3);
        for ($i = 0; $i < count($excerpt) - 1; $i++) {
            echo $excerpt[$i] . '</p>';
        }
    }

}