<?php include('header.php'); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown button
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        <div class="row mx-5">
        <?php foreach($database->select_books() as $book) { ?>
            <p>
                <?php echo $book->title; ?>
            </p>
        <?php } ?>
            <p>
                <?php print_r($database->select_books()); ?>
            </p>
        </div>
    </div>

<?php include('footer.php'); ?>