<?php
include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
//    $sql_query="select * from check_contactbook";
    $sql_query="select count(*) as number from check_contactbook where finish='0' ";
    $result=mysqli_query($con,$sql_query);
if($result->num_rows>0){
    while($row[]=$result->fetch_assoc()){
        $temp=$row;
    }
 
    echo json_encode(($temp));

}
else{

    $InvalidMSG='Wrong';
    $InvalidMSGJSon = json_encode($InvalidMSG);

    echo $InvalidMSGJSon ;

}

?>