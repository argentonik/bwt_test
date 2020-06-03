<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/head.php' ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <header class="card-header">
                <h4 class="card-title mt-2">Обратная связь</h4>
            </header>
            <article class="card-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Имя </label>
                        <input type="text" name="firstName"
                               class="form-control"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Отзыв</label>
                        <textarea class="form-control" name="report" rows="4" required></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LeYCQAVAAAAABgXnFoK-1NWDCSYo7SIpy0ySqG2"></div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Отправить</button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</div>

<script type="text/javascript">
    loadCSS("/template/css/feedbacks/create.css");
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php' ?>