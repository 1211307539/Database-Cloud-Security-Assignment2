<?php
include "../connection.php";

if (isset($_GET['PROP_ID']) && is_numeric($_GET['PROP_ID'])) {
    $prop_id = (int)$_GET['PROP_ID'];

    $sql = "DELETE FROM property WHERE PROP_ID = :prop_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':prop_id', $prop_id, PDO::PARAM_INT);
    
    $stmt->execute();
}

header('Location: /admin/propertyList.php');
exit;
?>
