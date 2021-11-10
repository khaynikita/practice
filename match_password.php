<?php
include "connectdb.php";
session_start();
  if(isset($_POST['old_pass'])){
     $old_pass = $_POST['old_pass'];
     $useremail = $_SESSION['useremail'];
    $row= $pdo->query("SELECT * FROM tbl_user WHERE useremail='$useremail' AND password = '$old_pass'")->fetch(PDO::FETCH_OBJ);
    if($row){
     $pass_db = $row->password;
     if($old_pass == $pass_db)
     {
      echo json_encode(array('success' => 1,'mayank' => 2));
         }
       }
     else{
      echo json_encode(array('success' => 0));
           }
      
      }
   ?>