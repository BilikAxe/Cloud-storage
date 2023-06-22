<div class="weatherBlock">

    <form class="weather" method="post" action="/weather">
        @csrf

        <div class="container-wrapper">
            <div class="container">
                <div>
                    <label style="text-align: center; color: black;">Weather</label><br><br>
                    <a class="city" style="color: black;">{{ $weather->name }}</a><br>
                    <a class="temp" style="color: black;">{{ round($weather->main->temp) }} &degC</a>
                </div>
                <h1 class="status"></h1>

                <label for="lng">Longitude:</label>
                <input type="text" id="lng" name="lng"><br><br>

                <label for="ltd">Latitude:</label>
                <input type="text" id="ltd" name="ltd"><br><br>

                <button class="getCoords">Get location</button>
                <button class="btn-w" id="button">Get temperature</button>
            </div>
            <script>
                const lngInput = document.querySelector('#lng');
                const ltdInput = document.querySelector('#ltd');

                const success = (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    ltdInput.value = latitude;
                    lngInput.value = longitude;
                };

                const getCoords = (event) => {
                    event.preventDefault();

                    const status = document.querySelector('.status');

                    const error = () => {
                        status.textContent = 'Failed attempt';
                    };

                    navigator.geolocation.getCurrentPosition(success, error);
                };

                document.querySelector('.getCoords').addEventListener('click', getCoords);

            </script>
        </div>
    </form>

</div>


<script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous">
</script>

<script>
    $('form.weather').submit(function(e) {
        e.preventDefault();
        let form = $(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function (data) {
                let res = JSON.parse(data);
                console.log(res);
                $('.city').html(res.city);
                $('.temp').html(Math.round(res.temp) + ' &degC');
            },
            error: function () {
                console.log("error");
            }
        })
    })
</script>

<style>
    .weatherBlock {
        position: relative;
        background-color: lightblue;
        width: 350px;
        height: 100%;
        border-radius: 10px;
        /*box-shadow: -11px 11px 22px deepskyblue, 11px -11px 22px deepskyblue;*/
        padding: 20px;
        left: 100px;
        margin-bottom: 50px;
    }
</style>
