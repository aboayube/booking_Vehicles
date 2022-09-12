<!-- get the comments_vehicles from database  by id -->

<?php
$selected = 'dashborad';
include("include/header.php");
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    //get the comment thats for type of vehicle by licenseNum
    $stmt = $con->prepare("select * from    comments_vehicles where id=? limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $categoies = $stmt->fetch();
    } else {
        echo 'yes';
        exit;
        header("Location:categoies.php");
        exit;
    }
}
$name = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    if (empty($status)) {
        $errors[] = 'you should enter status';
    }
// here we update the comments of vehicles name by id , if we select active as it shows , if not it will be hide

    if (empty($errors)) {
        $sql = $con->prepare("update comments_vehicles  set status=? where id=?");
        $sql->execute(array($status, $id));
        header('location:commentsuser.php?success=2');
    }
}
?>
<?php
if ($errors) {
    foreach ($errors as $error) {
?>
        <div class="AlertMessage">
            <div class="alert alertError">
                <?php echo  '<p">' . $error . '</p>'; ?>
            </div>
        </div><br><br>
<?php }
} ?><div class="data">
    <div class="items">
        <div class="header">
            <h1>EDIT COMMENT </h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="fname"> status</label>
                <select name="status" id="fname">
                    <option value="0">InActive</option>
                    <option value="1">Active</option>
                </select>
                <input type="submit" value="update">
            </form>

        </div>
    </div>
</div>

