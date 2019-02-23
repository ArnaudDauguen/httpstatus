<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Login'); ?>
    
    <div class="container">
        <form action="" method="POST" class="form">
            <div class="form-group">
                <label for="name">Enter your email: </label>
                <input type="email" class="form-control" name="email" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Enter your password: </label>
                <input type="password" class="form-control" name="password" id="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Loggin</button>
        </form>
    </div>



<?php \controllers\internals\Incs::footer(); ?>
