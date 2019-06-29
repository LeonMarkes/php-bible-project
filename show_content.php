<?php 
require_once('init.php');
if($_POST['book_name']) {
    $book = $_POST['book_name'];
    $chapters = array();
    echo "<div class='dropdown m-5'>";
    echo "<button class='btn btn-warning dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Chapters</button>";
    echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
    foreach ($database->select_bible_books($book) as $chapter) {
        if (!in_array($chapter, $chapters)) {
            echo "<a class='dropdown-item bible-book' id='"  . $chapter['chaptID'] .  "' href='#'>" . $chapter['chaptID'] . "</a>";
            array_push($chapters, $chapter);
        }
    }
    echo "</div></div>";

}
?>