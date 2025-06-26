
const cityInput = document.querySelector(".weather-input input");
const searchBtn = document.querySelector(".weather-input button");
const currentWeatherDiv = document.querySelector(".current-weather");
const forecastWeatherDiv = document.querySelector(".days-forecast");
const weatherCardsDiv = document.querySelector(".weather-cards");
const locationBtn=document.querySelector(".location-btn");

const API_KEY = "af52329153401880cd7dcbc9b869a80c";  // Replace with your actual OpenWeatherMap API key

const createWeatherCard = (weatherData, cityName, isCurrentWeather) => {
    const { main, weather, wind } = weatherData;
    const { temp, humidity } = main;
    const { description, icon } = weather[0];

    const date = new Date(weatherData.dt * 1000).toLocaleDateString();

    if (isCurrentWeather) {
        return `<div class="details">
                    <h2>${cityName} (${date})</h2>
                    <h4>Temperature: ${temp.toFixed(2)}°C</h4>
                    <h4>Wind: ${wind.speed} M/S</h4>
                    <h4>Humidity: ${humidity}%</h4>
                </div>
                <div class="icon">
                    <img src="https://openweathermap.org/img/wn/${icon}@4x.png" alt="weather-icon">
                    <h4>${description}</h4>
                </div>`;
    } else {
        return `<li class="card">
                    <h3>(${date})</h3>
                    <img src="https://openweathermap.org/img/wn/${icon}@2x.png" alt="weather-icon">
                    <h3>Temp: ${temp.toFixed(2)}°C</h3>
                    <h4>Wind: ${wind.speed} M/S</h4>
                    <h4>Humidity: ${humidity}%</h4>
                </li>`;
    }
};

const getWeatherDetails = (cityName, latitude, longitude) => {
    const WEATHER_API_URL = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${API_KEY}&units=metric`;

    fetch(WEATHER_API_URL)
        .then(response => response.json())
        .then(weatherData => {
            const forecast_API_URL = `https://api.openweathermap.org/data/2.5/forecast?lat=${latitude}&lon=${longitude}&appid=${API_KEY}&units=metric`;
            fetch(forecast_API_URL)
                .then(response => response.json())
                .then(forecastData => {
                    const currentWeatherHTML = createWeatherCard(weatherData, cityName, true);
                    currentWeatherDiv.innerHTML = currentWeatherHTML;

                    const fiveDaysForecast = forecastData.list.filter((data, index) => index % 8 === 0);
                    const weatherCardsHTML = fiveDaysForecast.map(weather => createWeatherCard(weather, cityName, false)).join("");
                    weatherCardsDiv.innerHTML = weatherCardsHTML;
                }).catch(() => {
                    alert("Error fetching weather forecast!");
                });
        })
        .catch(() => {
            alert("Error fetching weather!");
        });
};

const getCityCoordinates = () => {
    const cityName = cityInput.value.trim();
    if (!cityName) return;
    const GEOCODING_API_URL = `https://api.openweathermap.org/geo/1.0/direct?q=${cityName}&limit=1&appid=${API_KEY}`;

    fetch(GEOCODING_API_URL)
        .then(response => response.json())
        .then(result => {
            if (!result.length) return alert(`No coordinates found for ${cityName}`);
            const { name, lat, lon } = result[0];
            getWeatherDetails(name, lat, lon);
        })
        .catch(() => {
            alert("Error fetching coordinates!");
        });
};

const getUserCoordinates = () => {
    navigator.geolocation.getCurrentPosition(
        position => {
            const { latitude, longitude } = position.coords;
            console.log("User coordinates:", latitude, longitude); // DEBUG
            const REVERSE_GEOCODING_URL = `https://api.openweathermap.org/geo/1.0/reverse?lat=${latitude}&lon=${longitude}&limit=1&appid=${API_KEY}`;

            fetch(REVERSE_GEOCODING_URL)
                .then(response => response.json())
                .then(result => {
                    if (!result.length) {
                        alert("Could not detect city.");
                        return;
                    }
                    const { name } = result[0];
                    getWeatherDetails(name, latitude, longitude);
                })
                .catch(() => alert("Error fetching city name!"));
        },
        error => {
            console.error("Geolocation error:", error); // DEBUG
            if (error.code === error.PERMISSION_DENIED) {
                alert("Geolocation request denied. Please reset location permission.");
            } else {
                alert("Geolocation request error. Please try again.");
            }
        }
    );
};


searchBtn.addEventListener("click", getCityCoordinates);
cityInput.addEventListener("keypress", e => {
    if (e.key === "Enter") {
        getCityCoordinates();
    }
});

locationBtn.addEventListener("click", getUserCoordinates);