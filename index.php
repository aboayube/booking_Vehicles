<?php $selected = "index";
require_once "include/header.php";

?>

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
    <style>
        canvas {
            height: 710.4px;
            width: 1000px;
            margin: auto;
        }
    </style>
</head>
<div class="container-fluid p-0" style="margin-bottom: 90px;">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="images/sk.jpeg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Rent A Vehicle</h4>
                        <h1 class="display-1 text-white mb-md-4">Best Rental Vehicles In The World</h1>
                        <a href="rental.php" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="images/m4.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Rent A Vehicle</h4>
                        <h1 class="display-1 text-white mb-md-4">Quality Vehicles with Unlimited Miles</h1>
                        <a href="rental.php" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
<div class="home-items-content">

    <?php
    // checks if the user enters the site and if he has previous rentals,
    //displays the veicles in the category that are similar to the vehicle he rented previously
    if (isset($_SESSION['user_id'])) {
        $data = $con->prepare('select DISTINCT  category_id from vec_order where user_id=? and status=2');
        $data->execute(array($_SESSION['user_id']));
        $category_count = $data->rowCount();
        //if the user pay for the renting
        if ($category_count > 0) {
            $categories = $data->fetchAll(); //[26,27.28....]
            $sql = 'and (';
            // loop threw categories 
            foreach ($categories as $category) {

                $sql .= ' vehicles.category_id = ' . $category['category_id'] . ' or ';
            }
            $sql = trim($sql, 'or ');


            $sql .= ')';


    ?>
            <!-- showing the vehicles that are identical to wat the user rented -->
            <div class="title">
                <h1 style="
    font-size: 35px;
    font-family: 'Brush Script MT', cursive;">EXPLORE MORE VEHICLES</h1>
            </div>
            <div class="items-list">
                <!-- get the vehicles filtered and randomly that are similar to the vehicles he rented 
                earlier from different categories  -->
                <?php
                $data = 'SELECT DISTINCT vehicles.*,lincenesrank.code as lince_code
            FROM vehicles,lincenesrank   
         where vehicles.quantity > 0 and vehicles.lincenes_id=lincenesrank.id 
        and vehicles.status=2.';
                $vehiclesss = $con->prepare($data . $sql . ' ORDER BY RAND() LIMIT 8 ');
                $vehiclesss->execute();
                $vehicles = $vehiclesss->fetchAll();
                // loop threw vehicles
                foreach ($vehicles as $vehicle) { ?>

                    <div class="card">
                        <?php if (isset($user)) {
                            if ($user["type"] == 'admin') { ?>
                                <form action="index.php" method="get" class="AdminCard">
                                    <input type="submit" name="update" value="Edit">
                                    <input type="submit" name="Remove" value="Remove">
                                    <input type="hidden" name="vehicleId" value="<?php echo $vehicle['LicenseNum'] ?>"></input>
                                </form>

                        <?php }
                        } ?>
                        <div class="product-info">
                            <div class="product-inner-info">
                                <h4 style="color:white;"><?php echo $vehicle["VType"] . " " . $vehicle["v_name"]; ?></h4>




                                <?php if ($vehicle["quantity"] > 0) {
                                    echo '<div class="price-buy">';
                                } else {
                                    echo '<div style="margin-top:15px">';
                                } ?>
                                <h2 style="color:white; font-size: 30px;"><?php
                                                                            echo $vehicle["price"] . "₪/Day";
                                                                            ?></h2>

                                <form action="user_vehicles.php?id=<?php echo $vehicle['LicenseNum'] ?>" method="post">

                                    <?php if ($vehicle["quantity"] > 0) echo  '<input type="submit" name="AddToCart" value="VIEW DETAILS">';  ?>
                                    <input type="hidden" name="vehicleId" value="<?php echo $vehicle['LicenseNum']; ?>"></input>
                                    <input type="hidden" name="continue" value=<?php
                                                                                if (isset($_GET["continue"])) {
                                                                                    if ($_GET["continue"] === "continue") {
                                                                                        echo 1;
                                                                                    } else {
                                                                                        echo 1;
                                                                                    }
                                                                                } else {
                                                                                    echo 0;
                                                                                } ?>>
                                </form>
                            </div>
                        </div>
                    </div>
                    <img src="images/vehicles/<?php echo $vehicle['image']; ?>" alt="">
            </div>

        <?php } ?>
</div>
<?php
        }


        //
    }
?>
<div class="home-items-content">
    <div class="title">
        <h1 style="
    font-size: 35px;
    font-family: 'Brush Script MT', cursive;">The NEWIST VEHICLES IN OUR COMPANY</h1>
    </div>
    <div class="items-list">
        <!-- get all vehicles that there status is ad -->
        <?php
        $vehiclesss = $con->prepare('SELECT vehicles.*,lincenesrank.code as lince_code
        FROM vehicles,lincenesrank   
     where vehicles.quantity > 0 and vehicles.lincenes_id=lincenesrank.id  
and vehicles.status=3
       ');
        $vehiclesss->execute();
        $vehicles = $vehiclesss->fetchAll();
        foreach ($vehicles as $vehicle) { ?>

            <div class="card">
                <?php if (isset($user)) {
                    if ($user["type"] == 'admin') { ?>
                        <form action="index.php" method="get" class="AdminCard">
                            <input type="submit" name="update" value="Edit">
                            <input type="submit" name="Remove" value="Remove">
                            <input type="hidden" name="vehicleId" value="<?php echo $vehicle['LicenseNum'] ?>"></input>
                        </form>

                <?php }
                } ?>
                <div class="product-info">
                    <div class="product-inner-info">
                        <h4 style="color:white;"><?php echo $vehicle["VType"] . " " . $vehicle["v_name"]; ?></h4>




                        <?php if ($vehicle["quantity"] > 0) {
                            echo '<div class="price-buy">';
                        } else {
                            echo '<div style="margin-top:15px">';
                        } ?>
                        <h2 style="color:white; font-size: 30px;"><?php
                                                                    echo  $vehicle["price"] . "₪/Day";
                                                                    ?></h2>

                        <form action="user_vehicles.php?id=<?php echo $vehicle['LicenseNum'] ?>" method="post">

                            <?php if ($vehicle["quantity"] > 0) echo  '<input type="submit" name="AddToCart" value="VIEW DETAILS">';  ?>
                            <input type="hidden" name="vehicleId" value="<?php echo $vehicle['LicenseNum']; ?>"></input>
                        </form>
                    </div>
                </div>
            </div>
            <img src="images/vehicles/<?php echo $vehicle['image']; ?>" alt="">
    </div>
<?php } ?>

</div>
<?php

if (isset($_SESSION["user_id"])) {
?>
    <div class="m-5">
        <h1 class="text-center">Site Statistics</h1>
        <canvas id="myChart"></canvas>
    </div>
<?php } ?>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<?php require_once "include/footer.php";
$category = [];
$countOrder = [];
$conads = $con->prepare('SELECT DISTINCT categories.name , (SELECT count(*) from vec_order where vec_order.category_id=categories.id ) as countOrder from categories;
');
$conads->execute();
$data = $conads->fetchAll();
foreach ($data as $da) {
    if ($da['countOrder'] > 0) {
        $category[] = $da['name'];
        $countOrder[] = $da['countOrder'];
    }
}


?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = [
        <?php
        foreach ($category as $cat) {
            echo '"' . $cat . '",';
        }

        ?>
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Category with VEHICLES',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [
                <?php
                foreach ($countOrder as $count) {
                    echo $count . ',';
                }

                ?>
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }


        }
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>