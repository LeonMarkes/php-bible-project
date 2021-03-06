<?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 mx-2 p-1 books"><?php echo $create->dropdown("books"); ?></div>
            <div class="col-2 mx-2 p-1 chapters"></div>
            <div class="col-2 mx-2 p-1 sentences"></div>
        </div>
        <div class="row">
            <div class="col-12 textarea"></div>
        </div>
        <div class="row">
            <div class="col-6 book-button">
                <button type="button" class="btn btn-danger m-3 px-5 invisible check-emotions" name="check-emotions">Check book emotions</button>
                <div class="emotion-list"></div>
            </div>
            <div class="col-6 buttons">
                <button type="button" class="btn btn-info m-3 invisible change" name="change">Change</button>
                <button type="button" class="btn btn-warning m-3 invisible restore" name="restore">Restore</button>
                <button type="button" class="btn btn-primary m-3 invisible emotions" name="emotions">Emotions</button>
            </div>
        </div>
        
        <div class="emotions-div"></div> 
        <!-- <div class="test btn-info button-invisible"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat in provident voluptatibus eius vel magni amet quibusdam quae. Animi incidunt, illo quisquam reiciendis totam unde sapiente necessitatibus nihil autem blanditiis?</p></div> -->
        <div class="row">
            <div class="col-12 infobox"></div>
        </div>
    </div>
<!-- Osposobi buttone da spreme podatke u novu tablicu i da se nakon toga ubaci izmjenjeni sadrzaj u staru -->
    <script type="text/javascript" src="ajax.js">
    </script>

<?php include('footer.php'); ?>