<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    $context = $obj['context'];
    $class = $obj['class'];

    $sql = "SELECT student.name, check_contactbook.finish  FROM `check_contactbook` 
    INNER JOIN contactbook ON check_contactbook.c_id = contactbook.contactbook_id 
    INNER JOIN student ON check_contactbook.s_NS = student.NS
    WHERE contactbook.context = '$context' AND check_contactbook.class = '$class'";
    $result=mysqli_query($con,$sql);

    $number_of_rows = mysqli_num_rows($result);
     
    $temp_array  = array();
    
    if($number_of_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
        }
    }

  echo json_encode($temp_array);
  mysqli_close($con);
?>
