<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Add a Site'); ?>
    
    <div class="container">

        <form action="" method="POST" class="form">
            <h3>Add a site to track</h3>
            <div class="form-group">
                <label for="name">url : </label> </br>
                <input type="text" name="url" id="url" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
        </form>

    </div>

<?php \controllers\internals\Incs::footer(); ?>
