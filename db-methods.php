<?php
$database = new PDO('sqlite:./comic.db');
class Database {

    private $database;
    private $data;
    public function __construct($database){
        $this->database = $database;
        $query = 'SELECT Pages."Page Index", Pages.URL, Chapters."Chapter Title", Chapters."Chapter Index", Books."Book Title", Books."Primary Key" AS "Book Primary Key" FROM Pages 
            INNER JOIN Chapters ON Pages."Chapter Foreign Key"=Chapters."Primary Key" 
            INNER JOIN Books ON Books."Primary Key"=Chapters."Book Foreign Key" 
            ORDER BY Books."Primary Key", Pages."Page Index"';
        foreach($database->query($query) as $row){
            $data[$row['Book Primary Key']]['title'] = $row['Book Title'];
            $hostname = $_SERVER['HTTP_HOST'] === 'localhost'? 'http://localhost' : 'https://ia-ia-ia.world';
            $data[$row['Book Primary Key']]['permalink'] = $hostname . "/api/" . urlencode($row['Book Primary Key']);
            $data[$row['Book Primary Key']]['chapters'][$row['Chapter Index']]['chapterTitle'] = $row['Chapter Title'];
            $data[$row['Book Primary Key']]['chapters'][$row['Chapter Index']]['pages'][$row['Page Index']] = $hostname . str_replace(" ", "%20", $row['URL']);
        }
        $cleanedData = array_values($data);
        foreach($data as $key => $book){
            $cleanedData[$key]['chapters'] = array_values($book['chapters']);
            foreach($cleanedData[$key]['chapters'] as $key2 => $chapter){
                $cleanedData[$key]['chapters'][$key2]['pages'] = array_values($book['chapters'][$key2]['pages']);
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
    public function getPageList($id){
        $book = $this->data[$id];
        $pages = array();
        foreach($book["chapters"] as $key=>$chapter){
            foreach($chapter["pages"] as $page){
                $pages[] = $page;
            }
        }
        return json_encode($pages);
    }

}
?>