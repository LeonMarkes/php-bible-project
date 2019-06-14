<?php 
require('init.php');
if($_POST['book_name']) {
    $book = $_POST['book_name'];
    foreach ($database->select_bible_books($book) as $chapter) {
        echo $chapter['chaptID'];
    }
    echo $book;

}
?>