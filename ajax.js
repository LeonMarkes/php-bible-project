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
                //console.log(data);
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
                //console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
        console.log("done");
    });
    $('.sentences').on('click', '.sentence', function(event) {
        var bookName = event.target.id, chapterNumber = event.target.name, sentenceNumber = event.target.innerText;
        $.ajax({
            url: 'create_elements.php',
            data: { third_chapter_number: chapterNumber, third_book_name: bookName, third_sentence_number: sentenceNumber},
            type: 'post',
            success: function(data) {
                $('buttons').css({"display":"block"});
                $('.textarea').html(data);
                // neka se pokažu buttoni i neka se proslijedi vrijednost textaree na drugi php file
                console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
        console.log("done");
    });
    $('.change').on('click', '.buttons', function(event) {
       var changedText =  $('.bible-text').val();
        console.log(changedText);
       $.ajax({
           url: 'database.php',
           data: {changed_text: changedText},
           type: 'post',
           success: function(data) {
               if(data) {
                   console.log("Original sentence is saved.")
                   if(data) {
                       $('.infobox').html("<p>Sentence has been changed.<p>");
                   } else {
                       $('.infobox').html("<p>Reka san ne može!<p>");
                   }
               }
           },
           error: function(error) {
               console.log(error);
           }
       });
    });
    $('.restore').on('click', '.buttons', function(event) {
        // neka se ovdje ubaci pokrene druga skripta gdje će se usporediti da li postoji tekst u orig_sent i onda će se obnoviti, ili ako nije zamjenjen neka se prikaže tekst iz sessiona
        var restore = true;
        $.ajax({
            url: 'database.php',
            data: {restore: restore},
            type: 'post',
            success: function(data) {
                if(data) {
                    console.log("Original sentence has been restored.")
                    $('.textarea').html(data);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    
    
});
    