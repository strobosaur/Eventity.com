// API ADRESS
const weatherAPI = 'https://api.met.no/weatherapi/locationforecast/2.0/compact?';

// FUNCTION GET WEATHER DATA FROM API
async function getWeatherDate2(latt,long,sdate,hour){

    // ROUND COORDINATES TO 4 DECIMALS (REQUIRED BY API)
    var roundLatt = Number((parseFloat(latt)).toFixed(4));
    var roundLong = Number((parseFloat(long)).toFixed(4));
    
    // FETCH WEATHER DATA FOR INPUT
    const response = await fetch(weatherAPI + 'lat=' + roundLatt + '&lon=' + roundLong + '');
    const parsed = await response.json();

    // MAKE ARRAY WITH ONLY WEATHER FORECAST
    var daysArr = parsed.properties.timeseries;

    // ITERATE ARRAY AND LOOK FOR THE DATE MATCHING THE INPUT
    for(var i = 0; i < daysArr.length; i++){

        // SHORTEN WEATHER DATA TIME STRING
        var time = daysArr[i].time.substr(0,13);

        // SPLIT WEATHER DATA TIME STRING (DATE / HOUR)
        var dateTime = time.split("T");

        // IF DATE MATCH FOUND...
        if((dateTime[0] == sdate) && (dateTime[1] == hour)){

            var weatherHour = daysArr[i];

            var temperature = weatherHour.data.instant.details.air_temperature;
            var windspd = weatherHour.data.instant.details.wind_speed;
            var rainmm = weatherHour.data.next_1_hours.details.precipitation_amount;
            var description = weatherHour.data.next_12_hours.summary.symbol_code;
            
            // CREATE ARRAY WITH TEMPERATURE, WIND SPEED, RAIN, AND GENERAL INFO
            var returnArr = {temp: temperature,
                            wind: windspd,
                            rain: rainmm,
                            desc: description};

            return returnArr;
        }
    }

    return false;
}