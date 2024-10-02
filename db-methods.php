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
            $hostname = $_SERVER['HTTP_HOST'] === 'localhost'? 'http://localhost' : 'https://ia-ia-ia.world/';
            $data[$row['Book Primary Key']]['permalink'] = $hostname . "/api/" . $row['Book Primary Key'] - 1;
            $data[$row['Book Primary Key']]['chapters'][$row['Chapter Index']]['chapterTitle'] = $row['Chapter Title'];
            $data[$row['Book Primary Key']]['chapters'][$row['Chapter Index']]['pages'][$row['Page Index']] = $hostname . $row['URL'];
        }
        $cleanedData = array_values($data);
        foreach($data as $key => $book){
            $cleanedData[$key - 1]['chapters'] = array_values($book['chapters']);
            foreach($cleanedData[$key - 1]['chapters'] as $key2 => $chapter){
                $cleanedData[$key -1]['chapters'][$key2]['pages'] = array_values($book['chapters'][$key2 + 1]['pages']);
            }
        }
        $this->data = $cleanedData;
    }
    public function getAll(){
        return json_encode($this->data);
    }
    public function getBook($id){
        return json_encode($this->data[$id]);
    }
    

}
?>