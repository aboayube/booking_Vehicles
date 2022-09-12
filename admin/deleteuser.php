<!-- delete from database the user by id -->

<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete from users where id=?");
    $stmt->execute(array($id));

    header("Location:users.php?success=3");
    exit;
} else {
    header("Location:users.php");
    exit;
}
?>
