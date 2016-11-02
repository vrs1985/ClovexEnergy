$(document).ready(function() {
    getElementFocus();
    show24Hours(demo.CurDate);
    getDataFromBase(1);
    googleCharts();
    $('#MyCollapse').collapse();
});
var demo={}; //create global obj
Date.prototype.daysInMonth = function() { // get amount days in month
        return 33 - new Date(this.getFullYear(), this.getMonth(), 33).getDate();
    };
    function whatTimeNow() {
        demo.CurDate = new Date(Date.now());
        demo.CurDate.setHours(0); demo.CurDate.setMinutes(0); demo.CurDate.setSeconds(0);
    }

// // START Change focus when we listen event click
function getElementFocus() {
        $('#demoTimeFrameType>a').click(changeFocus);
        // $('#demoTimeFrameType').click();  // catch click on our elem demoTimeFrameType
        $('#dateMinus, #datePlus').click(demoChangeDate);
         //toggle elem. by id "weather"
        $('#weather>a').click(function (event) { $(this).toggleClass("selected"); });
        $('#toogleCostValue>div>a').click(function(){
            for(let i=0; i<3 ;i++){ $('#toogleCostValue>div>a').removeClass('selected'); }
            $(this).addClass('selected');// add class selected target element
        });

       function changeFocus(event) {

        for(let i=0; i<3 ;i++){ $('#demoTimeFrameType>a').removeClass('selected'); }// loop all elem and remove class selected
        $(this).addClass('selected'); // add class selected target element

        switch (this.type){ //check our type with case and than we show date or period
            case "1":
                show24Hours(1);
                break;
            case "2":
                showBillingCycle(2); // 2 show month period
                break;
            case "3": // 3 (year) add full year
                showYearDate(3);
                break;
            default:
                break;
        }   }  }
// plus unit or minus
function demoChangeDate(event) {
    if(demo.CurDate >= new Date(Date.now()) && this.id == "datePlus"){ return;  }
    let operator = "";
    (this.id === "dateMinus") ? operator = 1 : operator = 2;
    changeDatePlusMinus(operator);
}

