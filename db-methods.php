<?php

$database = new PDO('sqlite:./comic.db');

class Database {

    private $database;
    private $data;
    public function __construct($database){
        $this->database = $database;
        $query = 'SELECT Pages."Page Index", Pages.URL, Chapters."Chapter Title", Chapters."Chapter Index", Books."Book Title", Books."Primary Key" AS "Book Primary Key" FROM Pages 
            INNER JOIN Chapters ON Pages."Chapter Foreign Key"=Chapters."Primary Key" 
            INNER JOIN Books ON Books."Book Title"=Chapters."Book Foreign Key" 
            ORDER BY Books."Primary Key", Pages."Page Index"';
        foreach($database->query($query) as $row){
            $data[$row['Book Primary Key']]['title'] = $row['Book Title'];
            $data[$row['Book Primary Key']]['permalink'] = "https://ia-ia-ia.world/api/" . $row['Book Primary Key'];
            $data[$row['Book Primary Key']]['chapters'][$row['Chapter Index']]['chapterTitle'] = $row['Chapter Title'];
            $data[$row['Book Primary Key']]['chapters'][$row['Chapter Index']]['pages'][$row['Page Index']] = $row['URL'];
        }
        $this->data = $data;
    }
    public function getAll(){
        return json_encode($this->data);
    }
    public function getBook($id){
        return json_encode($this->data[$id]);
    }
    

}
?>