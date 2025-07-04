<?php
include "../connection.php";

if (isset($_GET['USER_ID']) && is_numeric($_GET['USER_ID'])) {
    $id = (int)$_GET['USER_ID'];

    $stmt = $conn->prepare("DELETE FROM heather.users WHERE USER_ID = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: userList.php');
    exit;
}

if (isset($_GET['PROP_ID']) && is_numeric($_GET['PROP_ID'])) {
    $prop_id = (int)$_GET['PROP_ID'];

    $stmt = $conn->prepare("DELETE FROM property WHERE PROP_ID = :prop_id");
    $stmt->bindParam(':prop_id', $prop_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: propertyList.php');
    exit;
}

header('Location: /'); // fallback in case of no valid parameter
exit;
?>
