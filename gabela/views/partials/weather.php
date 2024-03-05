<div id="subheader">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <h1>Current Weather</h1>
                        <span>
                            <?php 
                            $config = include BASE_PATH . '/gabela/config/config.php';

                            if (isset($config['weather']['apikey']) && is_string($config['weather']['apikey'])) {
                                $apiKey = $config['weather']['apikey'];
                            } else {
                                $apiKey = $config['weather']['apikey'][0];
                            }

                            $users = New \Gabela\Model\User();
                            $city = $users->getWeatherCity();
                            
                            $weatherData = getCurrentWeather($city, $apiKey); 
                            
                            ?>

                            <!-- Styling for weather information -->
                            <div>
                                <!-- <h3>Current Weather</h3> -->
                                <ul>
                                     <li><strong>City:</strong> <?php echo isset($weatherData["name"]) ? $weatherData["name"] : "Sorry!! Your City can't be pulled by OpenWeather use the correct api key"; ?></li>
                                    <li> <strong>Current Temp</strong>: <?php echo isset($weatherData["main"]["temp"]) ? $weatherData["main"]["temp"] . "°C" : ""; ?></li>
                                    <li> <strong>Weather:</strong> <?php echo isset($weatherData["weather"][0]["description"]) ? $weatherData["weather"][0]["description"] : ""; ?></li>
                                </ul>
                            </div>
                        </span>