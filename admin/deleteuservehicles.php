<!-- delete from database the orders by id -->

<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from vec_order where id=?");
    $stmt->execute(array($id));

    header("Location:user_vehicles.php?success=3");
    exit;
} else {
    header("Location:user_vehicles.php");
    exit;
}
?>
