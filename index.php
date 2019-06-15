<?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="row"><?php echo $create->dropdown("books"); ?></div>
        <div class="row chapters"></div>
        <div class="row sentences"></div>
        <div class="row mx-5"></div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.bible-book').click(function(event) {
            var bookName = event.target.id;
            console.log(bookName);
            console.log(event);        
            $.ajax({
                url: 'create_elements.php',
                data: { book_name: bookName },
                type: 'post',
                success: function(data) {
                    $('.chapters').html(data);
                    $('a.chapter').load($(this).attr('class'));
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
            console.log("done");
        });
        $('body').on('click', 'chapter', function(event) {
            console.log("klik");
            var chapterNumber = event.target.id, bookName = event.target.name;
            console.log(chapterNumber);
            console.log(bookName);
            $.ajax({
                url: 'create_elements.php',
                data: { chapter_number: chapterNumber, book_name: bookName },
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
    });
        
    </script>

<?php include('footer.php'); ?>