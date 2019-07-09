<?php
include("init.php");

class Opinion {


    public function read_file($file_name) {
        $file = fopen($file_name, "r");
        $words = fread($file, filesize($file_name));
        $words_array = explode("\n", $words);
        fclose($file);
        return $words_array;
    }

    public function word_counter($sentence, $emotion_words) {
        $counter = 0;
        foreach ($emotion_words as $emotion_word) {
            $emotion_word = (string) trim($emotion_word);
            if(!empty($emotion_word)) {
                if (strpos($sentence, $emotion_word)) {
                    $counter++;
                } 
            }
            
        }
        return $counter;
    }

    public function positive($sentence) {
        $positive_words = $this->read_file("opinion-lexicon-English/positive-words.txt");
        $positive = $this->word_counter($sentence, $positive_words);
        return $positive;
    }

    public function negative($sentence) {
        $negative_words = $this->read_file("opinion-lexicon-English/negative-words.txt");
        $negative = $this->word_counter($sentence, $negative_words);
        return $negative;
    }

    public function write_into_csv($message) {
        $file = fopen("emotion-report.csv", "a+");
        $information = array($_SESSION['book'], $_SESSION['chapter'], $_SESSION['sentence'], $message);
        fputcsv($file, $information);
        fclose($file);
    }

    public function check($sentence) {
        $emotion = $this->check_positive_negative($sentence);
        $this->write_into_csv("This sentence has $emotion[0] positive words and $emotion[1] negative words.");
        return "This sentence has $emotion[0] positive words and $emotion[1] negative words.<br>";
    }
    public function check_positive_negative($sentence) {
        $positive = $this->positive($sentence);
        $negative = $this->negative($sentence);
        return array($positive, $negative);
    }
    public function check_chapter_emotions() {
        global $database;
        $array = array();
        $book = $_SESSION['book'];
        $chapters = $database->select_chapters($book);
        foreach ($chapters as $chapter) {
            if (!in_array($chapter, $array)) {
                $bible_chapter = $database->select_chapter($chapter['chaptID']);
                // print_r($bible_chapter);
                $emotions = $this->check_positive_negative($bible_chapter);
                $positive = $emotions[0];
                $negative = $emotions[1];
                echo $chapter['chaptID'] . ". chapter of $book has $positive positive and $negative negative words. <br>";
                array_push($array, $chapter);
            }
        }
    }
}

$opinion = new Opinion();
// echo $opinion->check("Suffering War-like Hug Death Love");
if(isset($_POST['emotion'])) {
    echo $opinion->check($_SESSION['sentence_text']);
} 
if(isset($_POST['check_emotions'])) {
    $opinion->check_chapter_emotions();    
} 
?>