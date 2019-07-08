<?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 books"><?php echo $create->dropdown("books"); ?></div>
            <div class="col-4 chapters"></div>
            <div class="col-4 sentences"></div>
        </div>
        <div class="row col-12 textarea"></div>
        <div class="row col-6 book-button">
            <button type="button" class="btn btn-danger m-3 px-5 invisible check-emotions" name="check-emotions">Check book emotions</button>
            <div class="emotion-list"></div>
        </div>
        <div class="row col-6 buttons">
            <button type="button" class="btn btn-info m-3 invisible change" name="change">Change</button>
            <button type="button" class="btn btn-warning m-3 invisible restore" name="restore">Restore</button>
            <button type="button" class="btn btn-primary m-3 invisible emotions" name="emotions">Emotions</button>
        </div>
        <div class="emotions-div"></div> 
        <!-- <div class="test btn-info button-invisible"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat in provident voluptatibus eius vel magni amet quibusdam quae. Animi incidunt, illo quisquam reiciendis totam unde sapiente necessitatibus nihil autem blanditiis?</p></div> -->
        <div class="row col-12 infobox"></div>
    </div>
<!-- Osposobi buttone da spreme podatke u novu tablicu i da se nakon toga ubaci izmjenjeni sadrzaj u staru -->
    <script type="text/javascript" src="ajax.js">
    </script>

<?php include('footer.php'); ?>