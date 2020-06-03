<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/head.php' ?>

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-8 grid-margin stretch-card">
                <!--weather card-->
                <div class="card card-weather">
                    <div class="card-body">
                        <div class="weather-date-location">
                            <h3>Friday</h3>
                            <p class="text-gray">
                                <span class="weather-date">25 March, 2019</span>
                                <span class="weather-location">Sydney, Australia</span>
                            </p>
                        </div>
                        <div class="weather-data d-flex">
                            <div class="mr-auto">
                                <h4 class="display-3">32 <span class="symbol">°</span>C</h4>
                                <p> Cloudy </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex weakly-weather">
                            <div class="weakly-weather-item">
                                <p class="mb-0"> Sun </p> <i class="mdi mdi-weather-cloudy"></i>
                                <p class="mb-0"> 30° </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1"> Mon </p> <i class="mdi mdi-weather-hail"></i>
                                <p class="mb-0"> 31° </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1"> Tue </p> <i class="mdi mdi-weather-partlycloudy"></i>
                                <p class="mb-0"> 28° </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1"> Wed </p> <i class="mdi mdi-weather-pouring"></i>
                                <p class="mb-0"> 30° </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1"> Thu </p> <i class="mdi mdi-weather-pouring"></i>
                                <p class="mb-0"> 29° </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1"> Fri </p> <i class="mdi mdi-weather-snowy-rainy"></i>
                                <p class="mb-0"> 31° </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1"> Sat </p> <i class="mdi mdi-weather-snowy"></i>
                                <p class="mb-0"> 32° </p>
                            </div>
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
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php' ?>
