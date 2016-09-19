<?php
// session_start();
// include_once '../dbconnect.php';
// if ( isset($_SESSION['login'])=="" ) {
//   header("Location: login.php");
//   exit;
//  }

$sqlReq = "SELECT * FROM `histogram`";
$resultReq = mysqli_query($con, $sqlReq);

$outp = "";
while($rs = $resultReq->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ", ";}
    $outp .= ($rs["histo_date"] * 1000) . ': [';
    $outp .=  '"' . date('d.m.y H:i', $rs["histo_date"] ). '",';
    $outp .= $rs["value"] . ',';
    $outp .= (($rs["cost"])/100.00)  . ']';
}
$outp ="{".$outp."}";
$con->close();
 // echo($outp);

?>