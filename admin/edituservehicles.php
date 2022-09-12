<!-- get the vec_order from database  by id -->
<?php
$selected = 'dashboradAdd';
include("include/header.php");
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("select * from    vec_order where id=? limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $user = $stmt->fetch();
    } else {
        header("Location:user_vehicles.php");
        exit;
    }
}
$status = '';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $sql = $con->prepare("update vec_order  set status=? where id=?");
    $sql->execute(array($status, $id));

    //here we send a notifcation to the customer that we accept his order
    $data = $con->prepare('insert into notification
     (`title`,`message`,`to_id`,`from_user`) values (?,?,?,?)');
    $data->execute(array('Order Status', 'accept your order', $user['user_id'], $_SESSION['user_id']));
    header('location:user_vehicles.php?success=2');
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
} ?>
<div class="data">
    <div class="items">
        <div class="header">
            <h1>APPROVAL </h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="fname"> status</label>
                <select name="status">
                 <!-- if the status 1 as he active , if 0 he is inactive -->

                    <option value="1" <?php if ($user['status'] == '1') {
                                            echo 'selected';
                                        } ?>>Approve</option>
                    <option value="0" <?php if ($user['status'] == '0') {
                                            echo 'selected';
                                        } ?>>No Approve</option>
                </select>

                <input type="submit" value="add" class="btn-post">
            </form>

        </div>
    </div>
</div>
