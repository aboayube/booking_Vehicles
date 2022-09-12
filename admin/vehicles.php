<?php $selected = "shop";
require_once "include/header.php";
//when click the trash icon thats mean to delete this vehicle by LicenseNum "primarykey"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = $con->prepare("DELETE FROM `vehicles` WHERE LicenseNum=? ");

    $sql->execute(array($id));
    $row = $sql->rowCount();

    header("Location:vehicles.php?success=3");
}

?>
<style>
    .addItem {

        background: green;
        color: white;
        padding: 4px;
        margin-top: 8px;
    }
</style>
<div class="header" style="
    display: flex;
    margin-top: 29px;
    justify-content: space-around;
    padding-bottom: 50px;
    ">
    <h1 class="">VEHICLES MANAGMENT</h1>
<!-- this icon has access to add vehicle page -->
    <a href="addvehicles.php"><img src="../images/Plus.png" style="margin-top:7px"></a>
</div>
<!--here we have alert for  delete vehicle by LicenseNum  -->
<?php if (isset($_GET["success"]) && $_GET['success'] == 3) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">DELETED SUCCESSFULLY</p>'; ?>
        </div>
    </div>
    <br><br><br><br>
<?php } ?>

<!-- if have an error sending error alert  -->
<?php if (isset($_GET["error"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">' . $_GET["error"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>

<div class="home-items-content" style="padding:20px">
    <div class="items-list">
        <?php
//get all vehicles from vehicle table from database by LicenseNum And order by desc
        $stmt = $con->prepare("select  vehicles.*, lincenesrank.code linces_code from vehicles,lincenesrank 
        where   lincenesrank.id=vehicles.lincenes_id  order by vehicles.LicenseNum desc");

        $stmt->execute(array());

        $vehicless = $stmt->fetchAll();

        // here shows all vehicles  from database , goes on a loop and get who edit/delete this 
        foreach ($vehicless as $vehc) {
        ?>
            <div class="card">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="AdminCard">
                    <input type="hidden" name="id" value="<?php echo $vehc['LicenseNum'] ?>">
                    <input type="submit" name="Remove" value="Remove" onclick="return confirm('Are you sure To Delete This Vehicle?')">
                </form>
                <div class="AdminCard" style="
    margin-right: 74px;top:9px">

                    <a href="editvehicles.php?id=<?php echo $vehc['LicenseNum'] ?>" value="" style="

    border: none;
    color: #fff;
    padding: 5px;
    border-radius: 5px;
    background: blue;">EDIT</a>

                </div>

<!-- getting all the columns from database  -->
                <div class="product-info">
                    <div class="product-inner-info">
                        <h4><?php echo   $vehc["VType"] ."  " . $vehc["v_name"]; ?></h4>
                        <div class="passengers v-icon">
                            <img src="../images/passengers.png" alt="passengers" name="passengers">
                            <p><?php echo $vehc["passengers"]; ?></p>
                        </div>

                        <div class="transmission v-icon">
                            <img src="../images/transmission.png" alt="transmission" name="transmission">
                            <p><?php echo  $vehc["transmission"]; ?></p>
                        </div>

                        <div class="vyear v-icon">
                            <img src="../images/v-year.png" alt="vyear" name="vyear">
                            <p><?php echo  $vehc["Year"]; ?></p>
                        </div>

                        <div class="license v-icon">
                            <img src="../images/rlimage.png" alt="vyear" name="vyear">
                            <p><?php echo  $vehc["linces_code"]; ?></p>
                        </div>
<!-- if quantity > 0 , showing the price else it print OUT OF STOCK -->
                        <?php if ($vehc["quantity"] > 0) {
                            echo '<div class="price-buy">';
                        } else {
                            echo '<div style="margin-top:15px">';
                        } ?>
                        <h2><?php if ($vehc["quantity"] > 0) {
                                echo "₪" . $vehc["price"];
                            } else {
                                echo "OUT OF STOCK";
                            } ?></h2>
                    </div>
                </div>
            </div>
            <img src="../images/vehicles/<?php echo $vehc['image']; ?>" alt="">
    </div>
<?php } ?>
</div>
</div>
