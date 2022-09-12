<?php $selected = "shop";
require_once "include/header.php";
if(!isset($_SESSION["user_id"])){
    header("location:index.php");

}
//check if the role != user then open index.php
if (isset($_SESSION["user_id"]) && $_SESSION["role"] != 'users') {
    header("location:index.php");
}
//check if the customer clicked the trash icon 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
//when the customer rent and and status !=2 the customer can delete this order
    $sql = $con->prepare("DELETE FROM `vec_order` WHERE id=? and user_id=?");

    $sql->execute(array($id, $_SESSION['user_id']));
    $row = $sql->rowCount();
}
?>
<!-- if there is an error , displays error alert -->
<?php if (isset($_GET["error"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">' . $_GET["error"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>
<!-- if there is no errors, display success alert -->
<?php if (isset($_GET["success"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertsuccess">
            <?php echo  '<p">' . $_GET["success"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>
<div class="content-wrapper">
</div>
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap"
      rel="stylesheet"
    />
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
      href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet"
    />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>
  <br>
  <div class="title">
                <h1 style="
    font-size: 70px;
    font-family: 'Brush Script MT', cursive; text-align:center">ORDERS</h1>
            </div>
<div class="home-items-content">
    <div class="items-list">
        <?php
      //get the rentals in the table that belong to the logged in user
        $stmt = $con->prepare("select vec_order.id as uservehiclesid,vec_order.status as user_vehicles_status, vec_order.price as endprice,vec_order.*,vehicles.*, lincenesrank.code linces_code from vehicles,lincenesrank,vec_order 
         where vehicles.LicenseNum  = vec_order.vehicles_id and lincenesrank.id=vehicles.lincenes_id 
         and vec_order.user_id =? order by vec_order.id desc");
        $stmt->execute(array($_SESSION['user_id']));
        $vehiclees = $stmt->fetchAll();
           //loop threw $vehicles
        foreach ($vehiclees as $vehiclee) {
        ?>
            <div class="card">
                <?php
// if status !=2 thats mean not Approved then the customer can delete the Rental order
                if ($vehiclee['user_vehicles_status'] != 2) { ?>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="AdminCard">
                        <input type="hidden" name="id" value="<?php echo $vehiclee['uservehiclesid'] ?>">
                        <input type="submit" name="Remove" value="Remove" onclick="return confirm('Are you sure you want to delete Your Rental?')">
                    </form>
                <?php } ?>
                <div class="AdminCard" style="
    margin-right: 74px;
    margin-top:3px
    ">
<!-- if status ==1 the customer have to pay about his rental to rent the vehicle -->
                    <?php if ($vehiclee['user_vehicles_status'] == 1) { ?>
                        <a href="proudpay.php?id=<?php echo $vehiclee['uservehiclesid'] ?>" value="pay" style="background: blue;border: none;color: #fff;padding: 5px;border-radius: 5px;background: orange;">PAY</a>
<!-- = if status ==0  thats mean the admin/worker  The rental has not been approved yet -->
                    <?php } else if ($vehiclee['user_vehicles_status'] == 0) { ?>
                        <a href="" value="pay" style="border: none;color: #fff;padding: 5px;border-radius: 5px;background: orange;">Waiting For Approval</a>
                    <?php } ?>
                </div>
                <div class="product-info">
                    <div class="product-inner-info">
                        <h4 style="color:white"><?php echo $vehiclee["VType"] . " " . $vehiclee["v_name"]; ?></h4>    
                        <div class="price-buy">
                        
                            <!-- if status = 1 thats mean the customer can View The details of the rental period -->
                            <form action="show_user_vehicles.php?id=<?php echo $vehiclee['LicenseNum'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>" method="post">
                                <input type="hidden" name="ProductId" value="<?php echo $vehiclee['LicenseNum']; ?>">
                                <input type="submit" name="AddToCart" value="VIEW DETAILS">
                            </form>
                      
                    </div>
                </div>
            </div>
            <img src="images/vehicles/<?php echo $vehiclee['image']; ?>" alt="">
    </div>
<?php } ?>
</div>
</div>
<?php require_once "include/footer.php" ?>
