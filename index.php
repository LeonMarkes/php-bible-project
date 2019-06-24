<?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="row"><?php echo $create->dropdown("books"); ?></div>
        <div class="row chapters"></div>
        <div class="row sentences"></div>
        <div class="row textarea"></div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.bible-book').click(function(event) {
            var bookName = event.target.id;
            console.log(bookName);
            console.log(event);        
            $.ajax({
                url: 'create_elements.php',
                data: { first_book_name: bookName },
                type: 'post',
                success: function(data) {
                    //$('.sentences').hide();
                    $('.chapters').html(data);
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
            console.log("done");
        });
        $('.chapters').on('click', '.chapter', function(event) {
            var chapterNumber = event.target.id, bookName = event.target.name;
            $.ajax({
                url: 'create_elements.php',
                data: { second_chapter_number: chapterNumber, second_book_name: bookName },
                type: 'post',
                success: function(data) {
                    $('.sentences').html(data);
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
            console.log("done");
        });
        $('.sentences').on('click', '.sentence', function(event) {
            var chapterNumber = event.target.id, bookName = event.target.name, sentenceNumber = event.target.innerText;
            console.log(sentenceNumber);
            console.log(chapterNumber);
            console.log(bookName);
            $.ajax({
                url: 'create_elements.php',
                data: { third_chapter_number: chapterNumber, third_book_name: bookName, third_sentence_number: sentenceNumber},
                type: 'post',
                success: function(data) {
                    $('.textarea').html(data);
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
            console.log("done");
        });
    });
        
    </script>

<?php include('footer.php'); ?>