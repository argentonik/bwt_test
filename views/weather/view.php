<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/head.php' ?>

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-8 grid-margin stretch-card">
                <!--weather card-->
                <div class="card card-weather">
                    <div class="card-body">
                        <div class="weather-date-location">
                            <h3>Сегодня</h3>
                            <p class="text-gray">
                                <span class="weather-date"><?php echo $date; ?></span><br/>
                                <span class="weather-location">Украина, Запорожье</span>
                            </p>
                        </div>
                        <div class="weather-data d-flex">
                            <div class="mr-auto">
                                <h4 class="display-3"><?php echo $nowTemperature; ?> <span class="symbol">°</span>C</h4>
                                <p><?php echo $nowWeather ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex weakly-weather">
                            <?php
                                for ($i = 0; $i < count($hoursArray); $i++) {
                                    echo '<div class="weakly-weather-item">'.
                                            '<p class="mb-0">'.$hoursArray[$i].'</p>'.
                                            '<i class="mdi '.$weatherToHours[$i][0]['img'].'" title="'.
                                            $weatherToHours[$i][0]['text'].'"></i>'.
                                         '<p class="mb-0">'.$temperaturToHours[$i].'</p></div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!--weather card ends-->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    loadCSS("template/css/weather/style.css");
    loadCSS('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css');
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php' ?>

