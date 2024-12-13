<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $age = htmlspecialchars($_POST['age']);
    $gender = htmlspecialchars($_POST['gender']);
    $source_add = htmlspecialchars($_POST['source_add']);
    $destination_add = htmlspecialchars($_POST['destination_add']);
    $pass_type = htmlspecialchars($_POST['pass_type']);
    $booking_date = htmlspecialchars($_POST['booking_date']); // Retrieve the booking date
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT); // Hash the password
    $pass_id = str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT); // Generate a unique 12-digit pass ID

    // Basic validation
    if (empty($name) || empty($phone) || empty($email) || empty($age) || empty($gender) || empty($source_add) || empty($destination_add) || empty($pass_type) || empty($booking_date) || empty($password) || empty($pass_id)) {
        echo "<h2 style='color: red;'>All fields are required. Please go back and fill out the form completely.</h2>";
        exit;
    }

    // Calculate validity date based on pass type
    $valid_pass_types = ['daily', 'weekly', 'monthly']; // Define valid pass types
    if (!in_array($pass_type, $valid_pass_types)) {
        echo "<h2 style='color: red;'>Invalid pass type. Please select a valid pass type.</h2>";
        exit;
    }

    $created_at = date('Y-m-d', strtotime($booking_date)); // Get the booking date

    if ($pass_type == 'daily') {
        $validity_end = date('Y-m-d', strtotime($created_at . ' +1 day'));
    } elseif ($pass_type == 'weekly') {
        $validity_end = date('Y-m-d', strtotime($created_at . ' +1 week'));
    } elseif ($pass_type == 'monthly') {
        $validity_end = date('Y-m-d', strtotime($created_at . ' +1 month'));
    }

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password_db = "1234";
    $dbname = "passify";

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO applications (name, phone, email, age, gender, source_add, destination_add, pass_type, booking_date, password, pass_id, created_at, validity_end) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiissssssss", $name, $phone, $email, $age, $gender, $source_add, $destination_add, $pass_type, $booking_date, $password, $pass_id, $created_at, $validity_end);

    if ($stmt->execute()) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Application Submitted</title>
            <link rel="stylesheet" href="applicationOutput.css">
        </head>
        <body>
         <header>
            <nav>
                <div class="logo"> PASSIFY </div>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                </ul>
            </nav>
        </header>
            <div class="container">
                <h1>Application Submitted Successfully</h1>
                <p><strong>Pass ID:</strong> ' . $pass_id . '</p>
                <p><strong>Name:</strong> ' . $name . '</p>
                <p><strong>Phone:</strong> ' . $phone . '</p>
                <p><strong>Email:</strong> ' . $email . '</p>
                <p><strong>Age:</strong> ' . $age . '</p>
                <p><strong>Gender:</strong> ' . $gender . '</p>
                <p><strong>Source Address:</strong> ' . $source_add . '</p>
                <p><strong>Destination Address:</strong> ' . $destination_add . '</p>
                <p><strong>Pass Type:</strong> ' . $pass_type . '</p>
                <p><strong>Booking Date:</strong> ' . $booking_date . '</p>
                <p><strong>Validity:</strong> From ' . $created_at . ' to ' . $validity_end . '</p>
                
            </div>
        </body>
        </html>';
    } else {
        echo "<h2 style='color: red;'>Error: " . $stmt->error . "</h2>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h2 style='color: red;'>Invalid Request. Please submit the form first.</h2>";
}
?>
