<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $class = $obj['class'];
    $context = $obj['context'];
    $created_date = $obj['created_date'];
    $deadline = $obj['deadline'];
//    $title = $obj['title'];

/*Create Contactbook*/
function create_Contactbook(){
    global $con, $class, $context, $created_date, $deadline;
    $sql_cbadd= "INSERT INTO contactbook SET class = '$class', context = '$context' , created_date = '$created_date' , deadline = '$deadline'";
    if ($con->query($sql_cbadd) === TRUE) {
        // echo json_encode("success");
        select_StdId();
    } else {
        echo json_encode("1 setp Error");
        //echo "1 step Error: " . $query . "<br>" . $con->error;
    }
}
/*Select Student ID*/
function select_StdId(){
    global $con, $class, $context, $created_date, $deadline;
    $sql_stu= mysqli_query($con,"SELECT NS FROM student where class='$class'");
    $number_of_rows = mysqli_num_rows($sql_stu);
    $stu_array  = array();

    if($number_of_rows > 0) {
        while ($row = mysqli_fetch_assoc($sql_stu)) {
            $stu_array[] = $row;
        }
    }
	
    create_Check($stu_array);
}
/*Create Check_Contactbook*/
function create_Check($stu_array){
    global $con, $class, $context, $created_date, $deadline;
    for($x=0;$x<(count($stu_array));$x++){
        $NS = $stu_array[$x]["NS"];
        $sql_ckeckadd= "INSERT INTO check_contactbook(c_id,s_NS, class, created_time) VALUES( (SELECT contactbook.contactbook_id FROM contactbook WHERE contactbook.context = '$context' AND contactbook.check = 'false'),'$NS','$class', '$created_date')";
        if ($con->query($sql_ckeckadd) === TRUE) {
            
        } else {
            echo json_encode("2 step Error");
            //echo "2 step Error: " . $query . "<br>" . $con->error;
            mysqli_close($con);
            break;
        }
    }
    check_parent($stu_array);
}   
/*Create Contactbook_Check_Parent*/
function check_parent($stu_array){
    global $con, $class, $context, $created_date, $deadline, $title;

    $sql_stu= mysqli_query($con,"SELECT NS FROM student where class='$class' AND parent_phone != 'NULL'");
      $number_of_rows = mysqli_num_rows($sql_stu);
      $stu_par_array  = array();
  
      if($number_of_rows > 0) {
          while ($row = mysqli_fetch_assoc($sql_stu)) {
              $stu_par_array[] = $row;
          }
      }

    $sql_check= mysqli_query($con,"SELECT * FROM check_contactbook_parent where class='$class' AND created_date='$created_date'");
    $number_of_rows = mysqli_num_rows($sql_check);
    $check_array  = array();

    if($number_of_rows > 0) {
        // while ($row = mysqli_fetch_assoc($sql_stu)) {
        //     $check_array[] = $row;
        // }
        $sql_updated= "UPDATE `check_contactbook_parent` SET `finish`='0' WHERE check_contactbook_parent.class='$class' AND check_contactbook_parent.created_date='$created_date'";
        if(mysqli_query($con,$sql_updated)){
            //echo json_encode("success");
        }
        // echo json_encode($number_of_rows);
    }else{
        for($x=0;$x<(count($stu_par_array));$x++){
            $NS = $stu_par_array[$x]["NS"];
            $sql_ckeckadd= "INSERT INTO check_contactbook_parent(s_NS, parent_name, class, created_date) VALUES('$NS', (SELECT parent.name FROM parent INNER JOIN student ON student.parent_phone = parent.phone WHERE student.NS = '$NS'), '$class', '$created_date')";
            if ($con->query($sql_ckeckadd) === TRUE) {
                
            } else {
                echo json_encode("3 step Error");
                //echo "3 step Error: " . $query . "<br>" . $con->error;
                mysqli_close($con);
                break;
            }
        }
        //echo json_encode("success");
    }
    update_check();
    //mysqli_close($con);
    }
/*Update ContactBook Check Status*/
function update_check(){
    global $con, $class, $context;
    $sql_updated= ("UPDATE contactbook SET contactbook.check='true' WHERE contactbook.context = '$context' AND contactbook.check = 'false'");
     if ($con->query($sql_updated) === TRUE) {
         echo json_encode("success");
     } else {
         echo json_encode("Error");
         echo "Error: " . $query . "<br>" . $con->error;
     }

}

create_Contactbook();
?>
