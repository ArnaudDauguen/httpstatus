<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Add a Site'); ?>
    
    <form action="" method="POST" class="form">
        <div class="form">
            <label for="name">Enter url for website to be tracked: </label>
            <input type="text" name="url" id="url" required>
        </div>
        <div class="form">
            <input type="submit" value="Add">
        </div>
    </form>

<?php \controllers\internals\Incs::footer(); ?>
