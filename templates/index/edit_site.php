<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Add a Site'); ?>
    
    <div class="container">
    
        <form action="" method="POST" class="form">
            <h3>Change usite url </h3>
            <div class="form-group">
                <label for="name">Enter the new url for this website: </label> </br>
                <input type="text" name="url" id="url" value="<?php echo $actual_url ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Edit</button>
        </form>

    </div>



<?php \controllers\internals\Incs::footer(); ?>
