<!-- In that page we use to send a notifaction to the customer by admin  side  -->

<?php
$selected = 'dashboradAdd';
include('include/header.php');
$message = '';
$to_id = '';
$title = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to_id = $_POST['to_id'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    if (empty($title)) {
        $errors[] = 'You Should enter A Title';
    }
    if (empty($to_id)) {
        $errors[] = 'You Should Enter To..';
    }
    if (empty($message)) {
        $errors[] = 'You Should Enter A Message';
    }
    if (empty($errors)) {
        // add new notification to databse and send Appropriate Message
        $sql = $con->prepare("insert into notification  ( `from_user`,`to_id`, `message`,`title`) values (?,?,?,?)");
        $sql->execute(array($_SESSION['name'], $to_id, $message, $title));
        header('location:notifications.php?success=1');
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
            <h1>ADD NOTIFICATION</h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="fname"> TITLE</label>
                <input type="text" id="title" name="title" value="<?php echo $title ?>">
                <label for="fname"> MESSAGE</label>
                <textarea name="message"><?php echo $message ?></textarea>
                 <!-- For whom we need to send the notifaction -->
                <label for="fname"> TO..</label>
                <select name="to_id">
                    <?php
                    //get from users table to get the users that there type is users
                    if (isset($_GET['user_id'])) {
                        $stmt = $con->prepare('select * from users where role="users" and id=' . $_GET['user_id']);
                    } else {
                        $stmt = $con->prepare('select * from users where role="users"');
                    }
                    $stmt->execute();
                    $users = $stmt->fetchAll();
                    foreach ($users as $user) {

                    ?>
                        <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
                    <?php }
                    ?>
                </select>
                <input type="submit" value="SEND" class="btn-post">
            </form>
        </div>
    </div>
</div>
