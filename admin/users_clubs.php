<!-- get the clubs from database by id and user id by desc-->
<?php
$selected = 'dashborad';
include('include/header.php');

$sql = $con->prepare("select clubs.*, users.name as user_name,users.id as user_id,users.image as user_image
from clubs,users 
 where 
  clubs.user_id = users.id
 
 order by clubs.id DESC");
$sql->execute();
$clubs = $sql->fetchAll();

?>
<div class="data">
    <div class="items">
        <div class="header">
            <h1 class="">VIP CUSTOMERS</h1>
            <a class="addItem" href="addCategory.php"><i class="fas fa-add"></i></a>
        </div>
        <table id="customers" style="
        margin-bottom: 155px;">
            <tr>
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Customer Name</th>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">VIP</th>
                <th style="text-align:center;">ACTION</th>
            </tr>
              <!-- here shows all vip users in clubs table  from database , goes on a loop and get who delete this -->
            <?php
            foreach ($clubs as $club) {
            ?>
                <tr>
                    <td style="text-align:center;"><?php echo $club['id'] ?></td>
                    <td style="text-align:center;"><?php echo $club['user_name'] ?></td>
                    <td style="text-align:center;"><img src="../images/users/<?php echo $club['user_image'] ?>" width="100px" height="100px"></td>
                    <td style="text-align:center;">VIP CUSTOMER </td>
                      <!-- here shows all customers orders  from database , goes on a loop and get who edit/delete this -->
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <td>
                            <a class="text-center delete" href="deleteclub.php?id=<?php echo $club['user_id']  ?>" onclick="return confirm('Are you sure you want to delete this Vip Customer?')"><i class="fa-solid fa-trash-can delete"></i></a>
                        </td>
                    <?php } else { ?>
                       <!-- if he was a worker he can't do anything -->
                        <td>No Actions</td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
