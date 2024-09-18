<html>
    <head>
        <style>
             header{  
      width: 100%;  
      height: 60px;  
      background-color: #ccc;
      color:black;
      text-align: center;
      font-size:20px;
 } 
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }
    
            h2 {
                color: #333;
            }
    
            form {
                width: 400px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            }
    
            label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
            }
    
            input[type="text"],
            input[type="number"],
            textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            /* In your CSS file or <style> tag */
       .link-text {
               font-size: 25px; /* You can change this value to adjust the font size */
               padding-left: 30px;
                }

    
            textarea {
                resize: vertical;
            }
            .a{
                font-size: 30px;
            }
    
            input[type="submit"] {
                background-color: #4CAF50;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
    
            input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
        
    
    </head>
    <body>
    <div id="detailsForm">
       <header><h2>Recipient Details</h2></header> 
       <a href="Main.html" class="link-text">Home</a>


         <form method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>

            <label for="contact">Contact:</label>
            <input type="text" name="contact" required><br>

            <label for="address">Address:</label>
            <input type="text" name="address" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
           
            <input type="submit" onclick="showDonorAlert()" value="Submit">
    </form>    
    </div>
    <script>
        function showDonorAlert() {
            // Display an alert message
            alert("Request submitted successfully  Please contact the requested donor for further information.");
        }
    </script>
</body>
</html>
<?php
// Connect to the database
$connection = mysqli_connect('localhost', 'root', 'qwerty@123!', 'foodwaste');

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
// Retrieve the recipient information from the form
$name = $_POST['name'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$email = $_POST['email'];

// Donor's email entered by the recipient manually
//$donor_email = $_POST['donor_email'];

// Prepare the INSERT statement
$sql = "INSERT INTO recipient (name, contact, address, email) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($connection);
?>

