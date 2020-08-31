<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $id = $obj['id'];
    $password = $obj['new_password'];
    $sql= "UPDATE `member` SET `password` = '$password' WHERE `member`.`id` = '$id'";
    $sqls= "UPDATE `student` SET `password` = '$password' WHERE `student`.`NS` = '$id'";

    if ($con->query($sql) === TRUE && $con->query($sqls) ===TRUE ){
        echo json_encode("success");
    } else {
        echo json_encode("Error");
        echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
