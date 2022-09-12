<!-- delete from database the VIP customer by id -->
<?php
include('include/connect.php');
$id = $_GET['id'];

if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete from clubs  where user_Id=?");
    $stmt->execute(array($id));

    header("Location:users_clubs.php?success=3");
    exit;
} else {
    header("Location:users_clubs.php");
    exit;
}

?>