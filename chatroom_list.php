<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $class = $obj['class'];    
    $result=mysqli_query($con,"SELECT student.NS, student.name as student_name, parent.name AS parent_name FROM student JOIN parent ON parent.phone=student.parent_phone where student.class='$class' ORDER BY student.NS ASC");
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
