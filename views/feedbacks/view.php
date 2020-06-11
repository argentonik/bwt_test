<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/head.php' ?>

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
<!--        <ul class="pagination">-->
<!--            <li class="page-item"><a class="page-link" href="#">Назад</a></li>-->
<!--            <li class="page-item"><a class="page-link" href="/feedbacks/page-1">1</a></li>-->
<!--            <li class="page-item"><a class="page-link" href="/feedbacks/page-2">2</a></li>-->
<!--            <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--            <li class="page-item"><a class="page-link" href="#">Вперед</a></li>-->
<!--        </ul>-->
        <?php echo $pagination->get(); ?>
    </nav>
</div>

<script type="text/javascript">
    loadCSS("/template/css/feedbacks/view.css");
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php' ?>
