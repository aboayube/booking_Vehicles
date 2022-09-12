<!-- delete from database the contactus by id -->
<?php
include('include/connect.php');
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("delete  from contact_us where id=?");
    $stmt->execute(array($id));

    header("Location:contact_us.php?success=3");
    exit;
} else {
    header("Location:contact_us.php");
    exit;
}
?>
