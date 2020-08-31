<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    $date = date("Y")."-".date("m")."-".date("d");
    $class = $obj['class'];    
    $result=mysqli_query($con,"SELECT * FROM `contactbook` WHERE class = '$class' and Created_Date = '$date' ORDER BY Deadline ASC");
    $number_of_rows = mysqli_num_rows($result);
     
    $temp_array  = array();
     
    if($number_of_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
        }
    }
  
  echo json_encode(array("data"=>$temp_array));
  mysqli_close($con);
?>
