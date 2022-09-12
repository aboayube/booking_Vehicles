<?php
//because not the same license rank for this vehicle and when the user click "View details" this page is open 
require_once "include/header.php";
$id = $_GET['id'];
// get all vehicles thats in vehicle table in database and display them by LicenseNum
if ($id && is_numeric($id)) {
    $stmt = $con->prepare("
    select 
    vehicles.*,lincenesrank.code linces_code,categories.name as category_name ,
    lincenesrank.id as lincenesrank_id 
    from 
    categories,lincenesrank   ,vehicles
    where vehicles.category_id=categories.id  
    and  lincenesrank.id=vehicles.lincenes_id 
    and  vehicles.LicenseNum=? 
    and  vehicles.quantity  >0
    limit 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $vehicles = $stmt->fetch();
    } else {
        header("Location:index.php");
        exit;
    }
} ?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet">



    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<div class="container-fluid pt-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-4 text-uppercase mb-5"><?php echo $vehicles["VType"]; ?> <?php echo $vehicles["v_name"]; ?></h1>
        <div class="row align-items-center pb-2">
            <div class="col-lg-6 mb-4">
                <img src="images/vehicles/<?php echo $vehicles['image'] ?>" style="
    border-radius: 5px;
    padding-left: -71px !important; 
    height: 70%;
    width:90%;
    margin-left: -38px;" alt="" width="78%" height="400px">
            </div>
            <div class="col-lg-6 mb-4">
                <h4 class="mb-2"><?php echo $vehicles["price"]; ?> ₪/Day</h4>
                <div class="d-flex mb-3">
                    <h6 class="mr-2">Rating:</h6>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star-half-alt text-primary mr-1"></small>
                        <small>(250)</small>
                    </div>
                </div>
                <p> <?php echo $vehicles["description"]; ?></p>

            </div>
        </div>
        <div class="row mt-n3 mt-lg-0 pb-4">
            <div class="col-md-3 col-6 mb-2">
                <i class="fa fa-car text-primary mr-2"></i>
                <span><?php echo $vehicles["Year"]; ?></span>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <i class="fa fa-cogs text-primary mr-2"></i>
                <span><?php echo $vehicles["transmission"]; ?></span>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <i class="fa fa-person text-primary mr-2"></i>
                <span><?php echo $vehicles["passengers"]; ?></span>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <i class="fa fa-id-badge text-primary mr-2"></i>
                <span><?php echo $vehicles["linces_code"]; ?></span>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <i class="fa fa-road text-primary mr-2"></i>
                <span><?php echo $vehicles["allow_km"]; ?> KM</span>
            </div>

        </div>
    </div>
</div>


<!--this page open when the user that logged in want to rent a vehicle but 
doesnt have the same licenserank then he cant do rental order -->

<marquee behavior="scroll" direction="left" scrollamount="30" style="font-size:50px; 
font-family:fantasy; text-align:center;color:2E2B4A">You Must Have This License Rank</marquee>



<div class="comments" style="margin-top:20px;background:white; margin-left:30px;     width: 95%">
    <h1 style="text-align:center;"> Reviews</h1>
    <hr>
    <?php
     //Displays all comments that belong to the selected vehicle and the admin has approved to display the comments
    $comment = $con->prepare('select
 comments_vehicles.*,users.name as user_name 
 from comments_vehicles,users where
 users.id=comments_vehicles.user_id and
 comments_vehicles.vehicles_id=? and comments_vehicles.status=1
 
');
    $comment->execute(array($_GET['id']));
    $comments = $comment->fetchAll();
    //loop threw comments and display the comments
    foreach ($comments as $comment) {
    ?>
        <div style="display: flex;
justify-content: space-between;">
            <div class="">
                <h1 style="
    font-size: 35px;
    margin-left: 235px;
    font-family: 'Brush Script MT', cursive;"><?php echo $comment['user_name']; ?></h1>
                <p style="
    margin-left: 235px; font-family:fantasy; color:orange;    font-size: 20px;"><?php echo $comment['message']; ?></p>
            </div>
            <div style="margin-right:250px">
                <?php
                for ($i = 0; $i < $comment['ratting']; $i++) { ?>
                    <i class="fa fa-star" style="color:#FCAB34"></i>
                    <?php }
                if ($comment['ratting'] < 5) {
                    $x =  (int)5 - $comment['ratting'];
                    for ($i = 0; $i < 5 - $comment['ratting']; $i++) { ?>
                        <i class="fa fa-star" style="color:#ccc"></i>
                <?php }
                }
                ?>
            </div>
        </div>
</div>
<hr>
<?php }
?>
</div>
</div>

</div>
</div>
<script>
    console.log('yes');

    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
<?php require_once "include/footer.php" ?>
