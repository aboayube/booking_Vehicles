<!-- In that page we use to add new worker and the days he worked  -->

<?php
$selected = 'dashboradAdd';
include('include/header.php');
$name = '';
$username = '';
$email = '';
$phone = '';
$days = '';
$date = '';
$status = '';
$id_number = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $id_number = $_POST['id_number'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $userid = $_SESSION['user_id'] ? $_SESSION['user_id'] : $_POST['user_id'];
    $days = $_POST['days'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    // check if the input empty
    if (empty($name)) {
        $errors[] = 'you should enter name';
    }
    if (empty($id_number)) {
        $errors[] = 'you should enter id_number';
    }

    if (empty($username)) {
        $errors[] = 'you should enter username';
    }

    if (empty($email)) {
        $errors[] = 'you should enter email';
    }

    if (empty($phone)) {
        $errors[] = 'you should enter phone';
    }
    if (empty($password)) {
        $errors[] = 'you should enter password';
    }

    if (empty($days)) {
        $errors[] = 'you should enter days';
    }
    if (empty($date)) {
        $errors[] = 'you should enter date';
    }
    // sha1= Secured password
    if (empty($errors)) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        //insert into users table the new worker and put the role = worker
        $sql1 = $con->prepare("insert into users (name,username,image,password,email,phone,status,role) 
        values (?,?,'default.jpg',?,?,?,'1','worker')");
        $data =   $sql1->execute(array($name, $username, sha1($password), $email, $phone));
        if ($data) {
         //insert into workers table the new worker with working days
            $id = $con->lastInsertId();
            $sql = $con->prepare("insert into workers 
 ( `user_Id`,`days`,`date`,`status`,`id_number`) 
 values (?,?,?,?,?)");
            $sql->execute(array(
                $id,
                $days,
                $date,
                $status,
                $id_number
            ));
            header('location:worker.php?success=1');
        }
    }
}
if ($errors) {
    foreach ($errors as $error) {
?>
<!--  if there is a empty input , we got a error message -->
        <div class="AlertMessage">
            <div class="alert alertSuccess">
                <?php echo  '<p">' . $error . '</p>'; ?>
            </div>
        </div><br><br>
<?php }
} ?>
<div class="data">
    <div class="items">
        <div class="header">
            <h1>ADD WORKER</h1>
        </div>
        <div class="text-center">
            <div class="text-center">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <label for="fname"> Worker Id</label>

                    <input type="number" id="id_number" name="id_number" value="<?php echo $id_number ?>">

                    <label for="fname"> Worker Name</label>

                    <input type="text" id="name" name="name" value="<?php echo $name ?>">

                    <label for="fname"> Username</label>

                    <input type="text" id="username" name="username" value="<?php echo $username ?>">

                    <label for="fname"> Email</label>

                    <input type="text" id="email" name="email" value="<?php echo $email ?>">

                    <label for="fname"> Password</label>

                    <input type="password" id="password" name="password">

                    <label for="fname"> Phone</label>

                    <input type="text" id="phone" name="phone" value="<?php echo $phone ?>">


                    <label for="fname"> Days Of Work</label>

                    <input type="text" id="days" name="days" value="<?php echo $days ?>">

                    <label for="fname"> Dates Of Work</label>
                    <input type="text" id="type" name="date" value="<?php echo $date ?>">
                    <!-- if status = 1 , he can access the site , if 2 he cannot -->
                    <label for="fname"> Status</label>
                    <select name="status">
                        <option value="1" <?php if ($status == 1) {
                                                echo 'selected';
                                            } ?>>Active</option>
                        <option value="2" <?php if ($status == 2) {
                                                echo 'selected';
                                            } ?>>InActive</option>
                    </select>
                    <input type="submit" value="Add Worker" class="btn-post">
                </form>

            </div>
        </div>
    </div>
</div>

