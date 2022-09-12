<!-- delete from database the category by id -->
<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from categories where id=?");
    $stmt->execute(array($id));

    header("Location:categories.php?success=3");
    exit;
} else {
    header("Location:categories.php");
    exit;
}
?>