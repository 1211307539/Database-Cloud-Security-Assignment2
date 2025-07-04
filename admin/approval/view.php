<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <style>
        body {
            font-family: Inria Serif;
            padding: 20px;
        }

        .property-details {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        .close-button {
            background-color: #0079E8;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
    include "../../connection.php";
    if (isset($_GET['PROP_ID'])) {
        $propId = $_GET['PROP_ID'];

        $sql = "SELECT *, CONCAT(users.USER_FNAME, ' ', users.USER_LNAME) AS user_name 
                FROM property
                INNER JOIN users ON property.ADVERTISER_ID = users.USER_ID 
                WHERE property.PROP_ID = $propId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <div class="property-details">
                <h1>Property Details</h1>
                <img src="../../<?php echo $row['image']; ?>" alt="Property Image" style="max-width: 100%; height: auto;">
                <p><strong>ID:</strong> <?php echo $row['PROP_ID']; ?></p>
                <p><strong>Property Advertiser:</strong> <?php echo $row['user_name']; ?></p>
                <p><strong>Property Advertiser ID:</strong> <?php echo $row['ADVERTISER_ID']; ?></p>
                <p><strong>Property Name:</strong> <?php echo $row['PROP_NAME']; ?></p>
                <p><strong>Property Address:</strong> <?php echo $row['PROP_ADDRESS']; ?></p>
                <p><strong>Postcode:</strong> <?php echo $row['POSTCODE']; ?></p>
                <p><strong>Floor Area (in square metre):</strong> <?php echo $row['FLOOR_AREA']; ?></p>
                <p><strong>Room Number:</strong> <?php echo $row['ROOM_NUM']; ?></p>
                <p><strong>Property Description:</strong> <?php echo $row['PROP_DESCRIPTION']; ?></p>
                <p><strong>Property Price:</strong> <?php echo $row['PROP_PRICE']; ?></p>
                <p><strong>Property Rules:</strong> <?php echo $row['PROP_RULES']; ?></p>
                <p><strong>Status:</strong> <?php echo $row['status']; ?></p>

                <button class="close-button" onclick="history.back()">Close</button>
            </div>
            
            <?php
        } else {
            echo "Property not found.";
        }
    } else {
        echo "Invalid property ID.";
    }?>
</body>
</html>
