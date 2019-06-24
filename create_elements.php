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
                echo $first_post;
                echo $second_post;
                $values = $database->select_sentences($first_post, $second_post);
                $assoc = "sentID";
                $name = "Sentences";
                $extra_classes = "sentence";
                echo "Srbija";
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
}
$create = new Create_elements();
if (isset($_POST['book_name'])) {
    echo $create->dropdown("chapter", $_POST['book_name']);
}
if (isset($_POST['chapter_number']) && isset($_POST['book_name'])) {
    echo $_POST['chapter_number'];
    echo $_POST['book_name'];
    echo $create->dropdown("sentence", $_POST['chapter_number'], $_POST['book_name']);
}
?>