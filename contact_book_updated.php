<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $contactbook_id = $obj['contactbook_id'];
    $context = $obj['context'];
    $created_date = $obj['created_date'];
    $deadline = $obj['deadline'];

    $sql = "UPDATE `ECB`.`contactbook` SET ``context` = '$context',`created_date` = '$created_date', `deadline` = '$deadline' WHERE (`contactbook_id` = '$contactbook_id');";

    if ($con->query($sql) === TRUE) {
        echo json_encode("success");
    } else {
        echo json_encode("Error");
        echo "Error: " . $query . "<br>" . $con->error;
    }
       
?>
