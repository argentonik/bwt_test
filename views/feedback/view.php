<div class="card" style="width: 40rem;">
    <div class="card-body">
        <?php
            for ($i = 0; $i < count($feedbacks); $i++) {
                echo '<h5 class="card-title">'.$feedbacks[$i]['firstName'].'</h6>'.
                     '<h6 class="card-subtitle mb-2 text-muted">'.$feedbacks[$i]['email'].'</h6>'.
                     '<p class="card-text">'.$feedbacks[$i]['report'].'</p>'.
                     '<p class="card-link text-muted">'.$feedbacks[$i]['date'].'</p>'.
                     '<hr>';
            }
        ?>
    </div>
    <nav aria-label="Page navigation example">
        <?php echo $pagination->get(); ?>
    </nav>
</div>
