<!-- delete from database the notification by id -->

<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from notification where id=?");
    $stmt->execute(array($id));

    header("Location:notifications.php?success=3");
    exit;
} else {
    header("Location:notifications.php");
    exit;
}
?>
