// GET WEATHER FROM WEATHERBIT
async function getWeatherDate(latt, long){
    const APIurl = "https://api.weatherbit.io/v2.0/current?lat=";
    const APIkey = "001ede011a474ab28fd702029b5877c3";

    // ROUND COORDINATES TO 4 DECIMALS
    var roundLatt = Number((parseFloat(latt)).toFixed(4));
    var roundLong = Number((parseFloat(long)).toFixed(4));

    url = APIurl + roundLatt + "&lon=" + roundLong + "&key=" + APIkey;
    const raw = await fetch(url);
    const response = await raw.json();

    var temperature = response.data[0].temp;
    var temperature_app = response.data[0].app_temp;
    var windspeed = response.data[0].wind_spd;
    var rainmm = response.data[0].precip;
    var snowmm = response.data[0].snow;
    var description = response.data[0].weather.description;

    var returnArr = {temp: temperature,
                    temp_app: temperature_app,
                    wind: windspeed,
                    rain: rainmm,
                    snow: snowmm,
                    desc: description
                }

    return returnArr;
}