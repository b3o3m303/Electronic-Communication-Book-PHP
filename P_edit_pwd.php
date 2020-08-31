<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $phone = $obj['phone'];
    $password = $obj['new_password'];
    $sql= "UPDATE `member` SET `password` = '$password' WHERE `member`.`id` = '$phone'";
    $sqls= "UPDATE `parent` SET `password` = '$password' WHERE `parent`.`phone` = '$phone'";

    if ($con->query($sql) === TRUE && $con->query($sqls) ===TRUE ){
        echo json_encode("success");
    } else {
        echo json_encode("Error");
        echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
