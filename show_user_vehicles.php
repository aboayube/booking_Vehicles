<?php
require_once "include/header.php";
$id = $_GET['id'];
if ($id && is_numeric($id)) {
//get the data of the two tables, the vehicle table and the table vec_order, 
//in the table vec_order have the LicenseNum for the vehicle that the customer rent it ,
//then  from vec_order table got all the fields and display them in this page.
    $stmt = $con->prepare("
    select 
    vehicles.*,vec_order.*,lincenesrank.code linces_code,categories.name as category_name  
    from 
    categories,lincenesrank , vec_order,vehicles
    where vehicles.category_id=categories.id  
    and  lincenesrank.id=vehicles.lincenes_id 
    and vec_order.vehicles_id=vehicles.LicenseNum 
    and vec_order.user_id=" . $_SESSION['user_id'] . "
    and  vehicles.LicenseNum=? limit 1");

    $stmt->execute(array($id));
    $count = $stmt->rowCount();

// the count calculate how many fields in this id if count > 0 display the vehicle details else go to index.php
    if ($count > 0) {
        $vehicles = $stmt->fetch();
    } else {

        header("Location:index.php");
        exit;
    }
}
$ratting='';
$message='';
$success;
// if clicked Add comment 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ratting = $_POST['ratting'];
    $message = $_POST['message'];
    $id = $_GET['id'];
    $errors = [];
    //check if the ratting is empty
    if (empty($ratting)) {
        $errors[] = 'you should enter ratting';
    }
    //check if message is empty
    if (empty($message)) {
        $errors[] = 'you should enter message';
    }
    //if there is no errors insert to comment_vehicles the message and sending an success alert
    if (empty($errors)) {
        $stmt = $con->prepare("insert into comments_vehicles
         (vehicles_id ,user_id,ratting,message) 
        values (?,?,?,?)");

        $stmt->execute(array(
            $id, $_SESSION['user_id'], $ratting, $message
        ));
        $success="Comment Added Successfully";
    }
}
?>
<!--if there is an error , display error alert -->
<?php if (isset($_GET["error"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">' . $_GET["error"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>
<!--if there is no errors , display success alert -->
<?php if (isset($success)) { ?>
    <div class="AlertMessage">
        <div class="alert alertsuccess">
            <?php echo  '<p">' . $success. '</p>'; ?>
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
    <style>
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
 .rating {
        --dir: right;
        --fill: orange;
        --fillbg: rgba(100, 100, 100, 0.15);
        --heart: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.328l-1.453-1.313q-2.484-2.25-3.609-3.328t-2.508-2.672-1.898-2.883-0.516-2.648q0-2.297 1.57-3.891t3.914-1.594q2.719 0 4.5 2.109 1.781-2.109 4.5-2.109 2.344 0 3.914 1.594t1.57 3.891q0 1.828-1.219 3.797t-2.648 3.422-4.664 4.359z"/></svg>');
        --star: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.25l-6.188 3.75 1.641-7.031-5.438-4.734 7.172-0.609 2.813-6.609 2.813 6.609 7.172 0.609-5.438 4.734 1.641 7.031z"/></svg>');
        --stars: 5;
        --starsize: 3rem;
        --symbol: var(--star);
        --value: 1;
        --w: calc(var(--stars) * var(--starsize));
        --x: calc(100% * (var(--value) / var(--stars)));
        block-size: var(--starsize);
        inline-size: var(--w);
        position: relative;
        touch-action: manipulation;
        -webkit-appearance: none;
    }

    [dir="rtl"] .rating {
        --dir: left;
    }

    .rating::-moz-range-track {
        background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
        block-size: 100%;
        mask: repeat left center/var(--starsize) var(--symbol);
    }

    .rating::-webkit-slider-runnable-track {
        background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
        block-size: 100%;
        mask: repeat left center/var(--starsize) var(--symbol);
        -webkit-mask: repeat left center/var(--starsize) var(--symbol);
    }

    .rating::-moz-range-thumb {
        height: var(--starsize);
        opacity: 0;
        width: var(--starsize);
    }

    .rating::-webkit-slider-thumb {
        height: var(--starsize);
        opacity: 0;
        width: var(--starsize);
        -webkit-appearance: none;
    }

    .rating,
    .rating-label {
        display: block;
        font-family: ui-sans-serif, system-ui, sans-serif;
    }

    .rating-label {
        margin-block-end: 1rem;
    }

    /* NO JS */
    .rating--nojs::-moz-range-track {
        background: var(--fillbg);
    }

    .rating--nojs::-moz-range-progress {
        background: var(--fill);
        block-size: 100%;
        mask: repeat left center/var(--starsize) var(--star);
    }

    .rating--nojs::-webkit-slider-runnable-track {
        background: var(--fillbg);
    }

    .rating--nojs::-webkit-slider-thumb {
        background-color: var(--fill);
        box-shadow: calc(0rem - var(--w)) 0 0 var(--w) var(--fill);
        opacity: 1;
        width: 1px;
    }

    [dir="rtl"] .rating--nojs::-webkit-slider-thumb {
        box-shadow: var(--w) 0 0 var(--w) var(--fill);
    }
   
        </style>
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
              
             
            </div>
          
    <div class="container-fluid pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                <div class="comments" style="margin-top:50px;background:white; width:107%">
              
                <?php
                // if there is an comments and the status of the comment is =1 or active display the comment for the vehicle by id
                $comment = $con->prepare('select
 comments_vehicles.*,users.name as user_name 
 from comments_vehicles,users where
 users.id=comments_vehicles.user_id and
 comments_vehicles.vehicles_id=? and comments_vehicles.status=1
 
');
                $comment->execute(array($_GET['id']));
                $comments = $comment->fetchAll();
                //loop threw comments
                foreach ($comments as $comment) {
                ?>
                    <div style="display: flex;
<br>
padding:100px">
                        <div class="">
                            <h1 style="
    font-size: 35px;
    
    font-family: 'Brush Script MT', cursive;"><?php echo $comment['user_name']; ?></h1>
                            <p style="
    font-family:fantasy; color:orange;"><?php echo $comment['message']; ?></p>
                        </div>
                        <div style="margin-left:35%">
                            <?php
                            //This loop is for ratting thats the stars filled with orange color
                            for ($i = 0; $i < $comment['ratting']; $i++) { ?>
                                <i class="fa fa-star" style="color:orange"></i>
                                <?php }
                                //check if the stars that filled with the orange color < 5
                            if ($comment['ratting'] < 5) {
                                //This loop for the star that not filled thats meaמ The rest of the stars ratting
                                for ($i = 0; $i < 5 - $comment['ratting']; $i++) { ?>
                                    <i class="fa fa-star" style="color:#ccc"></i>
                            <?php }
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                <?php }
                if (isset($_SESSION['user_id'])) {
                ?>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <h1 style="margin-top:20px;margin-left:30%; color:orange">Add Comment</h1>
                        <br/><br/>
                        <div style="display:flex;
    margin-top: 10px;
justify-content: space-around;">
                            <div class="info">
                            <h4>Comment</h4>
                                
                                <input style="height:40px;width:250px" type="text" name="message" placeholder="Comment" />
                            </div>
                            <div class="info">
                                <div class="rate">
                                    <h4>Ratting</h4>
                                    <input name="ratting" class="rating" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:2.5" type="range" value="2.5">
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="bn62" style="
    margin-left: 50%;
    width: 120px;
    height: 36px;

    margin-left:70px;
    margin-top:50px;
    margin-bottom:30px" name="submit" value="addComment" />
                    </form>
                <?php } ?>
            </div>

        </div>
             <!-- here displays orders info from vec_order table -->
                <div class="col-lg-4">
                    <div class="bg-secondary p-5 mb-5">
                    <h1 class="text-primary mb-4" style="text-align:center"> Order Info</h1>
                    <hr style="color:white">
                        <h2 class="text-primary mb-4"  style="font-size:20px">Pick Up Date- <?php echo $vehicles['startday'] ?> </h2>
                        <h2 class="text-primary mb-4"  style="font-size:20px">Drop Date- <?php echo $vehicles['endday'] ?> </h2>
                        <h2 class="text-primary mb-4"  style="font-size:20px">Total Rental Days- <?php echo $vehicles['period'] ?> Days </h2>
                        <h2 class="text-primary mb-4" style="font-size:20px">Total Price- <?php echo $vehicles['price'] ?> ₪</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Car Booking End -->

<?php require_once "include/footer.php";


?>
