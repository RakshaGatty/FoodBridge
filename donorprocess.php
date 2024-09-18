<?php
// Assuming you have established a database connection
$connection = mysqli_connect('localhost', 'root', 'qwerty@123!', 'foodwaste');

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $foodItem = $_POST['food_item'];
    $quantity = $_POST['quantity'];
    $donorName = $_POST['donor_name'];
    $donorContact = $_POST['donor_contact'];
    $additionalInfo = $_POST['additional_information'];
    $createDatetime = date('Y-m-d H:i:s');
    
    // Prepare the INSERT statement
    $sql = "INSERT INTO available_food (food_item, quantity, donor_name, donor_contact, additional_information, create_datetime) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);

    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, 'sissss', $foodItem, $quantity, $donorName, $donorContact, $additionalInfo, $createDatetime);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check if the insertion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "";
    } else {
        echo "Error inserting data.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter Food Data</title>
    <a href="main.html" class="home">Go to Home</a>
    <style>
        header{
            text-align: center;
            background-color: #ccc;
            size:40px;
            color:black;
        }
        a.home {
    color:black;
    text-decoration: none;
    font-size: 18px;
    padding-left: 20px;
    padding-top: 50px;
}

a.home:hover {
    text-decoration: underline;
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

        textarea {
            resize: vertical;
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
    <header>
    <h2>Enter Food Data</h2>
    </header>
   
    <form method="POST">
        <label for="food_item">Food items:</label>
        <input type="text" name="food_item" id="food_item" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required><br><br>

        <label for="donor_name">Donor Name:</label>
        <input type="text" name="donor_name" id="donor_name" required><br><br>

        <label for="donor_contact">Donor Contact:</label>
        <input type="text" name="donor_contact" id="donor_contact" required><br><br>

        <label for="additional_information">Additional Information:</label><br>
        <textarea name="additional_information" id="additional_information" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Submit" onclick="redirectToPage()">
    </form>

    <script>
        function redirectToPage(){
            window.location.href="donar_page.html";
        }
    </script>
</body>
</html>
