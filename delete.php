<?php   
 $conn = mysqli_connect('localhost', 'root', 'qwerty@123!', 'foodwaste');

 // Check connection
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 } 
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `available_food` WHERE id = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:receiver_entry.php');  
      }else{  
           echo "Error: ".mysqli_error($conn);  
      }  
 }  
 ?>  

