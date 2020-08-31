<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $id = $obj['NS'];    
    $password = $obj['birthday'];
    $name = $obj['name'];
    $class = $obj['class'];

    $sql = "INSERT INTO student SET NS = '$id',name = '$name',password = '$password',class = '$class' ";
      $sqlm="INSERT INTO `member` SET `id`='$id',`password`='$password',`role`='2'";
    if ($con->query($sql) === TRUE && $con->query($sqlm) === TRUE) { 
	 echo json_encode(array('success')); 
    } else { 
       
    $InvalidMSG='Wrong';
    $InvalidMSGJSon = json_encode($InvalidMSG);

    echo $InvalidMSGJSon ;
    }mysqli_close($con);
    //}
?>
