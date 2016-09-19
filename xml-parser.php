<?php

            include_once 'dbconnect.php';

          foreach ( $xml->entry[3]->content->IntervalBlock->children() as $IntervalReading){
            $duration = $IntervalReading->timePeriod->duration;
            $start = $IntervalReading->timePeriod->start;
            $cost = $IntervalReading->cost;
            $date = $duration + $start;
            $value = $IntervalReading->value;
            $user_id = $_SESSION['id'];
            if($cost != "" && $value != ""){
                $sql = "SELECT * from histogram WHERE histo_date = '$date' ";
                  $res = mysqli_query($con, $sql) or die (mysqli_error());
                  $row = mysqli_num_rows($res);
                if ($row == 0) {
                $query = "INSERT INTO `histogram` (user_id, start, duration, histo_date, value, cost) VALUES ('$user_id', '$start', '$duration', '$date', '$value', '$cost')"; 
                $result = mysqli_query($con, $query) or die(mysqli_error());
                }
                    $errTyp = "success";
                    $errMSG  = "File uploaded to databases";
                }else{
                    $errTyp = "warning";
                    $errMSG = "Error";
                }
            }

        
      
      ?>
