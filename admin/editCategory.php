<!-- get the category from database  by id -->
<?php
$selected = 'dashboradAdd';
include("include/header.php");
$id = $_GET['id'];
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("select * from    categories where id=? limit 1");
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
    $name = $_POST['name'];
    if (empty($name)) {
        $errors[] = 'You Should Enter Category Name';
    }
// here we update the category name by id
    if (empty($errors)) {
        $sql = $con->prepare("update categories  set name=? where id=?");
        $sql->execute(array($name, $id));
        header('location:categories.php?success=2');
    }
}
?>
<?php
//loop threw errors
if ($errors) {
    foreach ($errors as $error) {
?>
        <div class="AlertMessage">
            <div class="alert alertError">
                <!-- print error alert -->
                <?php echo  '<p">' . $error . '</p>'; ?>
            </div>
        </div><br><br>
<?php }
} ?><div class="data">
    <div class="items">
        <div class="header">
            <h1>UPDATE CATEGORY</h1>
        </div>
        <div class="text-center">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="fname"> CATEGORY NAME</label>
                <input type="text" id="name" value="<?php echo $categoies['name'] ?>" name="name" placeholder="Your name..">
                <input type="submit" value="UPDATE CATEGORY" class="btn-post">
            </form>



    </div>

</div>
