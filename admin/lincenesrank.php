<!--  we get lincenesrank from database -->

<?php
$selected = 'dashborad';
include('include/header.php');
$sql = $con->prepare("select lincenesrank.*, users.name as user_name from lincenesrank,users  where lincenesrank.user_id=users.id   order by lincenesrank.id DESC");
$sql->execute();
$licenses = $sql->fetchAll();
?>
<div class="data">
    <div class="items">
        <div class="header" style="margin-left: -85px;">
            <h1 class="">LICENSES RANK MANAGMENT  </h1>
            <a href="addlincenesranks.php"><img src="../images/Plus.png"></a>
        </div>
        <!--here we have alert for every update we do  -->

        <?php
                if (isset($_GET['success'])) {
                    if ($_GET['success'] == 1) {
                ?>
                <div class="AlertMessage">
                    <div class="alert alertsuccess">
                    Added Successfully
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
        <div class="text-center">
            <table id="customers">
                <tr>
                    <th style="text-align:center;">ID</th>
                    <th style="text-align:center;">Rank</th>
                    <th style="text-align:center;">Details</th>
                    <th style="text-align:center;">Manager/Worker</th>
                    <th style="text-align:center; width:50px">Action</th>
                </tr>
                 <!-- here shows all licenses  from database , goes on a loop and get who edit/delete this -->
                <?php
                foreach ($licenses as $license) {
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $license['id'] ?></td>
                        <td style="text-align:center;"><?php echo $license['code'] ?></td>
                        <td style="text-align:center;"><?php echo $license['details'] ?></td>
                        <td style="text-align:center;"><?php echo $license['user_name'] ?></td>
                        <!-- if he is a admin he can update or delete the licenserank -->
                        <?php
                        if ($license['user_id'] == $_SESSION['user_id'] || $_SESSION['role'] == 'admin') { ?>
                            <td>
                                <a class="text-center" href="editlincenesranks.php?id=<?php echo $license['id']  ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="text-center" href="deletelincenesranks.php?id=<?php echo $license['id']  ?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa-solid fa-trash-can delete"></i></a>
                            </td>
                        <?php } else { ?>

                            <td>No Actions</td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
