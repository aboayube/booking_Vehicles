<!-- In that page we use to add new lincenes rank -->

<?php
$selected = 'dashboradAdd';
include('include/header.php');
$code = '';
$details = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $details = $_POST['details'];
    if (empty($code)) {
        $errors[] = 'You should enter Rank';
    }
    if (empty($details)) {
        $errors[] = 'You should enter Details';
    }
    if (empty($errors)) {
        // add new lincenesrank to databse and send Appropriate Message
        $sql = $con->prepare("insert into lincenesrank  ( `code`,`details`, `user_id`) values (?,?,?)");
        $sql->execute(array($code, $details, $_SESSION['user_id']));
        header('location:lincenesrank.php?success=1');
    }
}
// if there is a empty input , we got a error message 

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
            <h1>ADD LICENSE RANK</h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="fname"> RANK</label>
                <input type="text" id="code" name="code" value="<?php echo $code ?>">
                <label for="fname"> DETAILS</label>
                <textarea name="details"><?php echo $details ?></textarea>
                <input type="submit" value="add" class="btn-post">
            </form>

        </div>
    </div>

</div>
