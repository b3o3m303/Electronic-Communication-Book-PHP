<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $NS = $obj['NS'];

    //$sql = "SELECT student.name, student.password, student.NS, student.class, student.phone, student.parent_phone, parent.name as parent_name FROM `student`
//INNER JOIN parent ON parent.phone = student.parent_phone
//WHERE student.NS = '321'";
    $sql = "SELECT * FROM student WHERE NS = '$NS'";
    $result=mysqli_query($con,$sql);
    $number_of_rows = mysqli_num_rows($result);

    $temp_array  = array();

    if($number_of_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
        }
    }
//    echo json_encode($temp_array[0]['parent_phone']);
    if(($temp_array[0]['parent_phone'])== null){
        $sql = "SELECT * FROM student WHERE NS = '$NS'";
        $result=mysqli_query($con,$sql);
        $number_of_rows = mysqli_num_rows($result);
    
        $temp_array  = array();
    
        if($number_of_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $temp_array[] = $row;
            }
        }
       echo json_encode($temp_array);
    }else{
        $sql = "SELECT student.name, student.password, student.NS, student.class, student.phone, student.parent_phone, parent.name as parent_name FROM `student` 
        INNER JOIN parent ON parent.phone = student.parent_phone
        WHERE student.NS = '$NS'";
        $result=mysqli_query($con,$sql);
        $number_of_rows = mysqli_num_rows($result);
    
        $temp_array  = array();
    
        if($number_of_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $temp_array[] = $row;
            }
        }
       echo json_encode($temp_array);
    }
  mysqli_close($con);
?>
