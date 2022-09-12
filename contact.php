<?php 
ob_start();
$selected = "contact";
require_once "include/header.php";
if (isset($_SESSION["user_id"]) && $_SESSION["role"] != 'users') {
    header("location:index.php");
}

//get all settings and shows them in this page
$sql = $con->prepare("SELECT * FROM `settings` where id=1");
$sql->execute();
$setting = $sql->fetch();
$name = '';
$email = '';
$subject = '';
$message = '';
//check all inputs if not empty
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($name)) {
        $errors[] = 'you should enter name';
    }
    if (empty($email)) {
        $errors[] = 'you should enter email';
    }
    if (empty($subject)) {
        $errors[] = 'you should enter subject';
    }
    if (empty($message)) {
        $errors[] = 'you should enter message';
    }

    if (empty($errors)) {
//insert into contact table all the values in the inputs 
        $sql = $con->prepare("INSERT INTO `contact_us` (`name`, `email`, `subject`, `message`) VALUES (?, ?, ?, ?)");
        $sql->execute(array($name, $email, $subject, $message));
//get the settings
        $set = $con->prepare("select * from settings where id=1");
        $set->execute();
        $setting = $set->fetch();
        $to = $setting['email'];
        $sender = "From:" . $email;
        $data =  mail($to, $subject, $message, $sender);

//sending the succsses alert
        header("Location:contact.php?success=2");
    }
}
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
  <!-- if all inputs not empty send success message -->
  <?php if (isset($_GET["success"])) { ?>
        <div class="AlertMessage">
            <div class="alert alertsuccess">
                <?php echo  '<p">Your Message has been sent  </p>'; ?>
            </div>
        </div><br><br>
    <?php } ?>
<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase text-center mb-5">Contact Us</h1>
            <div class="row">
                <div class="col-lg-7 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <input type="text" name="name" class="form-control p-4" placeholder="Your Name" required="required">
                                </div>
                                <div class="col-6 form-group">
                                    <input type="email" name="email" class="form-control p-4" placeholder="Your Email" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="subject" type="text" class="form-control p-4" placeholder="Subject" required="required">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control py-3 px-4" name="message" rows="5" placeholder="Message" required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-2">
                    <div class="bg-secondary d-flex flex-column justify-content-center px-5 mb-4" style="height: 435px;">
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Head Office</h5>
                                <a href=""><?php  echo $setting['address'] ?></a>

                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Phone</h5>
                                <a href="tel:+049919546"><?php echo $setting['phone'] ?></a>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Customer Service</h5>
                                <a href="mailto:<?php echo $setting['email'] ?>"><?php echo $setting['email'] ?></a>
                            </div>
                        </div>
                        
                    </div>
            </div>                </div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53588.6190461581!2d35.05299162603662!3d32.916970093975486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151dc8fe03b29c25%3A0x709859e5804dc329!2sAcre!5e0!3m2!1sen!2sil!4v1658104564967!5m2!1sen!2sil" width="1110" height="450" style="border:10;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
    </div>
    <!-- if have an error sending error alert -->
<?php if (isset($_GET["error"])) { ?>
    <div class="AlertMessage">
        <div class="alert alertError">
            <?php echo  '<p">' . $_GET["error"] . '</p>'; ?>
        </div>
    </div>
<?php } ?>



<?php require_once "include/footer.php"; ob_end_flush(); ?>
