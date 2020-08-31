<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $date = $obj['date'];
    $NS = $obj['NS'];
    $class = $obj['class'];
    // $updated = $obj['updated'];
    
    $sql = "UPDATE check_contactbook_parent
    INNER JOIN student ON check_contactbook_parent.s_NS = student.NS
    SET check_contactbook_parent.finish='1'
    WHERE  check_contactbook_parent.created_date = '$date' AND  check_contactbook_parent.s_NS = '$NS' AND check_contactbook_parent.class = '$class'";
   //echo ($sql);
    if (mysqli_query($con,$sql)) { 
        echo json_encode('success'); 
       } else { 
           echo json_encode("Error");
           echo "Error: " . $query . "<br>" . $con->error; 
       }
  mysqli_close($con);
?>
