<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            color: #000000;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 600;
            font-size: 18px;
        }

        nav {
            height: 50px;
            width: 100%;
            background-color: rgba(232, 232, 232, 0.95);
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        nav ul li a:hover {
            color: #000000;
            transition: background-color 0.15s ease;
            border: 2px solid #856cae;
            border-radius: 25px;
            background-color: #e5d5ff;
        }

        .logo {
            margin-right: 40px;
            font-weight: 700;
            font-size: 23px;
            cursor: pointer;
            padding: 7px;
            background-color: #bba9d8;
            border-radius: 7px;
        }

        nav ul {
            display: flex;
            width: 100%;
            justify-content: space-around;
            align-items: center;
        }

        nav ul li {
            list-style: none;
        }

        nav li a {
            padding: 7px;
            border-radius: 25px;
            color: black;
            text-decoration: none;
        }

        nav button {
            font-family: 'Courier New', Courier, monospace;
            font-weight: 600;
            color: black;
            border-radius: 20px;
            border: 1px solid black;
            padding: 8px;
            cursor: pointer;
            background-color: rgba(232, 232, 232, 0.525);
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin: auto;
            margin-top: 70px;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .profile-item strong {
            flex: 1;
            color: #555;
        }

        .profile-item span {
            flex: 2;
            color: #000;
        }

        .print-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            width: 100%;
            text-align: center;
            text-decoration: none;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 700;
        }

        .print-button:hover {
            background-color: #45a049;
        }

        h1 {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo"> PASSIFY </div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="index.html#services">Services</a></li>
                <li><a href="index.html#pricing">Pricing</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
    <div class="logo"> PASSIFY   </div>  
        <!-- <h1>User Profile</h1> -->
        <div class="profile-item">
            <strong>Pass ID:</strong>
            <span><?php echo htmlspecialchars($user['pass_id']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Name:</strong>
            <span><?php echo htmlspecialchars($user['name']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Phone:</strong>
            <span><?php echo htmlspecialchars($user['phone']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Email:</strong>
            <span><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Age:</strong>
            <span><?php echo htmlspecialchars($user['age']); ?></span>
        </div>
        <!-- <div class="profile-item">
            <strong>Gender:</strong>
            <span><?php echo htmlspecialchars($user['gender']); ?></span>
        </div> -->
        <div class="profile-item">
            <strong>Source Address:</strong>
            <span><?php echo htmlspecialchars($user['source_add']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Destination Address:</strong>
            <span><?php echo htmlspecialchars($user['destination_add']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Pass Type:</strong>
            <span><?php echo htmlspecialchars($user['pass_type']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Booking Date:</strong>
            <span><?php echo htmlspecialchars($user['booking_date']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Validity:</strong>
            <span>From <?php echo htmlspecialchars($user['created_at']); ?> to <?php echo htmlspecialchars($user['validity_end']); ?></span>
        </div>
        <button class="print-button" onclick="window.print()">Print Profile</button>
    </div>
</body>

</html>
