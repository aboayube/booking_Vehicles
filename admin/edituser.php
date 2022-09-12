<!-- get the users from database  by id -->

<?php
$selected = 'dashborad';
include("include/header.php");
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("select * from    users where id=? limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $user = $stmt->fetch();
    } else {
        header("Location:users.php");
        exit;
    }
}
$status = '';
$errors = [];
// here we update if the account of user still active or not
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $sql = $con->prepare("update users  set status=? where id=?");
    $sql->execute(array($status, $id));
    header('location:users.php?success=2');
}

if ($errors) {
    foreach ($errors as $error) {
?>
        <div class="AlertMessage">
            <div class="alert alertError">
                <?php echo  '<p">' . $error . '</p>'; ?>
            </div>
        </div><br><br>
<?php }
} ?>
<div class="data">
    <div class="items">
        <div class="header">
            <h1>Edit Customers</h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="fname"> Status</label>
                <select name="status" style="width:50%">
                <!-- if the status 1 as he active , if 0 he is inactive -->
                    <option value="1" <?php if ($user['status'] == '1') {
                                            echo 'selected';
                                        } ?>>Active</option>
                    <option value="0" <?php if ($user['status'] == '0') {
                                            echo 'selected';
                                        } ?>>InActive</option>
                </select>
                <input type="submit" value="Update Customer">
            </form>

        </div>
    </div>
</div>


