<!-- get the workers from database  by id -->

<?php
$selected = 'dashboradAdd';
include('include/header.php');


$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['user_id'];

if ($id && is_numeric($id)) {

    $stmt = $con->prepare("select * from    workers where user_id=? or id=? limit 1");
    $stmt->execute(array($id, $id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $vehicle = $stmt->fetch();
    } else {
        header("Location:users.php");
        exit;
    }
}
$days = $vehicle['days'];
$date = $vehicle['date'];
$status = $vehicle['status'];

$errors = [];
    // check if the input empty

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $days = $_POST['days'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    if (empty($days)) {
        $errors[] = 'You Should Enter Days';
    }
    if (empty($date)) {
        $errors[] = 'You Should enter Dates';
    }
    if (empty($status)) {
        $errors[] = 'You Should Enter Status';
    }

// if he was the admin role he can editing worker dates in workers table
    if (empty($errors)) {
        if ($_SESSION['role'] == 'admin') {
            $where = 'id=?';
        } else {
            $where = 'user_id=?';
        }
        $sql = $con->prepare("update  workers set
        days=?,date =?,status=?  where " . $where);

        $sql->execute(array(
            $days, $date, $status, $id
        ));
        // if he was the admin/worker role he can editing worker dates in users and worker table

        $sql2 = $con->prepare("update users set status=? where id=?");
        $sql2->execute(array($status, $_GET['user_id']));
        if ($_SESSION['role'] == 'admin') {
            header('location:worker.php?success=1');
        } else {
            header('location:editworkerDate.php?success=1');
        }
    }
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
            <h1>Edit Shift Constraints</h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <label for="fname"> Days Of Work</label>

                <input type="text" id="days" name="days" value="<?php echo $days ?>">

                <label for="fname"> Dates Of Work</label>
                <input type="text" id="type" name="date" value="<?php echo $date ?>">

                <label for="fname"> Status</label>
                <select name="status">
                <!-- if the status 1 as he active , if 0 he is inactive -->

                    <option value="1" <?php if ($status == 1) {
                                            echo 'selected';
                                        } ?>>Active</option>
                    <option value="2" <?php if ($status == 2) {
                                            echo 'selected';
                                        } ?>>InActive</option>
                </select>





                <input type="submit" value="add" class="btn-post">
            </form>

        </div>
    </div>
</div>
