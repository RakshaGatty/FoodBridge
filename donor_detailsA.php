<!DOCTYPE html>
<html>
<head>
    <title>Food Receiver Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even){
            color:black;
        }

        #detailsForm {
            display: none;
            margin-top: 20px;
        }

        #detailsForm label {
            display: inline-block;
            width: 120px;
        }

        #detailsForm input[type="text"],
        #detailsForm input[type="email"] {
            width: 300px;
            padding: 8px;
            margin-bottom: 10px;
        }

        #detailsForm input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        #detailsForm input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Donor Details</h2>
    <?php
    // Connect to the database
    $connection = mysqli_connect('localhost', 'root', 'qwerty@123!', 'foodwaste');

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve donor information from the database
    $sql = "SELECT * FROM login1";
    $result = mysqli_query($connection, $sql);

    // Check if any records are returned
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Donor Name</th><th>Email</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No donors found.";
    }

    // Close the database connection
    mysqli_close($connection);
    ?>

    
   
</body>
</html>
