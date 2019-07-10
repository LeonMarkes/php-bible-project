<?php
include("init.php");

if(isset($_POST['changed_text'])) {
    $database->change_sentence($_POST['changed_text']);
} 
if(isset($_POST['restore'])) {
    $database->restore_sentence();
}
if(isset($_POST['emotion'])) {
    echo $opinion->check($_SESSION['sentence_text']);
} 
if(isset($_POST['check_emotions'])) {
    $opinion->check_chapter_emotions();    
} 
if (isset($_POST['book_name'])) {
    echo $create->dropdown("chapter", $_POST['book_name']);
}
if (isset($_POST['chapter_number'])) {
    echo $create->dropdown("sentence", $_POST['chapter_number']);
}
if (isset($_POST['sentence_number'])) {
    echo $create->textarea($_POST['sentence_number']);
}

?>