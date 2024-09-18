<!DOCTYPE html>
<html>
<head>
    <title>Food Receiver Page</title>
    <style>
        /* Reset some default styles */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
}

/* Header styles */
header {
    background-color: #4CAF50;
    padding: 20px;
    text-align: center;
}

header h1 {
    color: white;
    margin: 0;
    font-size: 32px;
}

a.home {
    color:black;
    text-decoration: none;
    font-size: 18px;
    padding-left: 20px;
}

a.home:hover {
    text-decoration: underline;
}

/* Table styles */
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

th, td {
    text-align: left;
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Form styles */
#detailsForm {
    margin-top: 20px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
    text-align: center;
}

form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

form input[type="text"],
form input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form input[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <h2>Available Food List</h2>
    <a href="main.html" class="home">Go to Home</a>

    <?php
    // Connect to the database
    $connection = mysqli_connect('localhost', 'root', 'qwerty@123!', 'foodwaste');

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve donor information from the database
    $sql = "SELECT * FROM available_food";
    $result = mysqli_query($connection, $sql);

    // Check if any records are returned
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Food Item</th><th>Quantity</th><th>Donor Name</th><th>Donor Contact</th><th>Additional Information</th><th>Create Datetime</th><th>Action</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['food_item'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['donor_name'] . "</td>";
            echo "<td>" . $row['donor_contact'] . "</td>";
            echo "<td>" . $row['additional_information'] . "</td>";
            echo "<td>" . $row['create_datetime'] . "</td>";
            echo '<td><button onclick="requestFood(this)">Request Food</button></td>';
           
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No donors found.";
    }

    // Close the database connection
    mysqli_close($connection);
    ?>
       <div id="detailsForm" style="display: none;">
    <h2>Recipient Details</h2>
    <form id="recipientForm" method="POST" action="process_request.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" id="contact" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="address">Message:</label>
        <input type="text" name="address" id="address" required><br>

        <label for="donor_email">Donor's Email:</label>
        <input type="email" name="donor_email" id="donor_email" required><br>

        <input type="submit" id="submitButton" value="Submit" onclick="button.disabled = true;">
    </form>
</div>


<script>
    function requestFood(button) {
        var row = button.parentNode.parentNode;
        var item = row.getElementsByTagName('td')[0].innerHTML;

        // Display the confirmation dialog
        var confirmDialog = confirm("Are you sure you want to request this food?");
        if (confirmDialog) {
            // Disable the request button
            
          button.disabled = true;

            // Display the recipient information form
            var detailsForm = document.getElementById('detailsForm');
            detailsForm.style.display = 'block';

            // Submit the form and handle the response
            var recipientForm = document.getElementById('recipientForm');
            recipientForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Disable the submit button
                var submitButton = document.getElementById('submitButton');
                submitButton.disabled = true;

                // Submit the form data
                var formData = new FormData(this);
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Process the response
                            if (xhr.responseText === 'success') {
                                // Update UI or show a success message
                                console.log('Form submitted successfully!');
                                // Convert the button to a requested button
                                button.value = 'Requested';
                                button.disabled = false;
                                button.classList.remove('request-button');
                                button.classList.add('requested-button');
                            } else {
                                // Show an error message or handle the error case
                                console.log('Form submission failed.');
                            }
                        } else {
                            // Show an error message or handle the error case
                            console.log('An error occurred during form submission.');
                        }
                    }
                };

                xhr.open('POST', recipientForm.action, true);
                xhr.send(formData);
            });
        }
    }
  function redirectToPage(){
    window.location.href="Main.html";
    }


    // ... (existing JavaScript code) ...

recipientForm.addEventListener('submit', function(event) {
    event.preventDefault();

    // Disable the submit button
    var submitButton = document.getElementById('submitButton');
    submitButton.disabled = true;

    // Submit the form data
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Process the response
                if (xhr.responseText === 'success') {
                    // Update UI or show a success message
                    console.log('Form submitted successfully!');
                    // Convert the button to a requested button
                    button.value = 'Requested';
                    button.disabled = false;
                    button.classList.remove('request-button');
                    button.classList.add('requested-button');

                    // Remove the row from the table after successful submission
                    var row = button.parentNode.parentNode;
                    row.parentNode.removeChild(row);
                } else {
                    // Show an error message or handle the error case
                    console.log('Form submission failed.');
                    submitButton.disabled = false;
                }
            } else {
                // Show an error message or handle the error case
                console.log('An error occurred during form submission.');
                submitButton.disabled = false;
            }
        }
    };

    xhr.open('POST', recipientForm.action, true);
    xhr.send(formData);
});

// ... (existing JavaScript code) ...

</script>
