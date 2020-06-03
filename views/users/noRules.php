<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/head.php' ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-2 text-center">
            <p><i class="fa fa-lock fa-5x"></i></p>
        </div>
        <div class="col-md-10">
            <h3>Авторизируйте для просмотра</h3>
            <p>У вас нет доступа к просмотру этой страницы. Попробуйте авторизироваться.</p>
            <a class="btn btn-danger" href="/signIn" ">Войти</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    loadCSS("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css");
    loadCSS("/template/css/user/noRules.css");
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php' ?>