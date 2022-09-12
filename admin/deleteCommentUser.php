<!-- delete from database the comments vehciles by id -->
<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from comments_vehicles where id=?");
    $stmt->execute(array($id));

    header("Location:commentsuser.php?success=3");
    exit;
} else {
    header("Location:commentuser.php");
    exit;
}

?>