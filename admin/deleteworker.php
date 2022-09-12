<!-- delete from database the workers by id -->

<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {

    $stmt = $con->prepare("delete  from users where id=?");
    $stmt->execute(array($id));

    header("Location:worker.php?success=3");
    exit;
} else {
    header("Location:worker.php");
    exit;
}
?>
