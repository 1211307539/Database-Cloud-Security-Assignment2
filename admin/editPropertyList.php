<?php
include "../connection.php";

$id = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!isset($_GET['PROP_ID']) || !is_numeric($_GET['PROP_ID'])) {
        header("Location: propertyList.php");
        exit;
    }

    $id = (int)$_GET['PROP_ID'];

    $sql = "SELECT status FROM property WHERE PROP_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("Location: propertyList.php");
        exit;
    }

    $status = $row['status'];
    
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['PROP_ID']) || !is_numeric($_POST['PROP_ID'])) {
        header("Location: propertyList.php");
        exit;
    }

    $id = (int)$_POST["PROP_ID"];
    $status = $_POST['status'];

    $sql = "UPDATE property SET status = :status WHERE PROP_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    echo "<script>
            alert('Updated status successfully.');
            window.location.href = 'propertyList.php';
          </script>";
    exit;
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

        .bottom{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
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
            display: inline-block;
            font-weight: bold;
        }

        input, select {
            width: 50%; 
            padding: 8px;
            margin-bottom: 10px;
            display: inline-block; 
            box-sizing: border-box; 
        }
        button{
            width: 20%;
            padding: 8px;
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
            padding: 6px 30px 6px 30px;
            background-color: #17a2b8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
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

            <input type="hidden" name="PROP_ID" value="<?php echo $id; ?>" class="form-control"> <br>

            <label for="status">Property Status:</label>
                <select name="status" class="form-control">
                    <option value="available" <?php echo ($status == 'available') ? 'selected' : ''; ?>>Available</option>
                    <option value="unavailable" <?php echo ($status == 'unavailable') ? 'selected' : ''; ?>>Unavailable</option>
                    <option value="pending" <?php echo ($status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="rejected" <?php echo ($status == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                </select>
            <div class="bottom">
            <button class="btn btn-success" type="submit" name="submit">Update</button>
            <a class="btn btn-cancel" type="cancel" name="cancel" href="propertyList.php">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script src="../redirectPage.js"></script>

</body>
</html>
