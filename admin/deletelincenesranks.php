<!-- delete from database the lincenesrank by id -->
<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from lincenesrank where id=?");
    $stmt->execute(array($id));

    header("Location:lincenesrank.php?success=3");
    exit;
} else {
    header("Location:lincenesrank.php");
    exit;
}
?>