<?php


class WeatherController
{
    public function actionView() {
        require_once('./views/weather/view.php');
        return true;
    }
}