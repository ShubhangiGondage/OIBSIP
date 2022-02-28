<?php
// The Require() function is also used to put data of one PHP file to another PHP file
//This isset function returns true if the variable exists and is not NULL, otherwise it returns false
if(isset($_POST['title'])){
    require '../db_conn.php';

    $title = $_POST['title'];
    
    // if the title is empty
    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
        $res = $stmt->execute([$title]);

        if($res){
            header("Location: ../index.php?mess=success"); 
        }else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}