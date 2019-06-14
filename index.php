<?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="dropdown m-5">
                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown button
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php
                    $books = $database->select_books();
                    $bible_books = array();
                    foreach($books as $book) { 
                    if (!in_array($book, $bible_books)) {?>
                         <?php echo "<a class='dropdown-item bible-book' id='"  . strtolower($book['title']) .  "' href='#'>" . $book['title'] . "</a>"; ?>
                <?php   array_push($bible_books, $book);
                }

            } ?>
                    <!-- <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </div>
            <div class="dropdown m-5">
                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown button
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    
                </div>
                <div class="chapters"></div>
            </div>
        </div>
        <div class="row mx-5">
        
            <p>
                <?php //print_r($database->select_bible_books("Genesis"));
                    foreach ($database->select_bible_books("Genesis") as $chapter) {
                        echo print_r($chapter);
                    }
                ?>
            </p>
        </div>
    </div>

    <script type="text/javascript">
        $('.bible-book').click(function(event) {
            var bookName = event.target.id;
            console.log(bookName);
            $.ajax({
                url: 'show_content.php',
                data: { book_name: bookName },
                type: 'post',
                success: function(data) {
                    $('.chapters').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
            console.log("done");
        });
    </script>

<?php include('footer.php'); ?>