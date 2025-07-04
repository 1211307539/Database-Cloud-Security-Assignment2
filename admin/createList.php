<?php 
include "../connection.php";

if (isset($_POST['submit'])) {
    $email = $_POST['USER_EMAIL'];
    $fname = $_POST['USER_FNAME'];
    $lname = $_POST['USER_LNAME'];
    $phone = $_POST['USER_CONTACT'];
    $type = $_POST['USER_TYPE'];
    $password = password_hash($_POST['USER_PASS_HASH'], PASSWORD_DEFAULT);


    try {
        $stmt = $conn->prepare("
            INSERT INTO heather.users (USER_EMAIL, USER_FNAME, USER_LNAME, USER_CONTACT, USER_TYPE, USER_PASS_HASH)
            VALUES (:email, :fname, :lname, :phone, :type, :password)
        ");

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':type', $type);

        $stmt->execute();

        header("Location: userList.php");
        exit;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // You can replace this with better error handling/logging
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Heather Create New User</title>

    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Inria Serif;
            overflow: hidden;
        }

        header {
            background-color: #ACDEEE;
            padding-left: 10px;
            border: 0.5px solid #333;
            font-size: 28px;
        }

        .col {
            max-width: 600px;
            margin: 0 auto;
        }

        form {
            margin-top: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
        }

        .card-header {
            background-color: #ACDEEE;
            color: white;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        label {
            margin-bottom: 5px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button{
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .btn-cancel {
            margin-top: 20px;
            width: 96%;
            padding: 10px;
            background-color: #17a2b8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            text-align: center;
        }

        .btn-cancel:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>

<header>
    <h1>Heather</h1>
</header>

<div class="col">
    <form method="post">
        <div class="card">
            <div class="card-header bg-primary"></div>

            <label for="USER_FNAME">First Name:</label>
            <input type="text" name="USER_FNAME" class="form-control">

            <label for="USER_LNAME">Last Name:</label>
            <input type="text" name="USER_LNAME" class="form-control">

            <label for="USER_EMAIL">Email:</label>
            <input type="text" name="USER_EMAIL" class="form-control">

            <label for="USER_PASS_HASH">Password:</label>
            <input type="text" name="USER_PASS_HASH" class="form-control">

            <label for="USER_CONTACT">Phone:</label>
            <input type="text" name="USER_CONTACT" class="form-control">

            <label for="USER_TYPE">User Type:</label>
            <select name="USER_TYPE" class="form-control">
                <option value="tenant">Tenant</option>
                <option value="advertiser">Advertiser</option>
            </select>

            <button class="btn btn-success" type="submit" name="submit">Submit</button>
            <a class="btn btn-cancel" type="cancel" name="cancel" href="userList.php">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
