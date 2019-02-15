<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Login'); ?>
    
    <form action="" method="POST" class="form">
        <div class="form">
            <label for="name">Enter your email: </label>
            <input type="email" name="email" id="name" required>
        </div>
        <div class="form">
            <label for="email">Enter your password: </label>
            <input type="password" name="password" id="email" required>
        </div>
        <div class="form">
            <input type="submit" value="Connection">
        </div>
    </form>

<?php \controllers\internals\Incs::footer(); ?>
