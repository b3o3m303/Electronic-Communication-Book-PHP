<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    //$date = $obj['date'];
    $NS = $obj['NS'];
    $c_id = $obj['c_id'];
    $class = $obj['class'];
    $updated = $obj['updated'];
    
    $sql = "UPDATE check_contactbook 
    INNER JOIN student ON check_contactbook.s_NS = student.NS
    INNER JOIN contactbook ON check_contactbook.c_id = contactbook.contactbook_id
    SET check_contactbook.finish='$updated'
    WHERE check_contactbook.c_id = '$c_id' AND check_contactbook.s_NS = '$NS'";
   //WHERE  check_contactbook.created_time = '$date' AND  check_contactbook.c_id = '$c_id' AND check_contactbook.s_NS = '$NS'";
   //echo ($sql);
    if (mysqli_query($con,$sql)) { 
        echo json_encode('success'); 
       } else { 
           echo json_encode("Error");
           echo "Error: " . $query . "<br>" . $con->error; 
       }
  mysqli_close($con);
?>
