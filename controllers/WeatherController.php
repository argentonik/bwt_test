<?php

require_once 'vendor/autoload.php';

use Rct567\DomQuery\DomQuery;

class WeatherController
{
    const URL_FOR_PARSE = 'http://www.gismeteo.ua/city/daily/5093/';

    const HOURS_ARRAY = array('0:00', '3:00', '6:00', '9:00', '12:00', '15:00', '18:00', '21:00');

    const WEATHER_NAMES = [
        'ясноДень' => 'mdi-weather-sunny',
        'ясноНочь' => 'mdi-weather-night',
        'туман' => 'mdi-weather-fog',
        'малооблачно' => 'mdi-weather-partlycloudy',
        'облачно' => 'mdi-weather-cloudy',
        'пасмурно' => 'mdi-weather-cloudy',
        'небольшой дождь' => 'mdi-weather-rainy',
        'дождь' => 'mdi-weather-rainy',
        'гроза' => 'mdi-weather-lightning-rainy',
        'град' => 'mdi-weather-hail',
        'снег' => 'mdi-weather-snowy'
    ];

    public function actionView() {
        if (User::checkLogged()) {
            $content = $this->getContent();

            // prepare base values
            $hoursArray = self::HOURS_ARRAY;

            // parse and prepare data
            $date = $content->find('.tabs._center > div .date')[0]->text();
            $nowTemperature = $content->find('.js_meas_container.temperature.tab-weather__value > span')->text();
            $nowWeather = $content->find('.tab.tablink.tooltip')->attr('data-text');

            $weatherToHours = $this->prepareWeatherBlocks($content->find('.widget__row_icon span'));
            $temperaturToHours = $this->prepareTemperaturToHours($content);

            require_once('./views/weather/view.php');
        } else {
            header('HTTP/1.0 403 Forbidden');
            require_once('./views/users/noRules.php');
        }

        return true;
    }

    private function getContent() {
        $htmlcode = file_get_contents(self::URL_FOR_PARSE);
        return new DomQuery($htmlcode);
    }

    private function prepareWeatherToView($weather, $indexOfTime) {
        $weathers = explode(',', $weather->attr('data-text'));
        $weatherName = mb_strtolower(trim(array_pop($weathers)));
        $img = array_key_exists($weatherName, self::WEATHER_NAMES) ? $weatherName : 'ясно';
        if ($img === 'ясно') {
            $img = $indexOfTime < 2 || $indexOfTime == 7 ? 'ясноНочь' : 'ясноДень';
        }
        return $img;
    }

    private function prepareWeatherBlocks($tempWeather) {
        $weatherToHours = [];
        for($i = 0; $i < $tempWeather->count(); $i++) {
            $img = $this->prepareWeatherToView($tempWeather[$i], $i);
            $weather[] = array(
                'text' => $tempWeather[$i]->attr('data-text'),
                'img' => self::WEATHER_NAMES[$img]
            );
            array_push($weatherToHours, $weather);
            unset($weather);
        }
        return $weatherToHours;
    }

    private function prepareTemperaturToHours($content) {
        $temperaturToHours = [];
        $tempWeather = $content->find('.chart__temperature .unit_temperature_c');
        for($i = 0; $i < $tempWeather->count(); $i++) {
            array_push($temperaturToHours, $tempWeather[$i]->text());
        }
        return $temperaturToHours;
    }
}