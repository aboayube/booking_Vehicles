<!-- get the notification from database by id and user id  -->

<?php
$selected = 'dashborad';
include('include/header.php');

$sql = $con->prepare("select notification.*,users.name as username from notification,users
 where
 users.id=notification.to_id 
 
 order by id DESC");
 //here we have alert for every update we do  

$sql->execute();
$notifications = $sql->fetchAll();
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
            <h1 style="
    margin-left: 12px;">NOTIFIATIONS</h1>
            <a href="addNotifcation.php"><img src="../images/Plus.png"></a>
        </div>
        <table id="customers">
            <tr style="color:red">
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">FROM</th>
                <th style="text-align:center;">TO</th>
                <th style="text-align:center;">MESSAGE</th>
                <th style="text-align:center; width:50px">ACTION</th>
            </tr>
            <!-- here shows all notifications  from database , goes on a loop and get who edit/delete this -->
            <?php
            foreach ($notifications as $notification) {
            ?>
                <tr>
                    <td style="text-align:center;"><?php echo $notification['id'] ?></td>
                    <td style="text-align:center;"><?php echo $notification['from_user'] ?></td>
                    <td style="text-align:center;"><?php echo $notification['username'] ?></td>
                    <td style="text-align:center;"><?php echo $notification['message'] ?></td>
                    <!-- if he is a admin he can update or delete the notification -->
                    <?php
                    if ($_SESSION['role'] == 'admin' || $notification['from_user'] == $_SESSION['name']) { ?>
                        <td>
                            <a href="editnotification.php?id=<?php echo $notification['id'] ?>"><i  class="fa-solid fa-pen-to-square"></i></a>
                            <a href="deletenotification.php?id=<?php echo $notification['id']  ?>" onclick="return confirm('Are you sure you want to delete this notification')"><i class="fa-solid fa-trash-can delete"></i></a>
                        </td>
                    <?php } else { ?>

                        <td>No Actions</td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
