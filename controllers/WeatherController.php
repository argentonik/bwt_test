<?php


class WeatherController
{
    public function actionView() {
        if (User::checkLogged()) {
            require_once('./views/weather/view.php');
        } else {
            header('HTTP/1.0 403 Forbidden');
            require_once('./views/users/noRules.php');
        }

        return true;
    }
}