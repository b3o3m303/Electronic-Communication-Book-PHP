<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $contactbook_id = $obj['contactbook_id'];

    $sql = "DELETE FROM contactbook WHERE contactbook_id = '$contactbook_id'";
    $sql2 = "DELETE FROM check_contactbook WHERE c_id = '$contactbook_id'";

    if ($con->query($sql) === TRUE) {
        if ($con->query($sql2) === TRUE) {
            echo json_encode("success");
        } else {
            echo json_encode("Error");
            echo "Error: " . $query . "<br>" . $con->error;
        }
    } else {
        echo json_encode("Error");
        echo "Error: " . $query . "<br>" . $con->error;
    }
       
?>