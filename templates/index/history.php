<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Histpry'); ?>

    <table class="history">
        <tr>
            <th>Date time</th>
            <th>Status</th>
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

<?php \controllers\internals\Incs::footer(); ?>
