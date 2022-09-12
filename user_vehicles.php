<!-- get all vehicles thats in vehicles table where vec.order.userId = session user_id  -->
<?php
ob_start();
require_once "include/header.php";
$id = $_GET['id'];
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
    if (!isset($_SESSION['user_id'])) {
        header("Location:user_notlogin_vehicles.php?id=" . $_GET['id']);
        exit;
    }
    if (!in_array($vehicles['lincenesrank_id'], explode(',', $_SESSION['linces']))) {
        header("Location:user_notlicense_vehicles.php?id=" . $_GET['id']);
        exit;
    }
}
//checking if all inputs not empty and if not empty insert all to vec_order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['AddToCart'])) {
    $endday = date("Y-m-d", strtotime($_POST['endday']));
    $startday = date("Y-m-d", strtotime($_POST['startday']));
    $price = $_POST['price'];
    $period = $_POST['period'];
    $vehicles_id = $id;
    $category_id = $vehicles['category_id'];

    if (empty($endday)) {
        $errors[] = 'you should enter endday';
    }

    if (empty($startday)) {
        $errors[] = 'you should enter startday';
    }
    if (empty($price)) {
        $errors[] = 'you should enter price';
    }

    if (empty($period)) {
        $errors[] = 'you should enter rental period';
    }
    if (empty($errors)) {
        $image = time() . '-' . $_FILES['image_id']['name'];
        move_uploaded_file($_FILES["image_id"]["tmp_name"], 'images/license/' . $image);
        // if all inputs is exists, insert all inputs  in vec_order table 
        $stmt = $con->prepare("insert vec_order
         (vehicles_id ,user_id,price,startday,endday,status,period,image_id,category_id) 
        values (?,?,?,?,?,?,?,?,?)");
        $stmt->execute(array(
            $vehicles_id, $_SESSION['user_id'], $price,
            $startday, $endday, '0', $period, $image, $category_id
        ));

        header("Location:order.php");
        exit;
    }
}
?>
<!-- error alert if has an error -->
<?php if (isset($_GET["error"]) || !empty($errors)) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">should enter real value</p>'; ?>
        </div>
    </div>
