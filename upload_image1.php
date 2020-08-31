<?php
    define('ROOT',dirname(__FILE__).'/');
    $target_dir = '/home/ECB/www/avatar';
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $target_dir = $target_dir."/".$_FILES["image"]["name"];

    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_dir)) {
        echo json_encode([
            "Message" => "The has been uploaded.",
            "Status" => "OK",
	    "Type" => "$imageFileType",
	    "location" => "$target_dir"
        ]);
    }else{
        echo json_encode([
           "Message" => "Error.",
           "Status" => "Error",
           "context" => $_FILES['image']['error']
	]);
    }
?>
