<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $date = $obj['date'];
    $NS = $obj['NS'];

    /*$sql = "SELECT contactbook.context, contactbook.deadline, check_contactbook.finish, student.name, check_contactbook_parent.finish AS parent_check FROM `contactbook`
    INNER JOIN check_contactbook ON check_contactbook.created_time = contactbook.created_date
    INNER JOIN student ON check_contactbook.s_NS = student.NS
    INNER JOIN check_contactbook_parent ON contactbook.class = check_contactbook_parent.class
    WHERE check_contactbook.s_NS='$NS' AND check_contactbook.created_time='$date' AND check_contactbook_parent.s_NS = '$NS' GROUP BY contactbook.context";*/
    
  /*  $sql = "SELECT contactbook.context, contactbook.deadline, check_contactbook.finish, student.name,check_contactbook.id ,check_contactbook_parent.finish AS parent_check FROM `contactbook`
INNER JOIN check_contactbook ON check_contactbook.created_time = contactbook.created_date
INNER JOIN student ON check_contactbook.s_NS = student.NS
INNER JOIN check_contactbook_parent ON contactbook.class = check_contactbook_parent.class
WHERE check_contactbook.s_NS='$NS' AND check_contactbook.created_time='$date' AND check_contactbook_parent.s_NS = '$NS' 
";*/
    $sql = "SELECT check_contactbook.finish, check_contactbook.s_NS, contactbook.context, student.name, contactbook.deadline, check_contactbook.c_id,check_contactbook.id,check_contactbook_parent.finish AS parent_check FROM `check_contactbook`
JOIN contactbook ON contactbook.contactbook_id = check_contactbook.c_id
JOIN student ON student.NS = check_contactbook.s_NS
JOIN check_contactbook_parent ON check_contactbook_parent.s_NS =check_contactbook.s_NS
WHERE check_contactbook.s_NS='$NS' AND check_contactbook.created_time='$date'";

/*$sql = "SELECT check_contactbook.finish, check_contactbook.s_NS, contactbook.context, student.name, contactbook.deadline, check_contactbook.c_id,check_contactbook.id,check_contactbook_parent.finish AS parent_check FROM `check_contactbook`
JOIN contactbook ON contactbook.contactbook_id = check_contactbook.c_id
JOIN student ON student.NS = check_contactbook.s_NS
JOIN check_contactbook_parent ON check_contactbook_parent.s_NS =check_contactbook.s_NS
WHERE check_contactbook.s_NS='104021042' AND check_contactbook.created_time='2018-12-19'
GROUP BY id";*/
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
