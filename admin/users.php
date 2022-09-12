<?php
$selected = 'dashborad';
include('include/header.php');
// get all users that the role = users order by desc 
$sql = $con->prepare("select * from users where role='users'  order by id DESC");
$sql->execute();
$users = $sql->fetchAll();
// sending a message if admin do edit
if (isset($_GET['success'])) {

    if ($_GET['success'] == 2) {
?>
        <div class="AlertMessage">
            <div class="alert alertError">
                Updated Successfully
            </div>
        </div><br><br><br><br><br><br>
<?php }
} ?>
<div class="data">
    <div class="items">
        <div class="header">
            <h1 class="">CUSTOMERS MANAGMENT</h1>
        </div>
        <table id="customers" style="
        margin-bottom: 155px;">
            <tr>
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Customer Name</th>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">Username</th>
                <th style="text-align:center;">Email</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">License Rank</th>
                <th style="text-align:center;">Address</th>
                <th style="text-align:center;">Phone</th>
                <th style="text-align:center;">DateOfBirthday</th>
                <th style="text-align:center; width:50px">Action</th>
            </tr>
            <!-- here shows all users in users table  from database , goes on a loop and get who edit/delete this -->
            <?php

            foreach ($users as $user) {

            ?>
                <tr>
                    <td style="text-align:center;"><?php echo $user['id'] ?></td>
                    <td style="text-align:center;"><?php echo $user['name'] ?></td>
                    <td style="text-align:center;"><img src="../images/users/<?php echo $user['image'] ?>" width="100px" height="100px"></td>
                    <td style="text-align:center;"><?php echo $user['username'] ?></td>
                    <td style="text-align:center;"><?php echo $user['email'] ?></td>
                    <td style="text-align:center;"><?php echo $user['status'] == 1 ? 'active' : 'InActive' ?></td>
                    <td style="text-align:center;"><?php echo $user['linces'] ?></td>
                    <td style="text-align:center;"><?php echo $user['address'] ?></td>
                    <td style="text-align:center;"><?php echo $user['phone'] ?></td>
                    <td style="text-align:center;"><?php echo $user['dateofbirthday'] ?></td>
                     <!-- if he is a admin he can  edit/delete the user -->
                    <?php
                    if ($_SESSION['role'] == 'admin') { ?>
                        <td>
                            <a class="text-center" href="edituser.php?id=<?php echo $user['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="text-center delete" href="deleteuser.php?id=<?php echo $user['id']  ?>" onclick="return confirm('Are you sure you want to delete this Customer')"><i class="fa-solid fa-trash-can delete"></i></a>
                        </td>
                    <?php } else { ?>
                   <!-- if he is a worker he can't do any thing -->
                        <td>No Actions</td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
