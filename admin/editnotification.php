<!-- get the notification from database  by id -->

<?php
$selected = 'dashboradAdd';
include("include/header.php");
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("select * from    notification where id=? limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $notification = $stmt->fetch();
    } else {
        header("Location:notifications.php");
        exit;
    }
}
$title = $notification['title'];
$message = $notification['message'];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $message = $_POST['message'];
    if (empty($title)) {
        $errors[] = 'You Should Enter A Title';
    }
    if (empty($message)) {
        $errors[] = 'You Should Enter A Message';
    }
    // here we can update the title and message from notification  by id 
    if (empty($errors)) {
        $sql = $con->prepare("update  notification set title=?, message=? where id=?");
        $sql->execute(array($title, $message, $id));
        header('location:notifications.php?success=2');
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
            <h1>EDIT NOTIFIATION</h1>
        </div>
        <div class="text-center">
            <div class="text-center">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <label for="fname"> TITLE</label>
                    <input type="text" id="title" name="title" value="<?php echo $title ?>">
                    <label for="fname"> MESSAGE</label>
                    <textarea name="message"><?php echo $message ?></textarea>
                    <input type="submit" value="EDIT" class="btn-post">
                </form>

            </div>
        </div>
    </div>

</div>
