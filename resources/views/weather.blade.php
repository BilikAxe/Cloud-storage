<div>
    <label>Weather</label><br><br>
    <a class="city">City</a><br>
    <a class="temp">Temperature</a>
</div>
<script>
    const city = document.querySelector('.city');
    const temp = document.querySelector('.temp');
    const success = (position) => {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        const weatherApiUrl = `https://api.openweathermap.org/data/2.5/weather?lang=ru&units=metric&lat=${latitude}&lon=${longitude}&appid=3427e46e775a5088d92cbe525359edf0`
        fetch(weatherApiUrl)
            .then(res => res.json())
            .then(data => {
                city.textContent = data.name
                temp.textContent = Math.round(data.main.temp) + ' °C'
            })
    }
    const error = () => {
        console.log('error')
    }
    navigator.geolocation.getCurrentPosition(success, error);
</script>
