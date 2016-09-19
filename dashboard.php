<?php
 
session_start();
include_once 'dbconnect.php';
if ( isset($_SESSION['login'])=="" ) {
  header("Location: login.php");
  exit;
 }
 
include_once 'logout.php'; 
if (isset($_SESSION['login']) && isset($_SESSION['id'])) // если в сессии загружены логин и id
    {
        $msg = $_SESSION['name'];
        $img = $_SESSION['picture'];
        $btn_logout = '<a href="index.php?exit"><button type="button" class=" btn-login btn btn-danger uppercase">Exit</button></a>'; // Выводим нашу ссылку выхода
    } 
    ?>

    <?php
    libxml_use_internal_errors(true);
       if (isset($_POST['submit-xml'])) {
          $xmlFileName = $_FILES['uploadData']['name'];
          $uploaddir = './xml/';
          $uploadfile = $uploaddir.basename($xmlFileName);
          copy($_FILES['uploadData']['tmp_name'], $uploadfile);
          $xmlFile = 'xml/'.$xmlFileName;
        $xml=simplexml_load_file($xmlFile) or die("Error: Cannot create object");
        if ($xml === false) {
            echo "Failed loading XML: ";
            foreach(libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        } else {
           include_once 'xml-parser.php';
        }
      }
      ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Dashboard Clovex Energy</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script   src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="icon" href="img/image.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Play&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/charts.js"></script>
</head>
 <body>
     <div class="content">
         <div class="row">
             <div class="col-lg-2 lftSdDboard">
                 <div class="row">
                     <div class="col-lg-12">
                         <a href="index.php">
                            <img id="imgLogoDboard" src="img/image.png" alt="Clovex Energy">
                            <span class="txtLogoDboard">Clovex Energy</span>
                        </a>
                     </div>
                 </div>
                 <div class="row lftSdMrgTop">
                     <div class="col-lg-3">
                         <?php if ( isset($msg) ) { ?>
                        <img class="user-avatar" src="<?php echo $img; ?>" alt="<?php echo $msg; ?>" />
                        </div>
                        <div class="col-lg-9">Welcome: <strong class="capitalLetter">
                        <?php echo $msg;} ?>
                        </strong>
                     </div>
                 </div>
                 <div class="row lftSdMrgTop">
                     <div class="col-lg-12">
                         <div class="panel-group" id="accordion">
                          <div class="panel">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                       <i class="fa fa-home" aria-hidden="true"></i>
                                        Home
                                      <span class="glyphicon glyphicon-chevron-down" style="float: right"></span>
                                      </a>
                                    </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                  <a href="#">
                                      <span class="lftSdUl fa fa-tachometer" aria-hidden="true"> Dashboard 1</span>
                                  </a>
                                  <a href="#">
                                      <span class="lftSdUl fa fa-tachometer" aria-hidden="true"> Dashboard 2</span>
                                  </a>
                                  <a href="#">
                                      <span class="lftSdUl fa fa-tachometer" aria-hidden="true"> Dashboard 3</span>
                                  </a>
                              </div>
                            </div>
                          </div>
                          <div class="panel">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                        Forms
                                      <span class="glyphicon glyphicon-chevron-down" style="float: right"></span>
                                      </a>
                                    </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                              <div class="panel-body center">
                                <span class="fa fa-upload" aria-hidden="true"></span>
                                 Upload your Data <br>
                                 <form method="post" autocomplete="off" enctype="multipart/form-data" >
                                  <input type="file" name="uploadData" id="uploadData" /> <br>
                                  <button type="submit" name="submit-xml" id="showHistogramm" class="btn  btn-default uppercase" >Clovex Energy</button>
                                </form>
                              </div>
                            </div>
                          </div>
                          <div class="panel">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        <i class="fa fa-desktop" aria-hidden="true"></i>
                                        UI Elements
                                      </a>
                                    </h4>
                            </div>
<!--                             <div id="collapseThree" class="panel-collapse collapse in">
                              <div class="panel-body">
                              them accusamus labore sustainable VHS3.
                              </div>
                            </div> -->
                          </div>
                          <div class="panel">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        Calendar
                                        <span class="glyphicon glyphicon-chevron-down" style="float: right"></span>
                                      </a>
                                    </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse in">
                              <div class="panel-body datepicker">
                              <div id="datepicker"></div>
                              </div>
                            </div>
                          </div>
                          <div class="panel">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                        <i class="fa fa-table" aria-hidden="true"></i>
                                        Tables
                                      <span class="glyphicon glyphicon-chevron-down" style="float: right"></span>
                                      </a>
                                    </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse in">
                              <div class="panel-body">
                              them accusamus labore sustainable VHS4.
                              </div>
                            </div>
                          </div>
                          </div>
                     </div>
                 </div>
                 <div class="row lftSdMrgTop">
                     <div class="col-lg-12"></div>
                 </div>
             </div>
             <div class="col-lg-10 rghtSdDboard">
                 <div class="row">
                     <div class="col-lg-12 fstLineRghtSdDboard">
                     <div class="row">
                         <div class="col-lg-1">
                             <span class="cursor glyphicon glyphicon-align-justify glyphicon-lg"></span>
                         </div>
                         <div class="col-lg-offset-8 col-lg-2">
                         
                                        <?php if ( isset($msg) ) { ?>
                                        <span class="welcome"> <strong class="capitalLetter">
                                        <?php echo $msg;} ?>
                                        <img class="user-avatar" src="<?php echo $img; ?>" alt="<?php echo $msg; ?>" />
                                        </strong>
                                        </span>
                                        </div>
                                        <div class="col-lg-1">
                                        <?php
                                            echo $btn_logout; 
                                        ?>
                                        
                         </div>
                     </div>
                         
                     </div>
                 </div>
                         <div class="row scndLineRghtSdDboard">
                             <div class="col-lg-2 center bord-right">
                                 <span class="">data1</span>
                             </div>
                             <div class="col-lg-2 center bord-right">
                                 <span class="">data2</span>
                             </div>
                             <div class="col-lg-2 center bord-right">
                                 <span class="">data3</span>
                             </div>
                             <div class="col-lg-2 center bord-right">
                                 <span class="">data4</span>
                             </div>
                             <div class="col-lg-2 center bord-right">
                                 <span class="">data5</span>
                             </div>
                             <div class="col-lg-2 center">
                                 <span class="">data6</span>
                             </div>
                         </div>
                 <div class="row thrdLineRghtSdDboard white">
                     <div class="col-lg-12 ">
                                 <div class="row">
                                     <div class="col-lg-4">
                                     <span class="activities uppercase">Activity: <?php echo date("m-d-Y h:iA"); ?></span>
                                     </div>
                                     <div class="col-lg-offset-2 col-lg-6 dark">
                                     <span id="dateFrom">From: <input type="text" id="fromDate" value="" placeholder="Date">
                                        <select id="fromHours" name="fromHours">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="0">12</option>
                                        </select>
                                        <strong>:</strong>
                                        <input id="fromMinutes" name="fromMinutes" value="00" />
                                        <input id="fromAmPm" type="text" name="fromAmPm" value="AM"  />
                                     </span>
                                     <span id="dateTo">To: <input type="text" id="toDate" value="" placeholder="Date">
                                        <select id="toHours" name="toHours">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="0">12</option>
                                        </select> 
                                        <strong>:</strong>
                                        <input id="toMinutes" name="toMinutes" value="00" />
                                        <input id="toAmPm" type="text" name="toAmPm" value="AM" />
                                     </span>
                                     <input id="getDate" type="submit" class="btn btn-primary" name="" value="Submit">
                                     </div>
                                 </div>
                             <hr>   
                                 <div class="row">
                                     <div class="col-lg-12">
                                     <div id="columnchart_material" style=""></div>
                                     </div>
                                     
                                 </div>
                     </div>
                 </div>
                 <div class="row fourLineRghtSdDboard">
                             <div class="col-lg-4 white center bord-right">
                                <div id="chart_div"></div>
                             </div>
                             <div class="col-lg-4 white center bord-right">
                                 <div id="donutchart" ></div>
                             </div>
                             <div class="col-lg-4 center bord-right">
                                 <div id="table_div" style="width: 355px; height: 300px"></div>
                             </div>
                 </div>
                 <div class="row fiveLineRghtSdDboard white">
                             <div class="col-lg-4 ">
                                 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                                     <div id="barchart_values" style="width: 250px; height: 250px;"></div>
                             </div>
                             <div class="col-lg-8 ">
                                 <div class="row">
                                     <div class="col-lg-7 ">
                                         <div id="regions_div" style="width: 300px; height: 300px;"></div>
                                     </div>
                                    <div class="col-lg-5 " style="height: 100%">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                                    </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-lg-6 ">
                                     Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                                     </div>
                                     <div class="col-lg-6 white">
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
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
    <script type="text/javascript" src="js/dashboard.js"></script>
    <?php include_once 'includes/json.php'; ?>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let spinner = document.getElementById('spinner');
        setTimeout(function(){spinner.style.display = 'none';}, 500);
        });
        var histoJsonData = <?php echo($outp); ?>;
        console.log(histoJsonData);
    </script>
 </body>
 </html>