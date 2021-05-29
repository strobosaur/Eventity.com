const weatherAPI = 'https://api.met.no/weatherapi/locationforecast/2.0/compact?';

async function getWeatherDate(latt,long,sdate,hour){

    console.log(latt);
    console.log(long);
    console.log(sdate);
    console.log(hour);

    var roundLatt = Number((parseFloat(latt)).toFixed(4));
    var roundLong = Number((parseFloat(long)).toFixed(4));

    //roundLatt = latt.substr(0,7);
    //roundLong = long.substr(0,7);

    console.log(roundLatt);
    console.log(roundLong);
    
    const response = await fetch(weatherAPI + 'lat=' + roundLatt + '&lon=' + roundLong + '');
    const parsed = await response.json();

    var daysArr = parsed.properties.timeseries;
    console.log(daysArr);

    for(var i = 0; i < daysArr.length; i++){
        var time = daysArr[i].time.substr(0,13);
        console.log(time);
        var dateTime = time.split("T");
        console.log(dateTime);
        if((dateTime[0] == sdate) && (dateTime[1] == hour)){

            var weatherHour = daysArr[i];

            var temperature = weatherHour.data.instant.details.air_temperature;
            var windspd = weatherHour.data.instant.details.wind_speed;
            var rainmm = weatherHour.data.next_1_hours.details.precipitation_amount;
            var description = weatherHour.data.next_12_hours.summary.symbol_code;
            
            var returnArr = {temp: temperature,
                            wind: windspd,
                            rain: rainmm,
                            desc: description};

            console.log(returnArr);

            return returnArr;
        }
    }

    return false;
}