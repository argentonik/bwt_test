<?php 
$userModel = new models\User();
$currentUser = $userModel->checkLogged(); ?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/template/css/style.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>" />
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/template/js/script.js"></script>
    <title>layout</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">bwt-test</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <?php
                if ($currentUser) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="/feedback">Отзывы</a>
                          </li>';
                } ?>
                <li class="nav-item">
                    <a class="nav-link" href="/feedback/create">Добавить отзыв</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
                if ($currentUser) {
                    echo <<<EOL
                        <li class="nav-item" >
                            <a href="/logout">
                                <button type="button" class="btn btn-outline-secondary">Выйти</button>
                            </a>
                        </li>
EOL;
                } else {
                    echo <<<EOL
                        <li class="nav-item mr-2" >
                            <a href="/signIn">
                                <button type="button" class="btn btn-outline-secondary">Войти</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/registration">
                                <button type="button" class="btn btn-outline-secondary">Зарегистрироваться</button>
                            </a>
                        </li>
EOL;
                } ?>
            </ul>
        </div>
    </nav>

    <?php echo $content ?>

    </body>
</html>