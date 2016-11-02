<?php /*include_once 'includes/demoGetJson.php'; */?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Dashboard Clovex Energy</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> -->
    <link rel="icon" href="img/image.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Play&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/demo-style.css">
    <script type="text/javascript" src="demo.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script><!--  googe charts loader -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let spinner = document.getElementById('spinner');
        setTimeout(function(){spinner.style.display = 'none';}, 500);
        });
        // var demoJsonData = <?php /*echo($demoutp); */?>;

    </script>
</head>
 <body>
     <div class="content">
         <div class="row demo-logo-row">
             <div class="col-lg-10 col-sm-10 col-xs-10">
             <img id="demo-img-logo" src="img/Clovex-2.png" alt="Clovex Energy">
             <span class="txtLogoDboard ">Clovex Energy</span>
             </div>
             <div class="col-lg-2 col-sm-2 col-xs-2">
              <a href="dashboard.php" class="demo-login">Log in</a>
             </div>
         </div>
         <div class="row demo-row-close">
             <div class="col-lg-11 col-sm-11 col-xs-11">
                <span class="demo-text">This is a demo Clovex Energy account. <br>
                <em style="font-size:0.7em; color:#ccc">*Date available from Jan 01 2016 00:00 AM </em></span>
             </div>
             <div class="col-lg-1 col-sm-1 col-xs-1">
             <span class="demo-close">
             <a href="index.php" ><i class="ion-android-close"></i></a>
             </span>
             </div>
         </div>
         <div class="container demo-timescale-row">
           <div class="row">
             <div id="demo-timescale" class="col-lg-12 col-sm-12 col-xs-12">
               <div class="row">
                 <div class="col-xs-12 col-sm-4 col-lg-3">
                  <div id="demoTimeFrameType" class="demo-time-frame-type">
                    <a class="day selected" type="1">24 HR</a>
                    <a class="month uppercase" type="2">Billing cycle</a>
                    <a class="year uppercase" type="3" value="YY">Year</a>
                  </div>
                 </div>
                 <div class="col-xs-12 col-sm-4 col-lg-4">
                  <div class="row" id="demo-timescale-block">
                    <div class="demo-timeframe-menu">
                      <a class="ion-chevron-left" id="dateMinus" aria-hidden="true">
                      </a>
                    </div>
                    <div class="demo-timelabel">
                      <span id="demoSelectedDate" class="uppercase" type="1"></span>
                    </div>
                    <div class="demo-timeframe-menu">
                      <a class="ion-chevron-right" id="datePlus" aria-hidden="true">
                      </a>
                    </div>
                  </div>
                 </div>
                 <div class="col-lg-offset-2 col-sm-offset-2 col-xs-12 col-sm-2 col-lg-2">
                  <div id="demoValueFrameType" class="row clearfix">
                    <div id="weather" class="demo-clearfix-part weather" data-ctrl="weather" title="Weather" value="line">
                      <a class="ion-ios-partlysunny-outline" type="4"></a>
                    </div>
                    <div id="toogleCostValue">
                      <div class="demo-clearfix-part payment" data-ctrl="payment" title="Cost">
                        <a class="ion-social-usd-outline" type="5"></a>
                      </div>
                      <div class="demo-clearfix-part usage" data-ctrl="usage" title="Usage">
                        <a class="ion-ios-pulse selected" type="6"></a>
                      </div>
                    </div>
                  </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="row">
           <div class="col-lg-3 col-sm-4 col-xs-12">
            <span class="spent-message">Energy <span id="amount">  </span></span>
           </div>
         </div>
         </div>
         <div class="container">
           <div id="chartWeather" width="800" height="600"></div>
           <div class="row">
             <div class="margtop col-lg-6 col-sm-12 col-xs-12">
              <div id="pieChart"></div>
             </div>
             <div class="margtop col-lg-6 col-sm-12 col-xs-12">
                <div class="consumption">
                <h3 class="">Energy consumption (kW)</h3>
                <div id="MyCollapse">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                      <div class="panel-heading" id="headingOne" role="tab">
                        <h4 class="panel-title"><a href="#collapseOne" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseOne">
                          <span class="app-title">Lighting</span><span id="Lighting" class="app-cost"></span>
                          <span class="ion-arrow-down-b"></span>
                        </a></h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                          <p>Comparison is not available in this view.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" id="headingTwo" role="tab">
                        <h4 class="panel-title"><a href="#collapseTwo" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseTwo">
                          <span class="app-title">Venting &amp; Dehumidifier</span><span id="Venting" class="app-cost"></span>
                          <span class="ion-arrow-down-b"></span>
                        </a></h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                          <p>Comparison is not available in this view.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" id="headingThree" role="tab">
                        <h4 class="panel-title"><a href="#collapseThree" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseThree">
                          <span class="app-title">Air Conditioning</span><span id="Conditioning" class="app-cost"></span>
                          <span class="ion-arrow-down-b"></span>
                        </a></h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                          <p>Comparison is not available in this view.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" id="headingFour" role="tab">
                        <h4 class="panel-title"><a href="#collapseFour" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseFour">
                          <span class="app-title">Space Heat</span><span id="Heat" class="app-cost"></span>
                          <span class="ion-arrow-down-b"></span>
                        </a></h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                          <p>Comparison is not available in this view.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" id="headingFifth" role="tab">
                        <h4 class="panel-title"><a href="#collapseFifth" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseFifth">
                          <span class="app-title">Water</span><span id="Water" class="app-cost"></span>
                          <span class="ion-arrow-down-b"></span>
                        </a></h4>
                      </div>
                      <div id="collapseFifth" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFifth">
                        <div class="panel-body">
                          <p>Comparison is not available in this view.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" id="headingSix" role="tab">
                        <h4 class="panel-title"><a href="#collapseSix" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseSix">
                          <span class="app-title">CO2 Injection</span><span id="Injection" class="app-cost"></span>
                          <span class="ion-arrow-down-b"></span>
                        </a></h4>
                      </div>
                      <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                        <div class="panel-body">
                          <p>Comparison is not available in this view.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" id="headingSeven" role="tab">
                        <h4 class="panel-title"><a href="#collapseSeven" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseSeven">
                          <span class="app-title">Drying</span><span id="Drying" class="app-cost"></span>
                          <span class="ion-arrow-down-b"></span>
                        </a></h4>
                      </div>
                      <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                        <div class="panel-body">
                          <p>Comparison is not available in this view.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
             </div>
           </div>

         </div>


     </div>

     <!-- spinner -->
     <div id="spinner">
         <div class="spinner-wrap">
          <div class="spinner-loader"></div>
          <div class="spinner-loaderbefore"></div>
          <div class="spinner-circular"></div>
          <div class="spinner-circular spinner-another"></div>
        <div class="spinner-text">Loading</div>
        </div>
     </div>
     <!-- end spinner -->
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!-- <script src="js/vendor/modernizr-2.8.3.min.js"></script> -->
  <script type="text/javascript">

  // return value;

// console.log(datatable.split(":").length - 1);
// console.log(JSON.parse(datatable));

  </script>
 </body>
 </html>