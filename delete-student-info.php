<?php
 include 'header.php';
 if(isset($_GET['id'])){
  $student_info=$student_obj->delete_student_info_by_id($_GET['id']);
 
     
 }else{
  header('Location: index.php');
 }
 
 ?>
