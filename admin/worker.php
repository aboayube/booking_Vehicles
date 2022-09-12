<!-- get all worker from users table , that the role = worker order by desc    -->
<?php
$selected = 'dashborad';
include('include/header.php');
if ($_SESSION['role'] != 'admin') {
    header("location:vehicles.php");
}
$sql = $con->prepare("select users.*,users.id as user_id,workers.* from users,workers where users.id=workers.user_id order by users.id DESC");
$sql->execute();
$users = $sql->fetchAll();
?>
<div class="data">
    <div class="items">
        <div class="header">
            <h1 class="">WORKERS MANAGMENT</h1>
            <!-- this icon has access to add worker -->
            <a href="addWorkerDate.php"><img src="../images/Plus.png"></a>
        </div>
        <!--here we have alert for every update we do  -->
        <?php
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 1) {
        ?>
                <div class="AlertMessage">
                    <div class="alert alertsuccess">
                    Worker Added Successfully
                    </div>
                </div><br><br><br><br><br><br>
            <?php }
            if ($_GET['success'] == 2) {
            ?>
                <div class="AlertMessage">
                    <div class="alert alertsuccess">
                     Updated Successfully
                    </div>
                </div><br><br><br><br><br><br>
            <?php }
            if ($_GET['success'] == 3) {
            ?>
                <div class="AlertMessage">
                    <div class="alert alertError">
                        Deleted Successfully
                    </div>
                </div><br><br><br><br><br><br>
        <?php }
        } ?>
        <table  id="customers">
            <tr>
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Name</th>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">Email</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">Phone</th>
                <th style="text-align:center;">Days Of Work</th>
                <th style="text-align:center;">Dates Of Work</th>
                <th style="text-align:center; width:50px">Action</th>
            </tr>
                        <!-- here shows all users in users table that the role = worker , from database , goes on a loop and get who edit/delete this -->
            <?php
            foreach ($users as $user) {
            ?>
                <tr>
                    <td style="text-align:center;"><?php echo $user['user_id'] ?></td>
                    <td style="text-align:center;"><?php echo $user['name'] ?></td>
                    <td style="text-align:center;"><img src="../images/users/<?php echo $user['image'] ?>" width="100px" height="100px"></td>
                    <td style="text-align:center;"><?php echo $user['email'] ?></td>
                    <!-- if the status=1 thats mean the worker is active and can access the site, 
                    if not thats mean InActive and can't access the site -->
                    <td style="text-align:center;"><?php echo $user['status'] == 1 ? 'active' : 'InActive' ?></td>
                    <td style="text-align:center;"><?php echo $user['phone'] ?></td>
                    <td style="text-align:center;"><?php echo $user['days'] ?></td>
                    <td style="text-align:center;"><?php echo $user['date'] ?></td>
                   <!-- if he is a admin he can update worker dates or delete the worker -->
                    <?php
                    if ($_SESSION['role'] == 'admin') { ?>
                        <td>
                            <a class="text-center" style="    display: inherit;
    color: red;
    padding-left: 21px;" href="editworkerDate.php?id=<?php echo $user['id']  ?>&user_id=<?php echo $user['user_id'] ?>"><i class="fa-solid fa-pen-to-square" style="color:green"></i></a>
                            <a class="text-center delete" href="deleteworker.php?id=<?php echo $user['user_id']  ?>" onclick="return confirm('Are you sure you want to delete this Worker')"><i class="fa-solid fa-trash-can delete"></i></a>
                    <?php } else { ?>
                         <!-- if he is a worker he can't do any thing -->
                        <td>No Actions</td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

