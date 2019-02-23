<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Histpry'); ?>

    <div class="container">
        <table class="history table mt-3">
            <tr>
                <th scope="col">Date time</th>
                <th scope="col">Status</th>
            </tr>
            <?php
                foreach($complete_history as $key => $history){
            ?>
                <tr class="<?php echo $history['status']; ?>">
                    <td><?php echo $history['update_time']; ?></td>
                    <td><?php echo $history['status']; ?></td>
                </tr>

            <?php
                }
            ?>

        </table>
    </div>


<?php \controllers\internals\Incs::footer(); ?>
