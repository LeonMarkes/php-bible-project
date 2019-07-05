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
    public function select_sentences($book_name, $chapter) {
        $sentences = $this->query("SELECT sentID, title FROM book INNER JOIN sentence ON book.bookID = sentence.bookID WHERE title = '$book_name' AND chaptID = '$chapter'");
        return $sentences;
    }
    public function select_sentence($book_name, $chapter, $sentence) {
        $the_sentence = $this->query("SELECT sentence FROM book INNER JOIN sentence ON book.bookID = sentence.bookID WHERE title = '$book_name' AND chaptID = '$chapter' AND sentID = '$sentence'");
        return $the_sentence;
    }
    public function get_book_id($sentence) {
        global $session;
        $bookId = $this->query("SELECT bookID FROM sentence WHERE sentence = '$sentence' AND chaptID = " . $_SESSION['chapter'] . " AND sentID = " . $_SESSION['sentence'] . ";");
        return $bookId;
    }
    public function change_sentence($new_sentence) {
        // $book = (string) $_SESSION['book'];
        $chaptId = (int) $_SESSION['chapter'];
        $sentId = (int) $_SESSION['sentence'];
        $orig_sentence = (string) $_SESSION['sentence_text'];
        echo "e";
        echo $new_sentence;
            echo "Uspijeh";
            $bookId = (int) $this->get_book_id($orig_sentence);
            $sentence = addslashes((string) $new_sentence);       
            if (!$this->query("INSERT INTO `origsentence` (chaptID, sentID, content, bookID) VALUES ({$chaptId}, {$sentId}, '{$orig_sentence}', {$bookId})")) {
                printf("Error message: %s\n", $this->connection->error);
            } else {
                $time = date('d, m, Y H:i:s');
                $this->query("UPDATE sentence SET sentence = '$sentence', updated = '$time' WHERE bookID = '$bookId'");
            }
            echo "true";
            return true;
        
        
    }
    public function restore_sentence() {
        $chaptId = (int) $_SESSION['chapter'];
        $sentId = (int) $_SESSION['sentence'];
        $changed_sentence = (string) $_SESSION['sentence_text'];
        $bookId = (int) $this->get_book_id($changed_sentence);
        $orig_sentence = $this->query("SELECT content FROM orig_sentence WHERE chaptID = '$chaptId', sentID='$sentId', bookID='$bookId'");
        $time = date('d, m, Y H:i:s');
        $this->query("UPDATE sentence SET sentence = '$orig_sentence', updated = '$time' WHERE bookID = '$bookId'");
        return $orig_sentence;
    }
}

$database = new Database();

if(isset($_POST['changed_text'])) {
    echo "huehuehueheueuehue0";
    echo $_POST['changed_text'] . "oiwdopqwuhdipquwgdoizqsgdsćijqwoijqqqqqqqqqqqqqqqqqqqqqqqqqqq";
    $v = $database->change_sentence($_POST['changed_text']);
    if($v) {
        echo "pcwpeomcpemcvn";
        echo "Sentence has been changed.";
    } else {
        echo "error";
    }
} else {
    echo "Reka sam !JNe može!";
}
if(isset($_POST['restore'])) {
    if($database->restore_sentence()) {
        echo "Sentence has been restored.";
    } else {
        echo "error";
    }
}
// if($database->connection) {
//     echo 'spojen';
// }


?>