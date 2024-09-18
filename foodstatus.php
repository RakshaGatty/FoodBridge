<?php   
$conn = mysqli_connect('localhost', 'root', 'qwerty@123!', 'foodwaste');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}  
 $query = "select * from recipient";  
 $run = mysqli_query($conn,$query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
 <head>  
      <meta charset="utf-8">  
      <title>Delete Data From Database in PHP</title>  
     <style>
     *{  
      padding: 0;  
      margin: 0;  
      box-sizing: border-box;  
 }  
 body{  
      width: 100%;  
      height: 100vh;  
      background-color:white;  
      background-image: url('');
      position: relative;  
      font-family: 'verdana',sans-serif;  
 }  
 header{  
      width: 100%;  
      height: 80px;  
      background-color: #ccc;  
      color:black;
      text-align: center;
      font-size:40px;
 }  
 table{  
      width: 75%;  
      position: absolute;  
      top: 50%;  
      left: 50%;  
      transform: translate(-50%,-50%);  
      
 }  
 .heading{  
      background-color:rosybrown;  
 }  
 .heading th{  
      padding: 10px 0;
      color:black;

 }  
 .data{  
      text-align: center;  
      color:aquamarine;  
 }  
 .note {
            display: block;
            clear: both;
            margin-top: 20px;
            font-style:normal;
            font-size: 20px;
            color:black;
        }
 .data td{  
      padding: 15px 0;  
      color:black;
 }  
 td{
     background-color:whitesmoke;
 }
 #btn{  
      text-decoration: none;  
      color:black;  
      background-color:lightgreen;  
      padding: 5px 20px;  
      border-radius: 3px;  
 }  
 #btn:hover{  
      background-color:green;  
 }  
</style> 
 </head>  
 <body>  
 <header>Food Status</header>  
 <table border="1" cellspacing="0" cellpadding="0">  
      <tr class="heading">  
           <th>Sl No</th>  
           <th>ID</th>  
           <th>Name</th>  
           <th>Contact</th>  
           <th>Address</th>  
           <th>Email</th>  
           <th>Action</th>  
      </tr>  
      <?php   
      $i=1;  
           if ($num = mysqli_num_rows($run)>0) {  
                while ($result = mysqli_fetch_assoc($run)) {  
                     echo "  
                          <tr class='data'>  
                          <td>".$i++."</td>  
                               <td>".$result['id']."</td>  
                               <td>".$result['name']."</td>  
                               <td>".$result['contact']."</td>  
                               <td>".$result['address']."</td>  
                               <td>".$result['email']."</td>  
                    
                               <td><a id='btn'>Requested</a></td>  
                          </tr>  
                     ";  
                }  
           }  
      ?>  
 </table> 
 <div class="note">
 <p>NOTE :- Receiver will contact you for further processes </p>
 </div> 
          
 </body>  
 </html>  