<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $phone = $obj['phone'];
    $sql = "SELECT parent.name, parent.phone, member.password, student.name as child FROM `parent`
	    INNER JOIN student ON student.parent_phone = parent.phone
	    INNER JOIN member ON parent.phone = member.id
	    WHERE parent.phone = '$phone'";
    $check = mysqli_fetch_array(mysqli_query($con,$sql));
    $result=mysqli_query($con,$sql);
    $number_of_rows = mysqli_num_rows($result);
     
    $temp_array  = array();
     
    if($number_of_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
        }
    }
  echo json_encode(array("data"=>$temp_array));
  mysqli_close($con);
?>
