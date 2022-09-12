<?php
$selected = 'dashborad';
include('include/header.php');
// we get from database
$sql = $con->prepare("select categories.*, users.name as user_name from categories,users  where categories.user_id=users.id   order by categories.id DESC");
$sql->execute();
$categories = $sql->fetchAll();

?>


<div class="data">
    <div class="items">
        <div class="header">
            <h1 class="">CATEGORIES MANAGMENT</h1> 
            <!-- this icon has access to add category -->
            <a href="addCategory.php"><img src="../images/Plus.png"></a>
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
        <table id="customers">
            <tr style="color:red">
                <th style="text-align:center;">ID</th>
                <th style="text-align:center;">Category Name</th>
                <th style="text-align:center;">Manager/Worker</th>
                <th style="text-align:center; width:50px">Action</th>
            </tr>
            <!-- here shows all categories from database , goes on a loop and get who edit/delete this -->
            <?php
            foreach ($categories as $category) {
            ?>
                <tr >
                    <td style="text-align:center;"><?php echo $category['id'] ?></td>
                    <td style="text-align:center;"><?php echo $category['name'] ?></td>
                    <td style="text-align:center;"><?php echo $category['user_name'] ?></td>
                    <!-- if he is a admin he can update or delete the categories -->
                    <?php
                    if ($category['user_id'] == $_SESSION['user_id'] || $_SESSION['role'] == 'admin') { ?>
                        <td style="text-align:center;">
                            <a class="text-center" href="editCategory.php?id=<?php echo $category['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="text-center delete" href="deleteCategory.php?id=<?php echo $category['id']  ?>" onclick="return confirm('Are you sure you want to delete this category')"><i  class="fa-solid fa-trash-can delete"></i></a>

                        </td>
                    <?php } else { ?>
<!-- if he was a worker he can't do anything -->
                        <td style="text-align:center;">no there action</td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
