<?php
include "../connection.php";

$id = "";
$name = "";
$fname = "";
$lname = "";
$email = "";
$phone = "";
$type = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    if (!isset($_GET['USER_ID']) || !is_numeric($_GET['USER_ID'])) {
        header("Location: /admin/userList.php");
        exit;
    }

    $id = (int)$_GET['USER_ID'];

    $sql = "SELECT * FROM heather.users WHERE USER_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("Location: /admin/userList.php");
        exit;
    }

    $email = $row['USER_EMAIL'];
    $password = $row['USER_PASS'];
    $fname = $row['USER_FNAME'];
    $lname = $row['USER_LNAME'];
    $phone = $row['USER_CONTACT'];
    $type = $row['USER_TYPE'];

} elseif ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (!isset($_POST['USER_ID']) || !is_numeric($_POST['USER_ID'])) {
        header("Location: /admin/userList.php");
        exit;
    }

    $id = (int)$_POST["USER_ID"];
    $email = $_POST['USER_EMAIL'];
    $password = $_POST['USER_PASS'];
    $fname = $_POST['USER_FNAME'];
    $lname = $_POST['USER_LNAME'];
    $phone = $_POST['USER_CONTACT'];
    $type = $_POST['USER_TYPE'];

    $sql = "UPDATE heather.users 
            SET USER_EMAIL = :email, USER_PASS = :password, USER_FNAME = :fname, 
                USER_LNAME = :lname, USER_CONTACT = :phone, USER_TYPE = :type 
            WHERE USER_ID = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>
            alert('User updated successfully.');
            window.location.href = 'userList.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Error updating user.');
            window.location.href = 'userList.php';
        </script>";
        exit;
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

            <input type="hidden" name="USER_ID" value="<?php echo $id; ?>" class="form-control"> <br>

            <label for="USER_FNAME">First Name:</label>
            <input type="text" name="USER_FNAME" class="form-control" placeholder="<?php echo $fname; ?>">

            <label for="USER_LNAME">Last Name:</label>
            <input type="text" name="USER_LNAME" class="form-control" placeholder="<?php echo $lname; ?>">

            <label for="USER_EMAIL">Email:</label>
            <input type="text" name="USER_EMAIL" class="form-control" placeholder="<?php echo $email; ?>">

            <label for="USER_PASS">Password:</label>
            <input type="text" name="USER_PASS" class="form-control">

            <label for="USER_CONTACT">Phone:</label>
            <input type="text" name="USER_CONTACT" class="form-control" placeholder="<?php echo $phone; ?>">

            <label for="USER_TYPE">User Type:</label>
            <select name="USER_TYPE" class="form-control">
                <option value="tenant" <?php echo ($type == 'tenant') ? 'selected' : ''; ?>>Tenant</option>
                <option value="advertiser" <?php echo ($type == 'advertiser') ? 'selected' : ''; ?>>Advertiser</option>
            </select>

            <button class="btn btn-success" type="submit" name="submit">Edit</button>
            <a class="btn btn-cancel" type="cancel" name="cancel" href="userList.php">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
