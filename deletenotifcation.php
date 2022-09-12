<!-- delete from database the notification by id and by to_id -->
<?php
session_start();
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from notification where id=? and to_id=?");
    $stmt->execute(array($id, $_SESSION['user_id']));
    //sending success message that success= 3
    header("Location:notification.php?success=3");
    exit;
} else {
    header("Location:notification.php");
    exit;
}
