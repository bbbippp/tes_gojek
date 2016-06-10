<?php
if(isset($_POST['btn-register']))
{
   $name = trim($_POST['name']);
   $email = trim($_POST['email']);
   $phone = trim($_POST['phone']); 
   $occupation = trim($_POST['occupation']); 
 
   if($name=="") {
      $error[] = "provide name !"; 
   }
   else if($email=="") {
      $error[] = "provide email !"; 
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($phone=="") {
      $error[] = "provide phone !";
   }
   else if($occupation==""){
      $error[] = "provide occupation !"; 
   }
   else
   {
			//date_default_timezone_set('Etc/UTC');
			require 'phpmailer/PHPMailerAutoload.php';

			$mail = new PHPMailer;

			$mail->isSMTP();

			$mail->Debugoutput = 'html';

			$mail->Host = 'smtp.gmail.com';

			$mail->Port = 587;

			$mail->SMTPSecure = 'tls';

			$mail->SMTPAuth = true;

			$mail->Username = "ian.gomu@gmail.com";

			$mail->Password = "new280sunk";

			$mail->setFrom('ian.gomu@gmail.com', 'Ian Gumilang');

			$mail->addReplyTo('ian.gomu@gmail.com', 'Ian Gumilang');

			$mail->addAddress('haibryda@gmail.com', 'bbbippp');

			$mail->Subject = 'NEW USER NOTIFICATION';

			$mail->IsHTML(true);

			$mail->Body    = 'Hi there ,
							There is a new user registration, description below :<br>
							Name : '.$name.'<br>
							Phone : '.$phone.'<br>
							Email : '.$email.'<br>
							Occupation : '.$occupation.'
							<br>';

			if (!$mail->send()) {
				$error[] = "Mailer Error: " . $mail->ErrorInfo;
			} else {
				 header("Location: index.php?joined");
			}
  } 
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <meta name="description" content="">
    <meta name="author" content="ian gumilang">
    <link rel="icon" href="favicon.ico">

    <title>Register here</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	<link href="register.css" rel="stylesheet">
	
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST">
		<div class="col-md-12">
			<h2 class="form-signin-heading">Register here</h2>
		</div>
		
		<div class="col-md-12">
			<?php
            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      Successfully registered, wait for notification.
                 </div>
                 <?php
            }
            ?>
		</div>
		
		<div class="col-md-12 m-b-10">
			<label for="inputName" class="sr-only">Name</label>
			<input type="text" id="inputEmail" class="form-control" placeholder="Name" name="name" required autofocus>
        </div>
		<div class="col-md-12 m-b-10">
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required >
		</div>
		
		<div class="col-md-12 m-b-10">
		<label for="inputPhone" class="sr-only">Phone</label>
        <input type="text" id="inputPhone" class="form-control" placeholder="Phone" name="phone" required >
        </div>
		
		<div class="col-md-12 m-b-10">
		<label for="inputOccupation" class="sr-only">Occupation</label>
        <select id="inputOccupation" class="form-control" name="occupation" required>
			<option value="">--Occupation--</option>
			<option value="">----</option>
			<option value="architect">Architect</option>
			<option value="designer">Designer</option>
			<option value="programmer">Programmer</option>
		</select>
        </div>
		
		<div class="col-md-12 m-b-10">
		<button class="btn btn-lg btn-block" name="btn-register" type="submit">Sign in</button>
		</div>
	  </form>

    </div> <!-- /container -->


  </body>
</html>
