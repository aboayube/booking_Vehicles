<!-- get the lincenesrank from database  by id -->

<?php
$selected = 'dashboradAdd';
include("include/header.php");
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    //get all licesneRank From licenserank table
    $stmt = $con->prepare("select * from    lincenesrank where id=? limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $lincenesrank = $stmt->fetch();
    } else {
        header("Location:lincenesrank.php");
        exit;
    }
}
$code = $lincenesrank['code'];
$details = $lincenesrank['details'];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $details = $_POST['details'];
    if (empty($code)) {
        $errors[] = 'You Should Enter Rank';
    }
    if (empty($details)) {
        $errors[] = 'You Should Enter Details';
    }
    // here we can update the rank and details from lincenesrank  by id 

    if (empty($errors)) {
        $sql = $con->prepare("update  lincenesrank set code=?, details=? where id=?");
        $sql->execute(array($code, $details, $id));
        header('location:lincenesrank.php?success=2');
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
            <h1>EDIT LICENSE RANK</h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="fname"> RANK</label>
                <input type="text" id="code" name="code" value="<?php echo $code ?>">
                <label for="fname"> DETAILS</label>
                <textarea name="details"><?php echo $details ?></textarea>
                <input type="submit" value="update" class="btn-post">
            </form>

        </div>

    </div>
</div>


