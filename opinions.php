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
        foreach ($sentence as $word) {
            foreach ($emotion_words as $emotion_word) {
                $emotion_word = trim($emotion_word);
                if (strcmp($word, $emotion_word) == 0) {
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
        $sentence_array = explode(" ", strtolower($sentence));
        $positive = $this->positive($sentence_array);
        $negative = $this->negative($sentence_array);
        $this->write_into_csv("This sentence has $positive positive words and $negative negative words.");
        return "This sentence has $positive positive words and $negative negative words.<br>";
    }

}

$opinion = new Opinion();
// echo $opinion->check("Suffering War-like Hug Death Love");
if(isset($_POST['emotion'])) {
    echo $opinion->check($_SESSION['sentence_text']);
} 
?>