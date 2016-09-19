 google.charts.load('current', {'packages':['corechart', 'table', 'geochart', 'bar']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart1);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart1() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);
        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      /*                           DONUT CHART          */
      // google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     12.5],
          ['Eat',      1],
          ['Commute',  1.5],
          ['Surf on the Internet', 0.3],
          ['Sleep',    6],
          ['learn', 3]
        ]);

        var options = {
          title: 'My Daily Activities',
          pieHole: 0.4,
          'width':400,
          'height':300
           };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      };
      /*                   BAR CHART                       */
      google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Copper", 8.94, "#b87333"],
        ["Silver", 10.49, "silver"],
        ["Gold", 19.30, "gold"],
        ["Platinum", 21.45, "color: #e5e4e2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Density of Precious Metals, in g/cm^3",
        width: 350,
        height: 250,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  };
  /*              COLUMN CHART              */
  function columnChart(arg) {
    var arr = arg;
    arr.unshift(["Duration", "Value (kW)", "Cost ($)"]);
    // arr.push(arg);
    // console.log( arr);
 google.charts.setOnLoadCallback(drawChartHistogram);
      function drawChartHistogram() {
        // var arr = '[["Duration", "Value (kW)", "Cost ($)"],' + arg1+']';
        console.log(arr);
        var data = google.visualization.arrayToDataTable(
           arr          
        );
        
        var options = {
          chart: {
            title: 'Company Clovex Energy',
            subtitle: 'Cost, Values, and Timeline',
          },
          'height':300
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        var formatter = new google.visualization.NumberFormat({decimalSymbol: '.'});
        formatter.format(data, 2);
        chart.draw(data, options);
      }
    }
  /*                    GEOCHART            */
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          ['Germany', 200],
          ['United States', 800],
          ['Brazil', 400],
          ['Canada', 500],
          ['Mexica', 300],
          ['Costa rica', 600],
          ['Peru', 20],
          ['Cuba', 100]
        ]);

        var options = {
          region: '019', 
            'width':400,
          'height':300
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      };
      /*        TABLE CHART             */
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('number', 'Consumption');
        data.addColumn('boolean', 'Full day');
        data.addRows([
          ['microvawe',  {v: 1, f: '1kW'}, false],
          ['fridge',   {v:2.4,   f: '$2,4kW'},  true],
          ['cooker', {v: 1.5, f: '$1,5kW'}, false],
          ['TV',   {v: 0.5,  f: '$0,5kW'},  false],
          ['cooling',   {v: 2,  f: '$0,9kW'},  false],
          ['water heater',   {v: 1.5,  f: '$0,36kW'},  false]
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }