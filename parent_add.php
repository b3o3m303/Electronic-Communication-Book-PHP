<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $c_id = $obj['c_id'];
    $phone = $obj['student_phone'];
    $parent_phone = $obj['parent_phone'];    
    $name = $obj['name'];
    $password = '0000';

    $sql = "INSERT INTO parent SET phone = '$parent_phone',name = '$name',password = '$password'";
    $sqlm= "INSERT INTO `member` (`id`, `password`, `role`) VALUES ('$parent_phone', '$password', '3')";
    $sqls= "UPDATE `student` SET `phone` = '$phone' ,`parent_phone` = '$parent_phone' WHERE `student`.`NS` = '$c_id'";

    if ($con->query($sql) === TRUE && $con->query($sqlm) === TRUE && $con->query($sqls) ===TRUE ){ 
        echo json_encode("success"); 
    } else { 
        echo json_encode("Error");
        echo "Error: " . $sql . "<br>" . $con->error; 
    }
?>
