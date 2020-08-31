<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $class = $obj['class'];
    $context = $obj['context'];

    $sql = "
    SELECT COUNT(check_contactbook.finish) AS count FROM check_contactbook
    INNER JOIN contactbook ON check_contactbook.c_id = contactbook.contactbook_id 
    INNER JOIN student ON check_contactbook.s_NS = student.NS
    WHERE contactbook.context = '$context' AND check_contactbook.class = '$class'
    UNION ALL
    SELECT COUNT(check_contactbook.finish) AS count FROM check_contactbook
    INNER JOIN contactbook ON check_contactbook.c_id = contactbook.contactbook_id 
    INNER JOIN student ON check_contactbook.s_NS = student.NS
    WHERE contactbook.context = '$context' AND check_contactbook.class = '$class' AND check_contactbook.finish='1'
    UNION ALL
    SELECT COUNT(check_contactbook.finish) AS count FROM check_contactbook
    INNER JOIN contactbook ON check_contactbook.c_id = contactbook.contactbook_id 
    INNER JOIN student ON check_contactbook.s_NS = student.NS
    WHERE contactbook.context = '$context' AND check_contactbook.class = '$class' AND check_contactbook.finish='0'
    ";
    $result=mysqli_query($con,$sql);
    $number_of_rows = mysqli_num_rows($result);

    $temp_array  = array();
    $array = array();

    if($number_of_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
            // echo json_encode($row['count']);
        }
    }
  echo json_encode($temp_array);
  mysqli_close($con);
?>
