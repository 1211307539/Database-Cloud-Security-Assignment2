<?php
// include "connection.php";

// if (empty($errors)) {
//     // Hash the password before storing
//     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//     $sql = "INSERT INTO `users` (`USER_EMAIL`, `USER_PASS`, `USER_FNAME`, `USER_LNAME`, `USER_CONTACT`, `USER_TYPE`) 
//             VALUES (?, ?, ?, ?, ?, ?)";

//     $stmt = mysqli_stmt_init($conn);

//     if (mysqli_stmt_prepare($stmt, $sql)) {
//         mysqli_stmt_bind_param($stmt, "ssssss", $email, $hashedPassword, $fname, $lname, $phone, $userRole);

//         if (mysqli_stmt_execute($stmt)) {
//             echo "<script>alert('You have registered successfully!');
//                   window.location.href = 'login.php';</script>";
//         } else {
//             echo "<script>alert('Something went wrong: " . mysqli_stmt_error($stmt) . "');</script>";
//         }
//     } else {
//         echo "<div class='alert alert-danger'>Statement preparation failed.</div>";
//     }

//     mysqli_stmt_close($stmt);
// }

include "connection.php"; // Ensure this uses PDO and $conn is a PDO instance

if (empty($errors)) {
    // Hash the password before storing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users` (`USER_EMAIL`, `USER_PASS`, `USER_FNAME`, `USER_LNAME`, `USER_CONTACT`, `USER_TYPE`) 
            VALUES (:email, :password, :fname, :lname, :contact, :userType)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':contact', $phone);
        $stmt->bindParam(':userType', $userRole);

        if ($stmt->execute()) {
            echo "<script>alert('You have registered successfully!');
                  window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather</title>
    <link rel="icon" href="img/icon.ico" type="image/x-icon">

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
            width: 50%;
            padding: 20px;
            background-color: white;
            height: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        .account-selection {
            margin-bottom: 20px;
            font-size: 20px;
            text-align: left;
            display: flex;
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

        .input-bar {
            margin: 10px 0;
            padding: 8px 20px;
            width: 100%;
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
            margin-top: 15px;
            text-align: left;
            margin-bottom: 15px;
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
            pointer-events: none;
        }

        .register-button.enabled {
            pointer-events: auto; 
            background-color: #2980b9;
        }

        .login-link-container {
            margin-top: 5px;
            font-size: 18px;
            color: #555;
        }

        .login-link {
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
            <h1>Create a Heather Account</h1>
            <p class="account-selection">Select an account:</p>

        <form action="register.php" method="POST">
            <div class="option-buttons">
                <div class="option-button" onclick="toggleButton('tenant')" data-option="tenant"></div>
                <span class="button-name">Tenant</span>
                <div class="option-button" onclick="toggleButton('propertyAdvertiser')" data-option="propertyAdvertiser"></div>
                <span class="button-name">Property Advertiser</span>
            </div>

            <input type="hidden" name="USER_TYPE" id="userRole" value=""> 
            <input type="text" name="USER_EMAIL" class="input-bar" placeholder="Email" oninput="updateRegisterButtonState()">
            <input type="text" name="USER_CONTACT" class="input-bar" placeholder="Phone Number" oninput="updateRegisterButtonState()">
            <input type="text" name="USER_PASS" class="input-bar" placeholder="Password" oninput="updateRegisterButtonState()">
            <p class="password-description">6 characters or more.</p>
            <input type="text" name="CONFIRM_PASS" class="input-bar" placeholder="Confirm Password" oninput="updateRegisterButtonState()">
            <input type="text" name="USER_FNAME" class="input-bar" placeholder="First Name" oninput="updateRegisterButtonState()">
            <input type="text" name="USER_LNAME" class="input-bar" placeholder="Last Name" oninput="updateRegisterButtonState()">

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

            <button type="submit" class="register-button" name="submit" onclick="registerUser()">Register</button>
        </form>
            <div class="login-link-container">
                Already have an account? <span class="login-link" onclick="redirectToLoginPage()">Sign in</span>
            </div>
    </div>

    <script>
        function toggleButton(option) {
            const tenantButton = document.querySelector('.option-button[data-option="tenant"]');
            const propertyAdvertiserButton = document.querySelector('.option-button[data-option="propertyAdvertiser"]');
            const userRoleInput = document.getElementById('userRole');

            if (option === 'tenant') {
                tenantButton.classList.add('selected');
                propertyAdvertiserButton.classList.remove('selected');
                userRoleInput.value = 'Tenant';
            } else if (option === 'propertyAdvertiser') {
                tenantButton.classList.remove('selected');
                propertyAdvertiserButton.classList.add('selected');
                userRoleInput.value = 'Advertiser';
            }
        }

        function updateRegisterButtonState() {
            const agreeTermsCheckbox = document.getElementById('agreeTerms');
            const registerButton = document.querySelector('.register-button');
            const inputFields = document.querySelectorAll('.input-bar');

            let allFieldsFilled = true;
            inputFields.forEach(input => {
                if (input.value.trim() === '') {
                    allFieldsFilled = false;
                }
            });

            if (allFieldsFilled && agreeTermsCheckbox.checked) {
                registerButton.classList.add('enabled');
            } else {
                registerButton.classList.remove('enabled');
            }
        }

        function registerUser() {
            const form = document.querySelector('form');
            form.submit();        
        }

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

        function redirectToLoginPage() {
            window.location.href = 'login.php';
        }
    </script>
</body>
</html>
