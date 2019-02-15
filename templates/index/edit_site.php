<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Add a Site'); ?>
    
    <form action="" method="POST" class="form">
        <div class="form">
            <label for="name">Enter the new url for this website: </label>
            <input type="text" name="url" id="url" value="<?php echo $actual_url ?>" required>
        </div>
        <div class="form">
            <input type="submit" value="Edit">
        </div>
    </form>

<?php \controllers\internals\Incs::footer(); ?>
