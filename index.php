<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Weather Project Javascript</title>
        <link rel="stylesheet" href="weather_style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
<script src="script.js" defer></script>
    </head>
    <body>
        <h1>Weather Dashboard</h1>
        <div class="container">
            <div class="weather-input">
                <h3>Enter a City Name</h3>
                <input type="city-input" placeholder="E.g.,New York,London,Tokyo">
                <button class="search-btn">Search</button>
                 <div class="separator"></div>   
                <button class="location-btn">Use Current Location</button>
            </div>
            <div class="weather-data">
                <div class="current-weather">
                    <div class="details">
                    <h2>London(2023-06-19)</h2>
                    <h4>Temperature:19.10C</h4>
                    <h4>Wind: 4.31 M/S</h4>
                    <h4>Humidity: 79%</h4>
                    </div>
                    <div class="icon">
                        <img src="https://openweathermap.org/img/wn/10d@4x.png" alt="weather-icon">
                
                <h4>Moderate Rain</h4>    
            </div>
             </div>
             <div class="days-forecast">
                <h2>5-Day Forecast</h2>
                <u1 class="weather-cards">
                    <li class="card">
                        <h3>(2023-06-19)</h3>
                         <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather-icon">
                        <h3>Temp: 10.19°C</h3>
                        <h4>Wind: 4.31 M/S</h4>
                        <h4>Humidity: 79%</h4>
                        </li>
                         <li class="card">
                        <h3>(2023-06-19)</h3>
                        <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather-icon">
                        <h3>Temp: 10.19°C</h3>
                        <h4>Wind: 4.31 M/S</h4>
                        <h4>Humidity: 79%</h4>
                        </li>
                        <li class="card">
                        <h3>(2023-06-19)</h3>
                         <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather-icon">
                        <h3>Temp: 10.19°C</h3>
                        <h4>Wind: 4.31 M/S</h4>
                        <h4>Humidity: 79%</h4>
                        </li>
                        <li class="card">
                        <h3>(2023-06-19)</h3>
                         <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather-icon">
                        <h3>Temp: 10.19°C</h3>
                        <h4>Wind: 4.31 M/S</h4>
                        <h4>Humidity: 79%</h4>
                        </li>
                        <li class="card">
                        <h3>(2023-06-19)</h3>
                         <img src="https://openweathermap.org/img/wn/10d@2x.png" alt="weather-icon">
                        <h3>Temp: 10.19°C</h3>
                        <h4>Wind: 4.31 M/S</h4>
                        <h4>Humidity: 79%</h4>
                        </li>
                </u1>
             </div>
            </div>
        </div>
         <div id="user-controls">  <?php
        session_start();
        if (isset($_SESSION['user_id'])) {
            echo "<p>Welcome, User!</p>";
            echo "<a href='logout.php'>Logout</a>";
        } else {
            echo "<p>Please <a href='login.php'>login</a> to use the weather dashboard.</p>";
        }
        ?>
    </div> 

    </body>
</html>