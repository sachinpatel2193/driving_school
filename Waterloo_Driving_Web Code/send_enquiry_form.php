<?php
require_once('phpmailer/PHPMailerAutoload.php');

if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "info@waterloodrivingschool.ca";
    $email_subject = "Got Enquiry from someone";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone_number']) ||
        !isset($_POST['address']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $phone_number = $_POST['phone_number']; // required
    $address = $_POST['address']; // not required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
    $address_exp = "/^\s*\S+(?:\s+\S+){2}/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($address_exp,$address)) {
    $error_message .= 'The address you entered does not appear to be valid.<br />';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'The message you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Phone Number: ".clean_string($phone_number)."\n";
    $email_message .= "Address: ".clean_string($address)."\n";
    $email_message .= "message: ".clean_string($message)."\n";



// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
/*$smtp = Mail::factory('smtp', array('host' => $host,
                                    'auth' => true,
                                    'username' => $username,
                                    'password' => $password));*/

//mail($email_to, $email_subject, $email_message, $headers) or die("Failure");

$mail->Host='server214.web-hosting.com';
$mail->Username='noreply@waterloodrivingschool.ca';
$mail->Password='sachin123';
$mail->SMTPDebug = 4;

$mail = new PHPMailer();  // create a new object
//$mail->isSMTP(); // enable SM TP
$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled

$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SetFrom($email_from, $name);
    $mail->Subject = $email_subject;
    $mail->Body = $email_message;
    $mail->AddAddress($email_to);
    if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo;
        return false;
    } else {
        ?>

          <!DOCTYPE html>
          <html lang="en">

          <head>

              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <meta name="description" content="">
              <meta name="author" content="">

              <title>Waterloo Driving School</title>

              <!-- Bootstrap Core CSS -->
              <link href="css/bootstrap.min.css" rel="stylesheet">

              <!-- Custom CSS -->
              <link href="css/logo-nav.css" rel="stylesheet">
              <link href="css/main.css" rel="stylesheet">
              <link href="css/thanks_page.css" rel="stylesheet">

              

              <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
              <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
              <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
              <![endif]-->

          </head>

          <body>
          <div id="wrapper">
              <!--div id="header"></div-->

              <!-- Navigation -->
              <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                  <div class="container">
                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand" href="#">
                              <img class="logo" alt="Waterloo Driving School">
                          </a>
                      </div>
                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                              <li>
                                  <a href="index.html">Home</a>
                              </li>
                              <li>
                                  <a href="register.html">Register</a>
                              </li>
                              <li>
                                  <a href="offers.html">Offers</a>
                              </li>
                              <li>
                                  <a href="courses.html">Courses</a>
                              </li>
                              <li>
                                  <a href="contact_us.html">Contact Us</a>
                              </li>
                              
                          </ul>
                          <ul class="contact_info nav navbar-nav navbar-right">
                                  <li class="call">Call Us on:&nbsp;</li>
                                  <li class="number"><a href="tel:5197299275">519-729-9275</a></li>
                              </ul>
                      </div>
                      <!-- /.navbar-collapse -->
                  </div>
                  <!-- /.container -->
              </nav>

              <!-- Page Content -->
              <div id="content_id" class="container">
                      <h3>Thanks for contacting us. We will get back to you as soon as possible.</h3>
              </div>
              <!-- /.container -->

              <!--div id="footer"></div-->

              <footer class="footer">
                  <div class="container">
                      <a href="index.html">Home | </a>
                      <a href="contact_us.html">Contact Us</a>
                      <br>
                      <p>Copyright-<a href="index.html">waterloodrivingschool.ca</a> 2017 All Rights Reserved</p>
                  </div>
              </footer>
          </div>
              <!-- jQuery -->

              <script src="js/jquery.js"></script>
              <!--script>
                  $("#header").load("header.html");
                  $("#footer").load("footer.html");
              </script-->

              <!-- Bootstrap Core JavaScript -->
              <script src="js/bootstrap.min.js"></script>

          </body>

          </html>




        <?php
        return true;
    }
    
 
}
?>