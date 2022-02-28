<?php

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];
// checks whether the id is empty or not
    if(empty($id)){
       echo 'error';
    }else {
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        // if to-do item is checked returns 1 in DB else returns 0
        $uChecked = $checked ? 0 : 1;

        // updates the database
        $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id=$uId");
        
        if($res){
            echo $checked;
        }else {
            echo "error";
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}