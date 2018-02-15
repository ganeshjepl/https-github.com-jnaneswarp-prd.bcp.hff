// for pie chart


var chart = AmCharts.makeChart( "chartdiv", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "country": "Number Of MR Records(60)",
    "litres": 60
  }, {
    "country": "Number Of Red Flags(20)",
    "litres": 20
  }, {
    "country": "Number of  Incidents",
    "litres": 12
  }, {
    "country": "Number Of Patients",
    "litres": 32
  }, {
    "country": "Number Of Visits",
    "litres": 50
  }/* , {
    "country": "Austria",
    "litres": 128.3
  }, {
    "country": "UK",
    "litres": 99
  }, {
    "country": "Belgium",
    "litres": 60
  }, {
    "country": "The Netherlands",
    "litres": 50
  } */ ],
  "valueField": "litres",
  "titleField": "country",
   "balloon":{
   "fixedPosition":true
  },
  "export": {
    "enabled": false
  }
} );