function changeDatePlusMinus(operator) {    // operator 1=minus; 2=plus;
    let typeOfShowDate = $('#demoSelectedDate').attr('type'); //get type which we showed
    var options = {weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
    $('#weather>a, .ion-social-usd-outline').removeClass('selected'); $('.ion-ios-pulse').addClass('selected');
    switch (typeOfShowDate){
        case "1":
            (operator == 1) ? demo.CurDate.setDate(demo.CurDate.getDate() - 1) : demo.CurDate.setDate(demo.CurDate.getDate() + 1);
            break;
        case "2":
            (operator == 1) ? demo.CurDate.setMonth(demo.CurDate.getMonth() - 1) : demo.CurDate.setMonth(demo.CurDate.getMonth() + 1);
            options = {year: 'numeric',month: 'long'};
            break;
        case "3":
            (operator == 1) ? demo.CurDate.setFullYear(demo.CurDate.getFullYear() - 1) : demo.CurDate.setFullYear(demo.CurDate.getFullYear() + 1);
            options = {year: 'numeric'};
            break;
        default:
            break;
    }
    $('#demoSelectedDate').html(demo.CurDate.toLocaleString("en-US", options));
    getDataFromBase(operator);
    return demo.CurDate;
}
// GET YEAR TODAY AND ADD INNER HTML
function showYearDate(type) {
    whatTimeNow();
    demo.CurDate.setMonth(0); demo.CurDate.setDate(1);
    let options = {year: 'numeric'};
    $('#demoSelectedDate').html(demo.CurDate.toLocaleString("en-US", options)); // add our full year
    $('#demoSelectedDate').attr("type", 3);
}
// GET PERIOD MONTHS AND ADD INNER HTML
function showBillingCycle(type) {
    whatTimeNow();
    demo.CurDate.setDate(1)
    let options = {year: 'numeric',month: 'long'};
    $('#demoSelectedDate').html(demo.CurDate.toLocaleString("en-US", options));
    $('#demoSelectedDate').attr("type", 2);
}
// GET DATE TODAY AND ADD INNER HTML
function show24Hours(type) {
    whatTimeNow()
    let options = {weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
    $('#demoSelectedDate').html(demo.CurDate.toLocaleString("en-US", options));
    $('#demoSelectedDate').attr("type", 1);
}

// END Change focus when we listen event click
        function getDataFromBase(event) {
            demo.secondDate = new Date(demo.CurDate); demo.secondDate.setMinutes(0); demo.secondDate.setSeconds(0);
               switch ($('#demoSelectedDate').attr("type")){
                        case "1":
                            demo.secondDate.setHours(23); demo.secondDate.setMinutes(59);
                            break;
                        case "2":
                            demo.secondDate.setMonth(demo.CurDate.getMonth());
                            demo.secondDate.setDate(demo.CurDate.daysInMonth());
                            demo.secondDate.setHours(23); demo.secondDate.setMinutes(59);
                            break;
                        case "3":
                            demo.secondDate.setFullYear(demo.CurDate.getFullYear());
                            demo.secondDate.setMonth(11); demo.secondDate.setDate(31); demo.secondDate.setHours(23);
                            demo.secondDate.setMinutes(59);
                            break;
                        default:
                            break;
              }
              console.log(new Date(demo.secondDate), new Date(demo.CurDate));
               let params = "type="+$('#demoSelectedDate').attr("type")+"&fromDate="+(Date.parse(demo.secondDate))+"&toDate="+(Date.parse(demo.CurDate));

            $.ajax({
                        url: "includes/demoGetJson.php",
                        type: "POST",
                        data: params,
                        dataType: 'json',
                        success: function (data){
                              let requestData = JSON.parse(data);
                              googleCharts(requestData);

                        }
                        });
        }

//  BEGIN DEMO GOOGLE CHARTS
function googleCharts(args) {

// begin google charts
var arrFromDatabase = [];
var maxVal=0,minVal=0,maxCost=0,minCost=0,maxWeath=0,minWeath=0;
var demoTotalCost = 0,
demoTotalValue = 0;
demo.MaxValue = 0; demo.MinValue = 0; demo.MaxCost = 0; demo.MinCost = 0; demo.MaxWeather = 0; demo.MinWeather = 0;
//  GET DATE (MONTHS, DAY, YEAR) WHICH PERIOD NEED SHOW GRAPH
let demoSelectedDate = $('#demoSelectedDate').attr('type');
    arrFromDatabase.push(["Duration", "Value (kW)", "Cost ($)", "Weather"]);
//  HERE WE FIND MIN AND MAX VALUE COST WEATHER
function findMinMax(name, a, b) {
    demo[a] = arrFromDatabase[1][name];
      demo[b] = demo[a];
      for (let i = 2; i < arrFromDatabase.length; ++i) {
          if (arrFromDatabase[i][name] > demo[b]) demo[b] = arrFromDatabase[i][name];
          if (arrFromDatabase[i][name] < demo[a]) demo[a] = arrFromDatabase[i][name];
      }
}
//  HERE WE FIND MIN AND MAX VALUE COST WEATHER
        if (demoSelectedDate == '1'){ // if choose 24 hours
            (function(){
                args.map(function (num) {
                let options={hour:'2-digit'}
                let time = new Date(num.date).toLocaleString('en-US', options);
                arrFromDatabase.push([time, num.value, num.cost, num.weather]);
               demoTotalCost += num.cost;
               demoTotalValue += num.value;
            });
            })();
        }else if(demoSelectedDate == '2'){ // if choose one month
            let dayArray = []; //sort all days in array
            args.map(function (num) {
                let options={day: "numeric"}
                let time = new Date(num.date).toLocaleString('en-US', options);
                    dayArray.push([time, num.value, num.cost, num.weather]);
               demoTotalCost += num.cost;
               demoTotalValue += num.value;
            });
                for(var i=1; i<31;i++){ // for loop we go to each elem.
                        var day = 0, value = 0, cost = 0, weather = 0;
                    dayArray.forEach(function (elem, ind) {
                        if(elem[0] == i){
                                day = elem[0]; value += elem[1]; cost += elem[2]; weather += elem[3];
                        }
                    });
                    if(Number(day) != 0){
                        arrFromDatabase.push([day, value, Math.round(parseFloat(cost)*100)/100, Math.round((parseFloat(weather/24))*100)/100]);
                 }  }
        }else{
             let dayArray = [];
            args.map(function (num) {
                let options={month: "numeric"}
                let time = new Date(num.date).toLocaleString('en-US', options);
                    dayArray.push([time, num.value, num.cost, num.weather]);
               demoTotalCost += num.cost;
               demoTotalValue += num.value;
            });
                for(var i=1; i<12;i++){
                        var day = 0, value = 0, cost = 0, weather = 0;
                    dayArray.forEach(function (elem, ind) {
                        if(elem[0] == i){
                                day = elem[0]; value += elem[1]; cost += elem[2]; weather += elem[3];
                        }
                    });
                    if(day != 0){
                        arrFromDatabase.push([day, value, Math.round(parseFloat(cost)*100)/100, Math.round((parseFloat((weather/(24*31))))*100)/100]);
                 }  }
        }
                // console.log(arrFromDatabase);
                $('#amount').html('Value: ' + Math.round(demoTotalValue * 100) / 100 + ' kW');
// Function search min and max value
        findMinMax(1, 'MinValue', 'MaxValue');
        findMinMax(2, 'MinCost', 'MaxCost');
        findMinMax(3, 'MinWeather', 'MaxWeather');

// Function search min and max value
//  GET DATE (MONTHS, DAY, YEAR) WHICH PERIOD NEED SHOW GRAPH
google.charts.load('current', {'packages':['corechart', 'bar', 'line']});
      google.charts.setOnLoadCallback(drawDoubleVisual);
    function drawDoubleVisual() {
        var valueOrCost = 'kW';
        // Some raw data (not necessarily accurate)
        var data =  google.visualization.arrayToDataTable( arrFromDatabase ); // column chart data

    var options = {
        tooltip: {
        isHtml: true,
        type: 'string',
        },
        animation:{
        startup: true,
        duration: 1000,
        easing: 'out',
      },
      legend: {position: 'none'},
      hAxis: {},
      seriesType: 'bars',
      vAxes: {0: {viewWindowMode:'explicit',
                      viewWindow:{
                                  max: (demo.MaxValue + (demo.MaxValue * 15 / 100)),
                                  min: (demo.MinValue - (demo.MinValue * 50 / 100))
                                  },
                        gridlines: {color: '#ccc'},
                        format: "#kW"
                        },
                  1: {viewWindowMode:'explicit',
                      viewWindow:{
                                  max: (demo.MaxWeather + (demo.MaxWeather*15 / 100)),
                                  min: (demo.MinWeather - (demo.MinWeather*50 / 100))
                                  },
                      gridlines: {color: 'transparent'},
                      format: "#\u00B0F"
                      },
                  },
          series: {
                   0: {targetAxisIndex:1},
                   0: {targetAxisIndex:0, color: 'blue'},
                   1: {targetAxisIndex:0, color: 'transparent'},
                   2: {type: 'line', color: 'transparent', targetAxisIndex:1}
                  }
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chartWeather'));
    chart.draw(data, options);

        $('#weather').click(function(event) { // show hide weather
            var optColorWeather = options['series']['1']['color'];
            if(event.target.classList.contains("selected")){
                options['series']['2']['color'] = 'red';
            }else{
                options['series']['2']['color'] = 'transparent';
        }
              chart.draw(data, options);
        });

        function insertValueInTable(amount, val) {
          $('#Lighting').html((amount*38/100).toFixed(2) +'&nbsp;<span style="color:#000; font-weight:400">' + val + '</span>');
          $('#Venting').html((amount*30/100).toFixed(2) +'&nbsp;<span style="color:#000; font-weight:400">' + val + '</span>');
          $('#Conditioning').html((amount*21/100).toFixed(2) +'&nbsp;<span style="color:#000; font-weight:400">' + val + '</span>');
          $('#Heat').html((amount*6/100).toFixed(2) +'&nbsp;<span style="color:#000; font-weight:400">' + val + '</span>');
          $('#Water').html((amount*4/100).toFixed(2) +'&nbsp;<span style="color:#000; font-weight:400">' + val + '</span>');
          $('#Injection').html((amount*3/100).toFixed(2) +'&nbsp;<span style="color:#000; font-weight:400">' + val + '</span>');
          $('#Drying').html((amount*1/100).toFixed(2) +'&nbsp;<span style="color:#000; font-weight:400">' + val + '</span>');
        }
        insertValueInTable(demoTotalValue, 'kW');

         document.getElementById('toogleCostValue').onclick = function(event) {//when we click on cost or usage button we change
            if(event.target.type == '5'){ // change options height column usd
                options['vAxes']['0']['format']='$';
                options['vAxes']['0']['viewWindow']['max']= (demo.MaxCost + (demo.MaxCost * 15 / 100));
                options['vAxes']['0']['viewWindow']['min']= (demo.MinCost - (demo.MinCost * 50 / 100));
                options['series']['1']['color'] = 'green';
                options['series']['0']['color'] = 'transparent';
                valueOrCost = "USD";
                insertValueInTable(demoTotalCost, '$');
                $('#amount').html('Costs: $'+(Math.round(demoTotalCost * 100) / 100).toFixed(2) );
            }else if(event.target.type == '6'){ // change options height column kW
                options['vAxes']['0']['format']='#kW';
                options['vAxes']['0']['viewWindow']['max']= (demo.MaxValue + (demo.MaxValue * 15 / 100));
                options['vAxes']['0']['viewWindow']['min']= (demo.MinValue - (demo.MinValue * 50 / 100));
                options['series']['0']['color'] = 'blue';
                options['series']['1']['color'] = 'transparent';
                $('#amount').html('Value: '+Math.round(demoTotalValue * 100) / 100 + ' kW');
                valueOrCost = "kW";
                insertValueInTable(demoTotalValue, 'kW');
                }
           chart.draw(data, options);
         };
  };
// DIAGRAM CHART
google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Consumption', 'percent'],
          ['Lighting',     demoTotalValue*38/100],
          ['Venting & Dehumidifier',     demoTotalValue*30/100],
          ['Air Conditioning',  demoTotalValue*21/100],
          ['Space Heat', demoTotalValue*Math.random()*6/100],
          ['Water',    demoTotalValue*Math.random()*4/100],
          ['CO2 Injection',   demoTotalValue*Math.random()*3/100],
          ['Drying',    demoTotalValue*1/100]
        ]);


        var options = {
          title: 'Proportion of Energy Consumption by End use of Indoor Marijuana Cultivation',
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChart'));

        chart.draw(data, options);
      }
// DIAGRAM CHART
};


//  END DEMO GOOGLE CHARTS