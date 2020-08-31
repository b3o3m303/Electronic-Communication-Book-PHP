<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $id = $obj['id'];    
    $password = $obj['password'];
    $name = $obj['name'];
    $class = $obj['class'];
    $phone=$obj['phone'];

    $sql = "INSERT INTO teacher SET id = '$id',name = '$name',password = '$password',class = '$class',phone='$phone'";
    $sqlm="INSERT INTO `member` SET `id`='$id',`password`='$password',`role`='1'";
    if ($con->query($sql) === TRUE && $con->query($sqlm) === TRUE) { 
        echo json_encode("success"); 
    } else { 
        echo json_encode("Error");
       
    }

?>