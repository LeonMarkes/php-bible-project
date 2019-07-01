<?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-4"><?php echo $create->dropdown("books"); ?></div>
            <div class="col-4 chapters"></div>
            <div class="col-4 sentences"></div>
        </div>
        <div class="row col-12 textarea"></div>
        <div class="row col-6 buttons" style="display: none;">
            <button type='button' class='btn btn-info m-3 change' name='change'>Change</button>
            <button type='button' class='btn btn-warning m-3 restore' name='restore'>Restore</button>
        </div>
        <div class="row col-12 infobox"></div>
    </div>
<!-- Osposobi buttone da spreme podatke u novu tablicu i da se nakon toga ubaci izmjenjeni sadrzaj u staru -->
    <script type="text/javascript" src="ajax.js">
    </script>

<?php include('footer.php'); ?>