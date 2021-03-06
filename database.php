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
    public function select_chapter($selected_chapter) {
        // global $session;
        // tu se u chapdID proslijeđuje string 
        $chapter = $this->query("SELECT sentence FROM book INNER JOIN sentence ON book.bookID = sentence.bookID WHERE title = '" . $_SESSION['book'] . "' AND chaptID = $selected_chapter");
        while ($row = mysqli_fetch_assoc($chapter)) {
            $chapterarray[] = $row['sentence'];
        }
        $text = implode(" ", $chapterarray);
        return $text;
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
        echo $sentence . "<br>";
        echo $_SESSION['chapter'] . "<br>";
        echo $_SESSION['sentence'] . "<br>";
        $bookId = $this->query("SELECT bookID FROM sentence WHERE sentence = '$sentence' AND chaptID = " . $_SESSION['chapter'] . " AND sentID = " . $_SESSION['sentence'] . ";");
        return $bookId;
    }
    public function change_sentence($new_sentence) {
        $chaptId = (int) $_SESSION['chapter'];
        $sentId = (int) $_SESSION['sentence'];
        $orig_sentence = (string) $_SESSION['sentence_text'];

        $bookId = $this->get_book_id($orig_sentence)->fetch_assoc();
        $bookId = $bookId['bookID'];
        $sentence = addslashes((string) $new_sentence);

        echo "Sentence: " . strlen($sentence) . "<br>";
        echo "Original sentence: " . strlen($orig_sentence) . "<br>";

        if (strlen($sentence) < (strlen($orig_sentence) / 2)) {
            echo "Sentence is too short, please change it.";
            return false;
        }
        if (!$this->query("INSERT INTO `origsentence` (chaptID, sentID, content, bookID) VALUES ({$chaptId}, {$sentId}, '{$orig_sentence}', {$bookId})")) {
            printf("Error message: %s\n", $this->connection->error);
        } else {
            $time = date('d, m, Y H:i:s');
            $this->query("UPDATE sentence SET sentence = '$sentence', updated = '$time' WHERE bookID = '$bookId'");
        }

        return $bookId;
    }
    public function restore_sentence() {
        $chaptId = (int) $_SESSION['chapter'];
        $sentId = (int) $_SESSION['sentence'];
        $changed_sentence = (string) $_SESSION['sentence_text']; // Ili session ne radi ili se ubacuje prazna varijabla
        $bookId = $this->get_book_id($changed_sentence)->fetch_assoc();
        $bookId = $bookId['bookID'];

        $orig_sentence = $this->query("SELECT content FROM origsentence WHERE chaptID = $chaptId AND sentID= $sentId AND bookID= $bookId")->fetch_assoc();
        $orig_sentence = $orig_sentence['content'];
        $time = date('d, m, Y H:i:s');
        $this->query("UPDATE sentence SET sentence = '$orig_sentence', updated = '$time' WHERE bookID = '$bookId'");

        return $orig_sentence;
    }
}

$database = new Database();


// if($database->connection) {
//     echo 'spojen';
// }


?>