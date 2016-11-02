<?php

include_once '../dbconnect.php';

if((isset($_POST['type'])) && (isset($_POST['fromDate']))&& (isset($_POST['toDate'])))  {
    $type = $_POST['type'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

// if( $type == '1'){
//     $sqlReq = "SELECT `histo_date`, `value`, `cost`, `weather` FROM `combinechart` WHERE `histo_date` >= $toDate  AND `histo_date` <= $fromDate";
// }else{
    $sqlReq = "SELECT `histo_date`, `value`, `cost`, `weather` FROM `combinechart` WHERE `histo_date` >= $toDate  AND `histo_date` <= $fromDate";
// }

$resultReq = mysqli_query($con, $sqlReq);

$demoutp = "";
while($rs = $resultReq->fetch_array(MYSQLI_ASSOC)) {
    if ($demoutp != "") {$demoutp .= ", ";}
    $demoutp .= '{"date":' .$rs["histo_date"]  . ',';
    // $demoutp .=  '{date:"' . date($date, $rs["histo_date"]). '",';
    $demoutp .= '"value":'.$rs["value"]. ',';
    $demoutp .= '"cost":'.(($rs["cost"])/100.00)  . ',';
    $demoutp .=  '"weather":'.$rs["weather"]. '}';
}
$demoutp = '['.$demoutp.']';
echo json_encode($demoutp);

$con->close();
}
?>