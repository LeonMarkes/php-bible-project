<?php 
include("init.php");
require_once('config.php');

class Bible {
    // public $connection;

    // function __construct() {
    //     $this->open_db_connection(); 
    // }

    // function open_db_connection() { 
    //     $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //     if ($this->connection->connect_errno) {
    //         die('Database connection failed ' . $this->connection->connect_errno);
    //     }
    // }
    
    public function get_xml() {
        $xml = simplexml_load_file('ESV.xml') or die('XML datoteka nije pronađena.');
        return $xml;
    }
    public function insert_into_sentence($chaptId, $sentId, $sentence, $updated = 0) {
        global $database;
        $chaptId = (int) $chaptId;
        $sentId = (int) $sentId;
        $sentence = addslashes((string) $sentence);
        echo $chaptId . " " . gettype($chaptId) . "<br>";
        echo $sentId . " " . gettype($sentId) . "<br>";
        echo $sentence . " " . gettype($sentence) . "<br>";
        echo $updated . " " . gettype($updated) . "<br>";          
        if (!$database->connection->query("INSERT INTO `sentence` (chaptID, sentID, sentence, updated) VALUES ({$chaptId}, {$sentId}, '{$sentence}', {$updated})")) {
            printf("Error message: %s\n", $database->connection->error);
        }
    }
    
    public function insert_into_book($title) {
        $title = (string) $title;
        echo $title . " " . gettype($title) . "<br>";        
        if (!$this->connection->query("INSERT INTO `book` (title) VALUES ('{$title}')")) {
            printf("Error message: %s\n", $this->connection->error);
        }
    }
    public function show_content() {
        global $database;
        $content = $database->connection->query("SELECT title FROM book WHERE bookID = '15000'")->fetch_object();
        echo $content->title;
        
    }
}
$bible = new Bible();
// echo $database->test . "<br>";
// echo $bible->show_content();
foreach ($bible->get_xml()->b as $book) {
    // echo $book['n']. '<br>';
    foreach ($book as $chapter) {
        // echo $chapter['n'] . '<br>';
        foreach ($chapter as $sentence) {
            // echo $sentence . '<br>';
            // echo $sentence['n'] . '<br>';
            // echo $book['n'] . '<br>';
            // echo $chapter['n'] . '<br>';
            // $bible->insert_into_sentence($chapter['n'], $sentence['n'], $sentence);
            // $bible->insert_into_book($book['n']);
        }
    }
}
