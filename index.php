<?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-4"><?php echo $create->dropdown("books"); ?></div>
            <div class="col-4 chapters"></div>
            <div class="col-4 sentences"></div>
        </div>
        <div class="row col-12 textarea"></div>
    </div>

    <script type="text/javascript" src="ajax.js">
    </script>

<?php include('footer.php'); ?>