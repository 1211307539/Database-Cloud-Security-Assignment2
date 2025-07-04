<?php
include "../../connection.php";

if (isset($_GET['PROP_ID'])) {
    $id = $_GET['PROP_ID'];
    $sql = "UPDATE property SET status='available' WHERE PROP_ID = $id";
    $conn->query($sql);

    header('location:/admin/approvalList.php');
}

exit;
?>
