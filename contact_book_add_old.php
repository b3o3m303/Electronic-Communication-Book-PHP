<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $class = $obj['class'];
    $title = $obj['title'];
    $context = $obj['context'];
    $created_date = $obj['created_date'];
    $deadline = $obj['deadline'];

    $sql = "INSERT INTO contactbook SET class = '$class', title=  '$title', context = '$context' , created_date = '$created_date' , deadline = '$deadline'";

    if ($con->query($sql) === TRUE) {
        echo json_encode("success");
    } else {
        echo json_encode("Error");
        echo "Error: " . $query . "<br>" . $con->error;
    }
       
?>
