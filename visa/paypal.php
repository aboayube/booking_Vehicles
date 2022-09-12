<?php
session_start();
include("../include/connect.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_GET['id'];

  $oldPrice = $_GET['oldPrice'];
  $Paid = '-';
  $number_pay = '1';
  //insert into payment table  the details that belong to the payment "paypal payment"
  $stmt = $con->prepare('insert into payment
   ( `user_vehicles_id`, `price`, `Paid`, `user_id`,
    `payment`, `number_pay`) 
   VALUES
    (?,?,?,?,?,?)');

  $stmt->execute(array($id, $oldPrice, $Paid, $_SESSION['user_id'], 'PayPal',  $number_pay));
  $count = $stmt->rowCount();
//check the count of the vairables if its count > 0 update by id vec_order status thats mean that he paid 
  if ($count > 0) {
    //update vehicle status to approved
    $sql = $con->prepare('update vec_order set status=2 where id=' . $id);
    $sql->execute();
//take the id of the vehicle to do editing 
    $s = $con->prepare("select vehicles_id  from vec_order where id=? ");
    $s->execute(array($id));
    $dat = $s->fetch();
//when the payment completed update vehicle quantity from quantity =1 to quantity =0
    $data = $con->prepare('update vehicles set quantity=0 where LicenseNum=?');
    $data->execute(array($dat['vehicles_id']));

//Vip Customer Algorethim
    // check if customer not join to club
    $club = $con->prepare('select id from clubs where user_Id=?'); //1 ibramh .....

    /*
    
    */ 
    $club->execute(array($_SESSION['user_id']));
    $club_count = $club->rowCount(); //0

    if ($club_count == 0) {

      // club if have 3 rentals before
      $pr = $con->prepare('select count(id) as count from vec_order where user_id=? and  status=2 ');
      $pr->execute(array($_SESSION['user_id']));
      $count = $pr->fetch();
      // if the count of the rental for the customer >= 3 , 
      //insert the customer to clubs table and then the customer can take a discount for the vehicles
      if ($count['count'] >= 3) {
        $stmt = $con->prepare("insert clubs
  (user_id,status) 
  values (?,'1')");
        $stmt->execute(array(
          $_SESSION['user_id'],
        ));
      }
    }
    header("Location:../index.php");
    exit;
  }
}

?>

<style>
  .corral {
    margin: 0 auto;
    width: 460px;
  }

  .contentContainer {
    position: relative;
    margin: 130px auto 0;
    padding: 30px 10% 50px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -khtml-border-radius: 5px;
    border-radius: 5px;
  }

  .textInput input,
  .textInput textarea {
    height: 44px;
    width: 100%;
    padding: 0 10px;
    border: 1px solid #9da3a6;
    background: #fff;
    text-overflow: ellipsis;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -khtml-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    color: #000;
    font-size: 1em;
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
    direction: ltr;
  }

  .textInput {
    position: relative;
    margin: 0 0 10px;
  }

  .textInput .fieldLabel {
    position: absolute;
    color: #6c7378;
    clip: rect(1px 1px 1px 1px);
    clip: rect(1px, 1px, 1px, 1px);
    padding: 0;
    border: 0;
    height: 1px;
    width: 1px;
    overflow: hidden;
  }

  a.button:hover,
  a.button:link:hover,
  a.button:visited:hover,
  .button:hover {
    background-color: #005ea6;
    outline: 0;
  }

  a.button,
  a.button:link,
  a.button:visited,
  .button {
    width: 100%;
    height: 44px;
    padding: 0;
    border: 0;
    display: block;
    background-color: #0070ba;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -khtml-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    -webkit-tap-highlight-color: transparent;
    color: #fff;
    font-size: 1em;
    text-align: center;
    font-weight: 700;
    font-family: HelveticaNeue-Medium, "Helvetica Neue Medium", HelveticaNeue,
      "Helvetica Neue", Helvetica, Arial, sans-serif;
    text-shadow: none;
    text-decoration: none;
    -webkit-transition: background-color 0.4s ease-out;
    -moz-transition: background-color 0.4s ease-out;
    -o-transition: background-color 0.4s ease-out;
    transition: background-color 0.4s ease-out;
    -webkit-font-smoothing: antialiased;
  }

  .actionsSpaced {
    margin-top: 30px;
  }

  .fieldWrapper {
    position: relative;
    z-index: 2;
    width: 100%;
  }

  .forgotLink {
    margin: 20px auto;
    padding-bottom: 20px;
    border-bottom: 1px solid #cbd2d6;
    text-align: center;
  }

  a.button.secondary,
  a.button.secondary:link,
  a.button.secondary:visited,
  .button.secondary {
    background-color: #e1e7eb;
    color: #2c2e2f;
  }

  a.button,
  a.button:link,
  a.button:visited {
    padding-top: 11px;
  }

  a,
  a:link,
  a:visited {
    color: #0070ba;
    font-family: HelveticaNeue, "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: 400;
    text-decoration: none;
    -webkit-transition: color 0.2s ease-out;
    -moz-transition: color 0.2s ease-out;
    -o-transition: color 0.2s ease-out;
    transition: color 0.2s ease-out;
  }
</style>

<div id="main" class="main" role="main">
  <section id="login" class="login" data-role="page" data-title="Log in to your PayPal account">
    <div class="corral">
      <div id="content" class="contentContainer">
        <header>
          <p class="paypal-logo paypal-logo-long">
            <center>
              <img src="https://www.paypalobjects.com/images/shared/paypal-logo-129x32.png" />
            </center>
          </p>
        </header>
        <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
          <div id="passwordSection" class="clearfix">
            <div class="textInput" id="login_emaildiv">
              <div class="fieldWrapper">
                <label for="email" class="fieldLabel">Email</label>
                <input id="email" name="login_email" type="email" class="hasHelp validateEmpty" required="required" aria-required="true" value="" autocomplete="off" placeholder="Email" />
              </div>
            </div>

            <div class="textInput lastInputField" id="login_passworddiv">
              <div class="fieldWrapper">
                <label for="password" class="fieldLabel">Password</label>
                <input id="password" name="login_password" type="password" class="hasHelp validateEmpty" required="required" aria-required="true" value="" placeholder="Password" />
              </div>
            </div>
          </div>
          <div class="actions actionsSpaced">
            <button class="button actionContinue" type="submit" id="btnLogin" name="btnLogin" value="Login">
              Log In
            </button>
          </div>
          <div class="forgotLink">
            <a href="#" id="forgotPasswordModal" class="scTrack:unifiedlogin-click-forgot-password">Having trouble logging in?</a>
          </div>
          <input type="hidden" id="bp_mid" name="bp_mid" value="" />
        </form>
      </div>
    </div>
  </section>
</div>

