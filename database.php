<?php
include("init.php");
require_once('config.php');

class Database {

    public $connection;
    public $test = "test";
    function __construct() {
        $this->open_db_connection(); // prilikom pozivanja, objekt će se spojiti na bazu
    }

    function open_db_connection() { // provjerava da li se spojio na bazu, u slučaju da nije, prekida se rad skripte i ispisuje se error
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_errno) {
            die('Database connection failed ' . $this->connection->connect_errno);
        }
    }

    public function query($sql) { // pošalje SQL upit na bazu i vraća dohvaćene podatke
        $result = $this->connection->query($sql); 
        return $result;
    }
    public function select_bible_books() {
        $books = $this->query("SELECT title FROM book");
        return $books;
    }
    public function select_chapters($book_name) {
        $chapters = $this->query("SELECT chaptID FROM book INNER JOIN sentence ON book.bookID = sentence.bookID WHERE title = '$book_name'");
        return $chapters;
    }
    public function select_sentences($chapter, $book_name) {
        $sentences = $this->query("SELECT sentID FROM book INNER JOIN sentence ON book.bookID = sentence.bookID WHERE title = '$book_name' AND chaptID = '$chapter'");
        return $sentences;
    }
}

$database = new Database();

// if($database->connection) {
//     echo 'spojen';
// }


?>