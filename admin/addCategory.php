<!-- In that page we use to add new categories -->
<?php
$selected = 'dashboradAdd';
include('include/header.php');
$name = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    if (empty($name)) {
        $errors[] = 'You Should Enter Category Name';
    }
    if (empty($errors)) {
        // add new category to databse and send Appropriate Message
        $sql = $con->prepare("insert into categories  ( `name`, `user_id`) values (?,?)");
        $sql->execute(array($name, $_SESSION['user_id']));
        header('location:categories.php?success=1');
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
} ?>
<div class="data">
    <div class="items">
        <div class="header">
            <h1>ADD CATEGORY</h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" style="margin-right:150px">
                <label for="fname"> CATEGORY NAME</label>
                <input type="text" id="name" name="name" placeholder="CATEGORY NAME.." autofocus>
                <input type="submit" value="add" class="btn-post">
            </form>
        </div>
    </div>
</div>