<?php }
//success alert 
if (isset($_GET["success"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertsuccess">
            <?php echo  '<p"> waiting managment accept</p>'; ?>
        </div>
    </div>
<?php } ?>

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
        .file {
            opacity: 0;
            width: 0.1px;
            height: 0.1px;
            position: absolute;
        }

        .file-input label {
            display: block;
            position: relative;
            width: 200px;
            height: 50px;
            border-radius: 25px;
            background: linear-gradient(40deg, #0A2749, #e69138);
            box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: transform .2s ease-out;
        }

        .file-name {
            position: absolute;
            bottom: -35px;
            left: 10px;
            font-size: 0.85rem;
            color: #555;
        }

        input:hover+label,
        input:focus+label {
            transform: scale(1.02);
        }

        /* Adding an outline to the label on focus */
        input:focus+label {
            outline: 1px solid #000;
            outline: -webkit-focus-ring-color auto 2px;
        }

        .bn62 {
            color: orange;
            background-color: #1b2f31;
            border-radius: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 3em;
            width: 8em;
            font-size: large;
            font-weight: 600;

        }

        .holiday,
        .ui-datepicker .holiday span {
            background: none #FFEBAF;
            border: 1px solid #BF5A0C;
        }
    </style>
</head>
<div class="container-fluid pt-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-4 text-uppercase mb-5"><?php echo $vehicles["VType"]; ?> <?php echo $vehicles["v_name"]; ?></h1>
        <div class="row align-items-center pb-2">
            <div class="col-lg-6 mb-4">
                <img src="images/vehicles/<?php echo $vehicles['image'] ?>" style="border-radius: 5px;padding-left: -71px !important;height: 70%;width:90%;margin-left: -38px;" alt="" width="78%" height="400px">
            </div>
            <div class="col-lg-6 mb-4">
                <h4 class="mb-2"> <span style="color:#4C4C4C;font-size:40px; "> <span id="priceOld"><?php echo $vehicles["price"]; ?></span>₪/Day</h4>
                <div class="d-flex mb-3">
                    <h6 class="mr-2">Ratting:</h6>
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
        <h2 class="mb-4">Reservation-card</h2>
        <div class="mb-5">
            <div class="row">

            </div>
            <form method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>">

                <div class="row">
                    <div class="col-6 form-group">
                        <div class="date" id="date1" data-target-input="nearest">
                            <input name="startday" type="text" class="form-control p-4 datetimepicker-input form" id="datepicker" placeholder="Pickup Date" data-target="#date2" data-toggle="datetimepicker" />
                        </div>

                    </div>
                    <div class="col-6 form-group">
                        <div class="time" id="date2" data-target-input="nearest">
                            <input name="endday" value="" type="text" class="form-control p-4 datetimepicker-input to" id="datepicker2" />
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <div class="time" id="time2" data-target-input="nearest">
                            <input type="text" id="between_days" name="period" type="date" name="endday" value="" id="to" type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Time" data-target="#time2" data-toggle="datetimepicker" />
                        </div>

                    </div>

                    <div class="col-6 form-group">
                        <div class="time" data-target-input="nearest">
                            <input type="text" id="price" name="price" type="text" value="" type="text" class="form-control p-4 datetimepicker-input" placeholder="Price" data-target="#time2" data-toggle="datetimepicker" />
                        </div>

                    </div>
                    <!-- Activates the function compareDates() -- Calculating the no. of days between two dates  -->
                    <span onclick="compareDates()" class="bn62">Calculate</span>



                    <div class="file-input">
                        <input type="file" id="file" name="image_id" class="file" required>
                        <label for="file" required>
                            License Card *
                            <p class="file-name" required></p>
                        </label>
                    </div>


                    &nbsp
                    <button style="margin-left:55%" class="bn62">Rent</button>
            </form>
        </div>
    </div>
</div>
</div>

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
                    <i class="fa fa-star" style="color:orange"></i>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script>
    $(function() {

        <?php





        //check if vec_order
        $check = $con->prepare("select id from vec_order where vehicles_id =? and status>0");
        $check->execute(array($_GET['id']));
        $count = $check->rowCount();
        if ($count > 0) {

            //get start and end date from data base
            $fromdata = $con->prepare('SELECT * from vec_order where vehicles_id=? and status>0');
            $fromdata->execute(array($_GET['id']));

            $x = [];
            $data = $fromdata->fetchAll();
            foreach ($data as $d) {
                $startday = strtotime($d['startday']);
                $endday = strtotime($d['endday']);

                $datediff = $endday - $startday;

                $dif = round($datediff / (60 * 60 * 24));


                $start = $d['startday'];
                for ($i = 0; $i < $dif; $i++) {

                    $x[] = date('d-m-Y', strtotime($start . ' + ' . ($i) . ' day'));
                }
            }




            // print_r($x);




        ?>
            var dates = [
                <?php
                foreach ($x as $b) {
                    echo "'" . $b . "',";
                } ?>
            ];
            //  console.log(dates)

            function disableDates(date) {
                var string = $.datepicker.formatDate('dd-mm-yy', date);
                return [dates.indexOf(string) == -1];
            }

            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                beforeShowDay: disableDates
            });

            $("#datepicker2").datepicker({
                dateFormat: "yy-mm-dd",
                beforeShowDay: disableDates
            });
        <?php  } ?>

        $("#datepicker").datepicker();

        $("#datepicker2").datepicker();
    });
</script>








<script>
    function getPreviousDay(date = new Date()) {
        const previous = new Date(date.getTime());
        previous.setDate(date.getDate() - 1);

        return previous;
    }

    function compareDates() {
        //Get the text in the elements
        var from = $('#datepicker').datepicker('getDate');
        var to = $('#datepicker2').datepicker('getDate');
        // console.log(from)
        // console.log(to)
        var date1 = new Date(from);
        var date2 = new Date(to);

        var today = new Date();
        // console.log(date1);
        // console.log(today);
        if (getPreviousDay(new Date()) > date1 || date2 < date1) {
            //Do something..
            alert("can't chose this date");
            return false;
        }
        <?php

        //get start and end date from data base
        $fromdata = $con->prepare('SELECT min(startday) as star_day,
max(endday) as end_day from vec_order where vehicles_id=? and status>0');
        $fromdata->execute(array($_GET['id']));

        $data = $fromdata->fetch();

        ?>


        <?php if (isset($data['end_day'])) { ?>
            console.log(new Date("<?php echo $data[0] ?>").getTime());
            console.log(new Date("<?php echo $data[0] ?>").getTime() < date2.getTime());
            // يجيب ايام لي بينهم


            //يقارن اذا موجوده في مصفوفة
            // if (!in_array($data, date1.getTime())) {

            //     //        if (!in_array($data) date1.getTime() < new Date("<?php echo  $data[0] ?>").getTime() && new Date("<?php echo $data[0] ?>").getTime() < date2.getTime()) {
            //     //Do something..
            //     alert("this days was chose by other people !!");
            //     return false;
            // }
        <?php } ?>


        // To calculate the time difference of two dates
        var Difference_In_Time = date2.getTime() - date1.getTime();
        // One day in milliseconds
        const oneDay = 1000 * 60 * 60 * 24;
        // Calculating the no. of days between two dates
        const diffInDays = Math.round(Difference_In_Time / oneDay);
        if (diffInDays > 0) {
            //     console.log(diffInDays)
            document.getElementById('between_days').value = diffInDays;
            let price = document.getElementById('priceOld').textContent;
            let price_between_days = price * diffInDays;
            document.getElementById('price').value = price_between_days;
        } else {
            alert("you should enter valid dates");
        }
    }
</script>
<script>
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>

<?php require_once "include/footer.php";
ob_end_flush() ?>