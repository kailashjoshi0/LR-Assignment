<?php 

session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: startVote.php");
    exit;
}
else if (isset($_SESSION["adminlogin"]) && $_SESSION["adminlogin"] === false) {
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
                    <?php if($_SESSION['adminlogin'] == true) {
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
				if(isset($_SESSION['added']) && $_SESSION['added'] == "true") {
             	echo '<div class="alert alert-success alert-dismissible">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Congrats!</strong> New candidate has been added.
					  </div>';
            	}
            	$_SESSION['added'] = false;
            ?>
	<div class="row row-content">
            <div class="row">
                <div class="col col-sm-4 align-self-center">
                    <button class="btn btn-primary" onclick="toggleViewDiv()" >View All Candidates</button>
                    <br><br>
                    <p>View the complete list of candidates, directly from database. </p>
                </div>
				<div class="col col-sm-4 align-self-center">
                    <button class="btn btn-success" onclick="toggleAddDiv()">Add New Candidate</button>
                    <br><br>
                    <p>Admin Operation : Adding new candidate to the list.</p>
                </div>
                <div class="col col-sm-4 align-self-center">
                    <button class="btn btn-warning" onclick="toggleCountDiv()" >View Voting Counts</button>
                    <br><br>
                    <p>Check the number of votes for individual candidates</p>
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
            	<div id="add" style="display: none;"  class="table-wrapper-scroll-y my-custom-scrollbar">
				<table class="table table-striped mb-0">
                    <form name="addForm" action="dbScripts/dbAddCandidate.php" onsubmit="return validateForm()" method="post">
                                <tr><td><label for="name" class="row-md-3 row-form-label">New Candidate Name </label> : </td><td>
                                    <input type="name" name="name" class="form-control" id="name" placeholder="New candidate name"> </td></tr>
                                <tr><td><label for="loc" class="row-md-3 col-form-label">Location </label> :</td><td>
                                    <input type="loc" name="loc" class="form-control" id="loc" placeholder="Candidate's location"> </td></tr>
                                <tr><td></td><td><button type="reset" class="btn btn-warning btn-sm">Reset</button>
                                <button type="submit" value="submit" id="submit" class="btn btn-primary btn-sm">Add New Candidate !!</button> </td></tr>
							
                    </form>
					</table>
                </div>
        </div>
		<div class="row">
            	<div id="count" style="display: none;" class="table-wrapper-scroll-y my-custom-scrollbar">
                    	<?php
                    		require("dbScripts/dbGetCountOfVotes.php");
                    	?>
                </div>
        </div>
    </div>
    </div>
        <br><br>

    <script type="text/javascript">
	function toggleViewDiv() {
		var y = document.getElementById("count");
		if (y.style.display === "block") {
			y.style.display = "none";
		}
		
		var z = document.getElementById("add");
		if (z.style.display === "block") {
			z.style.display = "none";
		}

		var x = document.getElementById("view");
		if (x.style.display === "none") {
			x.style.display = "block";
		}
		else {
	    	x.style.display = "none";
		}
	}
	
	function toggleAddDiv() {
		var y = document.getElementById("count");
		if (y.style.display === "block") {
			y.style.display = "none";
		}

		var x = document.getElementById("view");
		if (x.style.display === "block") {
			x.style.display = "none";
		}
		
		var z = document.getElementById("add");
		if (z.style.display === "none") {
			z.style.display = "block";
		}
		else {
	    	z.style.display = "none";
		}
	}

	function toggleCountDiv() {
		var x = document.getElementById("view");
		if (x.style.display === "block") {
			x.style.display = "none";
		}
		
		var z = document.getElementById("add");
		if (z.style.display === "block") {
			z.style.display = "none";
		}

		var y = document.getElementById("count");
		if (y.style.display === "none") {
			y.style.display = "block";
		}
		else {
	    	y.style.display = "none";
		}
	}
	
    function validateForm() {
        if (document.forms["addForm"]["name"].value == "") {
            alert("Please enter name of the candidate");
            return false;
        }
        else if (document.forms["addForm"]["loc"].value == "") {
            alert("Please enter Location");
            return false;
        }
        else return true;
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