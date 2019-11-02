<?php 

session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: startVote.php");
    exit;
}
else if (isset($_SESSION["adminlogin"]) && $_SESSION["adminlogin"] === true) {
    header("location: viewVoteDetails.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
         <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
         <link rel="stylesheet" href="css/style.css">

         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

         <title>Voting-App</title>
   </head>
   <body>
      <!-- Navigation -->
      <nav class="navbar navbar-dark navbar-expand-sm fixed-top bg-dark">
         <div class="container">
            <a class="navbar-brand" href="index.php">Voting App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="./index.php"><span class="fa fa-home fa-sm"></span> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-info-circle fa-sm"></span> About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-info-circle fa-sm"></span> Contact Us </a></li>
               </ul>
            </div>
         </div>
      </nav>
<!--signup -->
<div id="signupmodal" class="modal" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">SignUp / Register</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form name="registerForm" action="dbScripts/dbRegister.php" onsubmit="return validateRegisterForm()" method="post">
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label">Email address </label>
                                :
                                <div class="col-md-6">
                                    <input type="username" name="username" class="form-control form-control-sm mr-1" id="username" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">Password</label> :
                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control form-control-sm mr-1" id="password" placeholder="Enter password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="repassword" class="col-md-4 col-form-label">Re-enter your Password</label> :
                                <div class="col-md-6">
                                    <input type="password" name="repassword" class="form-control form-control-sm mr-1" id="repassword" placeholder="Re-enter your password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mnumber" class="col-md-4 col-form-label">Mobile Number</label> :
                                <div class="col-md-6">
                                    <input type="mnumber" name="mnumber" class="form-control form-control-sm mr-1" id="mnumber" placeholder="Enter Mobile Number">
                                </div>
                            </div>
                        <div class="form-row">
                                <button type="reset" class="btn btn-warning btn-sm ml-auto">Reset</button>
                                <button type="button" class="btn btn-secondary btn-sm ml-auto" data-dismiss="modal">Cancel</button>
                                <button type="submit" value="submit" id="submit" class="btn btn-primary btn-sm ml-1">Register Me !!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>

      <header class="jumbotron">
        <div class="container">
            <div class="row row-header">
                <div class="col-12 col-sm">
                    <br/>
                    <br/>
                    <marquee>Welcome to Voting web application. Life is easier here.. </marquee>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
<?php
if(isset($_SESSION['registered']) && $_SESSION['registered'] == 1) {
    echo '<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Your account has been successfully created.
</div>';
}

if(isset($_SESSION['registered']) && $_SESSION['registered'] == 0) {
    echo '<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sorry!</strong> The email / number you provided already exists.
  </div>';
}
$_SESSION['registered'] = -1;
?>
        <div class="row row-content">
            <div class="row">
                <div class="col col-sm-7 align-self-center">
                    <h1> Welcome to the online voting app </h1>
                    <hr>
                    <p> This is built to make one's life easy so that he/she can vote on a single click witout even have to worry about long queues and the hot sunlight outside.</p>

                </div>
                 <div class="col col-sm-2 align-self-center">
                 </div>
                <div class="col col-sm-3 align-self-center">
                        <h3>Login</h3>
                        <form name="LoginForm" class="needs-validation" action="dbScripts/dbLogin.php" onsubmit="return validateLoginForm()" method="post">
                        <div class="form-row">
                            <div class="form-group col">
                                    <label class="sr-only" for="username">Email address</label>
                                    <input type="username" name="username" class="form-control form-control-sm mr-1" id="username" placeholder="Enter username">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="sr-only" for="password">Password</label>
                                <input type="password" name="password" class="form-control form-control-sm mr-1" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                    <button type="submit" value="submit" id="submit" class="btn btn-primary btn-sm ml-1">Sign in</button>
                                    <input type=button class="btn btn-info btn-sm ml-1" data-toggle="modal" data-target="#signupmodal" value="New User ?">
                            </div>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer bg-dark">
        <div class="container">
            <div class="row">             
                <div class="col-6 col-sm-6 align-self-center">
                    <div class="text-left">
                        <a href="#"><span class="fa fa-home fa-sm"></span> Home </a></br>
                        <a href="#"><span class="fa fa-info-circle fa-sm"></span> About </a></br>
                        <a href="#"><span class="fa fa-envelope fa-sm"></span> Contact </a>
                    </div>
                </div>
                <div class="col-6 col-sm-6 align-self-center">
                    <div class="text-center">
                        <a class="btn btn-social-icon btn-google" href="http://google.com/+"><i class="fa fa-google-plus fa-lg"></i></a>
                        <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.html?id="><i class="fa fa-facebook fa-lg"></i></a>
                        <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i class="fa fa-linkedin fa-lg"></i></a>
                        <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fa fa-twitter fa-lg"></i></a>
                        <a class="btn btn-social-icon btn-youtube" href="http://youtube.com/"><i class="fa fa-youtube fa-lg"></i></a>
                        <a class="btn btn-social-icon" href="mailto:kailashjoshi018@gmail.com"><i class="fa fa-envelope fa-lg"></i></a>
                    </div>
                </div>
           </div>
           <div class="row justify-content-center">             
                <div class="col-auto">
                    <p>© Copyright 2019 Voting App</p>
                </div>
           </div>
        </div>
    </footer>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
   </body>
   <script>
    function validateRegisterForm() {
		var email = document.forms["registerForm"]["username"].value;
        if (email == "") {
            alert("Please enter valid email");
            return false;
        }
		console.log(email);
		if (email.length > 1 ) {
			console.log('12');
			var atPosition = email.indexOf("@");
			var dotPosition = email.lastIndexOf(".");  
			if (atPosition<1 || dotPosition<atPosition+2 || dotPosition+2>=email.length){  
				alert("Please enter a valid e-mail address");  
			return false;  
			} 
		}
        else if (document.forms["registerForm"]["password"].value == "") {
            alert("Please enter password");
            return false;
        }
        else if (document.forms["registerForm"]["repassword"].value == "") {
            alert("Please re-enter your password");
            return false;
        }
        else if (document.forms["registerForm"]["mnumber"].value.length < 10) {
            alert("Please enter valid number");
            return false;
        }
        else if ((document.forms["registerForm"]["password"].value) != (document.forms["registerForm"]["repassword"].value)) {
            alert("Password mismatch, please enter similar password");
            return false;
        }
        else return true;
    }

    function validateLoginForm() {
        if(document.forms["LoginForm"]["username"].value == ""){
            alert("Please enter valid email");
            return false;
        }
        else if (document.forms["LoginForm"]["password"].value == "") {
            alert("Please enter password");
            return false;
        }
        else return true;
    }
   </script>
</html>









