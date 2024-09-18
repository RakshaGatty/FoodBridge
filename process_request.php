<?php
// Connect to the database
$connection = mysqli_connect('localhost', 'root', 'qwerty@123!', 'foodwaste');

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the recipient information from the form
$name = $_POST['name'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$email = $_POST['email'];

// Donor's email entered by the recipient manually
$donor_email = $_POST['donor_email'];

// Prepare the INSERT statement
$sql = "INSERT INTO recipient (name, contact, address, email) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $sql);

// Bind parameters to the statement
mysqli_stmt_bind_param($stmt, 'ssss', $name, $contact, $address, $email);

// Execute the statement
mysqli_stmt_execute($stmt);

// Check if the insertion was successful
if (mysqli_stmt_affected_rows($stmt) > 0) {
    // Send an email notification to the donor
    $subject = 'Food Request Notification';
    $message = "Hello,\n\nYour food item has been requested by $name.\n\nRecipient Details:\nName: $name\nContact: $contact\nAddress: $address\n\nThank you for your contribution!\n\nBest regards,\nThe Food Waste Team";
    $headers = "From: pratheeksharaju2004@gmail.com"; // Replace with your email address

    // Use the mail() function to send the email
    $mailSent = mail($donor_email, $subject, $message, $headers);

    if ($mailSent) {
        echo "Request submitted successfully. Email sent to the donor.";
    } else {
        echo "Request submitted successfully, but email sending to the donor failed.";
    }
} else {
    echo "Error submitting request.";
}
$run = mysqli_query($connection,$mailSent);  
      if ($run) {  
           header('location:Main.html');  
      }else{  
           echo "Error: ".mysqli_error($conn);  
      }  


// Close the insert statement
mysqli_stmt_close($stmt);


// Close the database connection
mysqli_close($connection);
?>
