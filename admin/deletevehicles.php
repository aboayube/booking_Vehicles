<!-- delete from database the vehicle by id -->

<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from vehicles where id=?");
    $stmt->execute(array($id));

    header("Location:vehicles.php?success=3");
    exit;
} else {
    header("Location:vehicles.php");
    exit;
}
?>
