<?php
require_once('init.php');
class Create_elements {
    public function dropdown($content, $book = NULL, $chapter = NULL) {
        global $database;
        global $session;

        $array = array();
        switch($content) {
            case "books":
                $values = $database->select_bible_books();
                $assoc = "title";
                $name = "Choose a book";
                $extra_classes = "bible-book";
                break;
            case "chapter":
                $values = $database->select_chapters($book);
                $session->set_variable("book", $book);
                $assoc = "chaptID";
                $name = "Choose a chapters";
                $extra_classes = "chapter";
                break;
            case "sentence":
                $values = $database->select_sentences($book, $chapter);
                $session->set_variable("chapter", $chapter);
                $assoc = "sentID";
                $name = "Choose a sentences";
                $extra_classes = "sentence";
                break;
        }

        $dropdown = "<div class='dropdown m-5'>";
        $dropdown .= "<button class='btn btn-success dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$name</button>";
        $dropdown .= "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
        foreach ($values as $value) {
            if (!in_array($value, $array)) {
                $dropdown .= "<a class='dropdown-item " . $extra_classes ."' id='"  . ($assoc == "sentID" ? $value['title'] : $value[$assoc]) .  "' name='" . $book . "' href='#'>" . $value[$assoc] . "</a>";
                array_push($array, $value);
            }
        }
        $dropdown .= "</div></div>";
        // echo '<pre>';
        // var_dump($_SESSION);
        // echo '</pre>';
        return $dropdown;
    }
    public function textarea($sentence_number) {
        global $database;
        global $session;
        $session->set_variable("sentence", $sentence_number);
        $sentence = $database->select_sentence($_SESSION['book'], $_SESSION['chapter'], $_SESSION['sentence'])->fetch_assoc();
        $textarea = $_SESSION['book'] . " " . $_SESSION['chapter'] . ":" . $_SESSION['sentence'] .  "<br>";
        $textarea .= "<textarea class='col-12 bible-text' name='edited_sentence' form='textareaForm' rows='6' cols='66'>";
        $textarea .= $sentence['sentence'];
        $textarea .= "</textarea>";
        $session->set_variable('sentence_text', $sentence['sentence']);
        // var_dump($_SESSION);
        return $textarea;
    }
}
$create = new Create_elements();
if (isset($_POST['first_book_name'])) {
    echo $create->dropdown("chapter", $_POST['first_book_name']);
}
if (isset($_POST['second_chapter_number']) && isset($_POST['second_book_name'])) {
    echo $create->dropdown("sentence", $_POST['second_book_name'], $_POST['second_chapter_number']);
}
if (isset($_POST['third_chapter_number']) && isset($_POST['third_sentence_number']) && isset($_POST['third_book_name'])) {
    echo $create->textarea($_POST['third_sentence_number']);
}
?>