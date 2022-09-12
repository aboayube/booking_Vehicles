<!-- delete from database the receipt_vehicles by id -->
<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from receipt_vehicles where id=?");
    $stmt->execute(array($id));
    header("Location:receipt_vehicles.php?success=3");
    exit;
} else {
    header("Location:receipt_vehicles.php");
    exit;
}
