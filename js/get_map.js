// FUNCTION GET MAP FROM API
function getMap(){
    var mymap = L.map('mapid').setView([59.8586, 17.6389], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoic3Ryb2Jvc2F1ciIsImEiOiJja3A4NHNkNmEwNWdhMnpvZ2VoMnAwcDBqIn0.h3HZY-HTpvdAfIBv1T_xjQ'
    }).addTo(mymap);
    return mymap;
}