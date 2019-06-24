<?php
require('init.php');
class Create_elements {
    public function dropdown($content, $first_post = "", $second_post = "") {
        global $database;
        $array = array();
        switch($content) {
            case "books":
                $values = $database->select_bible_books();
                $assoc = "title";
                $name = "Choose a book";
                $extra_classes = "bible-book";
                break;
            case "chapter":
                $values = $database->select_chapters($first_post);
                $assoc = "chaptID";
                $name = "Chapters";
                $extra_classes = "chapter";
                break;
            case "sentence":
                $values = $database->select_sentences($first_post, $second_post);
                $assoc = "sentID";
                $name = "Sentences";
                $extra_classes = "sentence";
                break;
        }
        $dropdown = "<div class='dropdown m-5'>";
        $dropdown .= "<button class='btn btn-warning dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$name</button>";
        $dropdown .= "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
        foreach ($values as $value) {
            if (!in_array($value, $array)) {
                $dropdown .= "<a class='dropdown-item " . $extra_classes ."' id='"  . $value[$assoc] .  "' name='" . $first_post . "' href='#'>" . $value[$assoc] . "</a>";
                array_push($array, $value);
            }
        }
        $dropdown .= "</div></div>";
        return $dropdown;
    }
    public function textarea($book_name, $chapter_number, $sentence_number) {
        global $database;
        $sentence = $database->select_sentence($book_name, $chapter_number, $sentence_number)->fetch_assoc();
        echo $sentence['sentence'];
        //ne prikazuje se rečenica, probaj na neki drugi način dohvatiti podatke
        $textarea = "<textarea name='sentence' form='textareaForm'>";
        $textarea .= $sentence['sentence'];
        $textarea .= "</textarea>";
        return $textarea;
        
    }
}
$create = new Create_elements();
if (isset($_POST['first_book_name'])) {
    echo $create->dropdown("chapter", $_POST['first_book_name']);
}
if (isset($_POST['second_chapter_number']) && isset($_POST['second_book_name'])) {
    echo $create->dropdown("sentence", $_POST['second_chapter_number'], $_POST['second_book_name']);
}
if (isset($_POST['third_chapter_number']) && isset($_POST['third_sentence_number']) && isset($_POST['third_book_name'])) {
    echo "IMAMO PRECJEDNICU!!!";
    echo $create->textarea($_POST['third_chapter_number'], $_POST['third_sentence_number'], $_POST['third_book_name']);
}
?>