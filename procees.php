 



<?php
// ... (existing PHP code) ...
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
$row_id = $_POST['row_id'];

// Prepare the INSERT statement
$sql = "INSERT INTO recipient (name, contact, address, email) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $sql);

// Bind parameters to the statement
mysqli_stmt_bind_param($stmt, 'ssss', $name, $contact, $address, $email);

// Execute the statement
mysqli_stmt_execute($stmt);

// Check if the insertion was successful
if (mysqli_stmt_affected_rows($stmt) > 0) {
    // Fetch the donor's email address from the available_food table
    $donor_contact_sql = "SELECT donor_contact FROM available_food WHERE row_id = ?";
    $donor_contact_stmt = mysqli_prepare($connection, $donor_contact_sql);
    mysqli_stmt_bind_param($donor_contact_stmt, 'i', $row_id);
    mysqli_stmt_execute($donor_contact_stmt);
    mysqli_stmt_bind_result($donor_contact_stmt, $donor_contact);
    mysqli_stmt_fetch($donor_contact_stmt);
    mysqli_stmt_close($donor_contact_stmt);

    if ($donor_contact) {
        // Send an email notification to the donor
        $subject = 'Food Request Notification';
        $message = "Hello,\n\nYour food item has been requested by $name.\n\nRecipient Details:\nName: $name\nContact: $contact\nAddress: $address\n\nThank you for your contribution!\n\nBest regards,\nThe Food Waste Team";
        $headers = "From:shibushetty@gmail.com"; // Replace with your email address

        // Use the mail() function to send the email
        $mailSent = mail($donor_contact, $subject, $message, $headers);

        if ($mailSent) {
            echo "Request submitted successfully. Email sent to the donor.";
        } else {
            echo "Request submitted successfully, but email sending to the donor failed.";
        }
    } else {
        echo "Request submitted successfully, but donor email not found.";
    }

    // Fetch the row ID from the form data to identify the row to be deleted
    // ... (existing delete row code) ...
} else {
    echo "Error submitting request.";
}

// Close the insert statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($connection);
?>

