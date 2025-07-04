<?php
include "../connection.php"; // Ensure this sets up a PDO connection in $pdo

if (isset($_POST['submit'])) {
    $email = $_POST['USER_EMAIL'];
    $phone = $_POST['USER_CONTACT'];
    $password = $_POST['USER_PASS'];
    $confirmPassword = $_POST['CONFIRM_PASS'];
    $fname = $_POST['USER_FNAME'];
    $lname = $_POST['USER_LNAME'];

    $errors = array();

    if (empty($email) || empty($phone) || empty($password) || empty($fname) || empty($lname)) {
        array_push($errors, "Fill in all fields!");
    }

    if ($password !== $confirmPassword) {
        array_push($errors, "Passwords do not match!");
    }

    if (empty($errors)) {
        try {
            // Check if email already exists
            $stmt = $conn->prepare("SELECT 1 FROM heather.admins WHERE ADMIN_EMAIL = ?");
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                array_push($errors, "Email already registered!");
            } else {

                $insert = $conn->prepare("INSERT INTO heather.admins 
                    (ADMIN_EMAIL, ADMIN_PASS, ADMIN_FNAME, ADMIN_LNAME, ADMIN_CONTACT, USER_TYPE)
                    VALUES (?, ?, ?, ?, ?, 'Admin')");

                if ($insert->execute([$email, $password, $fname, $lname, $phone])) {
                    echo "<script>alert('You are registered successfully.');
                          window.location.href = 'adminLoginPage.php';</script>";
                    exit;
                } else {
                    array_push($errors, "Something went wrong. Please try again.");
                }
            }
        } catch (PDOException $e) {
            array_push($errors, "Database error: " . $e->getMessage());
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather</title>
    <link rel="icon" href="icon.ico" type="image/x-icon">

    <style>
        body {
            margin: 0;
            background-color: powderblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 40%;
            padding: 20px;
            background-color: white;
            height: 100%;
            text-align: center;
        }

        h1 {
            font-size: 100px;
            margin-top: 40px;
            margin-bottom: 0px;
        }

        .welcome {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 30px;
            text-align: center;
            align-items: center;
            justify-content: flex-start;
        }

        .option-buttons {
            display: flex;
            justify-content: left;
            align-items: center;
            margin-bottom: 10px;
        }

        .option-button {
            width: 25px;
            height: 25px;
            background-color: #fff; 
            border: 2px solid #3498db; 
            border-radius: 50%;
            margin: 0 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .button-name {
            margin-left: 4px;
            font-size: 16px;
        }

        .option-button.selected {
            background-color: #3498db; 
            border: 2px solid #fff; 
        }

        .form-control {
            margin: 10px 0 20px 0;
            padding: 8px 20px;
            width: 70%;
            box-sizing: border-box;
            font-size: 16px;
        }

        .password-description {
            margin-top: 3px;
            font-size: 16px;
            color: #555;
            text-align: left;
            font-style: italic;
            font-weight: bold;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            justify-content: center; 
            margin-top: 20px;
            text-align: left;
            margin-bottom: 40px;
        }

        .checkbox {
            margin-right: 10px;
        }

        .terms-text {
            font-size: 16px;
            color: #555;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
 
        .register-button {
            padding: 8px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .register-button.enabled {
            pointer-events: auto; 
            background-color: #2980b9;
        }

        .login-link-container {
            margin-top: 20px;
            font-size: 18px;
            color: #555;
        }

        .login-link {
            text-decoration: underline;
            cursor: pointer;
        }

        .error {
            padding: 5px;
            background-color: #F2DEDE;
            color: #A94442;
            width: fit-content;
            margin: auto;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Heather</h1>
        <p class="welcome">Register as admin</p>

        <form action="adminRegistrationPage.php" method="post">
        <input type="text" name="USER_EMAIL" class="form-control" placeholder="Email">
        <input type="text" name="USER_CONTACT" class="form-control" placeholder="Phone Number">
        <input type="text" name="USER_PASS" class="form-control" placeholder="Password">
        <input type="text" name ="CONFIRM_PASS" class="form-control" placeholder="Confirm Password">
        <input type="text" name="USER_FNAME" class="form-control" placeholder="First Name">
        <input type="text" name="USER_LNAME" class="form-control" placeholder="Last Name">

        <div class="checkbox-container">
            <input type="checkbox" class="checkbox" id="agreeTerms" onclick="updateRegisterButtonState()">
            <label for="agreeTerms" class="terms-text" onclick="openModal()">I have read and agreed to the <a href="#">Terms and Conditions</a></label>
        </div>

        <div id="termsModal" class="modal">
          <div class="modal-content">
              <span class="close" onclick="closeModal()">&times;</span>
              <h2 style="text-align: center; font-size: 20px;">Terms and Conditions</h2>
              <p>hello welcome to heather! This is the terms and regulations!</p>
          </div>
        </div>

        <button type="submit" class="register-button" name="submit">Register</button>
        </form>

        <div class="login-link-container">
            Already have an account? <span class="login-link" onclick="redirectPage('adminLoginPage')">Sign in</span>
        </div>
    </div>

    <script src="../redirectPage.js">
        </script>

    <script>

        function openModal() {
            const modal = document.getElementById('termsModal');
            modal.style.display = 'block';
        }

        function closeModal() {
            const modal = document.getElementById('termsModal');
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            const modal = document.getElementById('termsModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    </script>

</body>
</html>
