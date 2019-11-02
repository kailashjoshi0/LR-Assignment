<?php

session_start();
if (isset($_SESSION["adminlogin"]) && $_SESSION["adminlogin"] === true) {
    header("location: viewVoteDetails.php");
    exit;
}

else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
	header("location: index.php");
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
         <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
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
                    <?php if($_SESSION['loggedin'] == true) {
                    	echo '<li class="nav-item">
                    				<a class="nav-link" href="#">
                    					<span class="fa fa-user-circle-o fa-sm">
                    					</span> ' .$_SESSION["username"].
                    				'</a>
                    		</li>';
                    	echo '<li class="nav-item">
                    				<a class="nav-link" href="dbScripts/dbLogout.php">
                    					<span class="fa fa-sign-out fa-sm">
                    					</span> Logout </a>
                    		</li>';
                    	}
                    ?>
               </ul>
            </div>
         </div>
      </nav>

<header class="jumbotron">
    <div class="container">
    	<div class="row row-header">
            <div class="col-12 col-sm"><br/><br/>
                    <h3>Welcome <?php echo $_SESSION['username'] ?> </h3> 
            </div>
        </div>
    </div>
</header>      
<div class="container">
			<?php
				if(isset($_SESSION['voted']) && $_SESSION['voted'] == "true") {
             	echo '<div class="alert alert-warning alert-dismissible">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Congrats!</strong> Your vote has been recorded.
					  </div>';
            	}
            	$_SESSION['voted'] = false;
            ?>
	<div class="row row-content">
            <div class="row">
                <div class="col col-sm-6 align-self-center">
                    <button class="btn btn-success" onclick="toggleViewDiv()">View List of Candidates</button>
                    <br><br>
                    <p>This will display the total candidates available in our database. This is just to have a view at all the candidates</p>
                </div>
                <div class="col col-sm-6 align-self-center">
                    <button class="btn btn-warning" <?php require("dbScripts/dbCheckStatus.php"); echo checkUserStatus(); ?> onclick="toggleVoteDiv()" >Start Voting </button>
                    <br><br>
                    <p>It's time for you to vote, please click above to select the candidate and submit your option.</p>
                </div>
            </div>
    </div>

    <div class="row row-content">
        <div class="row">
            	<div id="view" style="display: none;" class="table-wrapper-scroll-y my-custom-scrollbar">
                    	<?php
                    		require("dbScripts/dbGetListOfCandidates.php");
                    	?>
                </div>
            </div>
<div class="row">
            	<div id="vote" style="display: none;" class="table-wrapper-scroll-y my-custom-scrollbar">
                    	<?php
                    		require("dbScripts/dbGetListForVote.php");
                    	?>
                </div>
            </div>
        </div>
    </div>
        <br><br>

    <script type="text/javascript">
	function toggleViewDiv() {
		var y = document.getElementById("vote");
		if (y.style.display === "block") {
			y.style.display = "none";
		}

		var x = document.getElementById("view");
		if (x.style.display === "none") {
			x.style.display = "block";
		}
		else {
	    	x.style.display = "none";
		}
	}

	function toggleVoteDiv() {
		var x = document.getElementById("view");
		if (x.style.display === "block") {
			x.style.display = "none";
		}

		var y = document.getElementById("vote");
		if (y.style.display === "none") {
			y.style.display = "block";
		}
		else {
	    	y.style.display = "none";
		}
	}

    </script>

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
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
   </body>
</html>