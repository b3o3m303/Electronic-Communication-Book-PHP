<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $date = $obj['date'];
    $class = $obj['class'];

    $sql = "SELECT student.name, check_contactbook_parent.finish, parent.name AS parent_name  FROM `check_contactbook_parent` 
    INNER JOIN parent ON parent.name = check_contactbook_parent.parent_name
    INNER JOIN student ON check_contactbook_parent.s_NS = student.NS
    WHERE check_contactbook_parent.created_date = '$date' AND check_contactbook_parent.class = '$class'";
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
