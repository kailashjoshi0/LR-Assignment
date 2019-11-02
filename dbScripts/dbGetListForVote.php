<?php

require_once("dbConnector.php");
require_once("dbCheckStatus.php");
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		$sql = "SELECT candidate_id, candidate_name from candidates";
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt)) {
			 mysqli_stmt_bind_result($stmt, $candidate_id, $candidate_name);
             echo '<table class="table table-striped">';
             echo '<thead><tr>
             		<th>Candidate ID</th><th>Candidate Name</th><th></th>
             	   </tr></thead>';
             echo '<tbody>';
             $status=checkUserStatus();
             if($status == "disabled") {
             	echo '<div class="alert alert-warning alert-dismissible">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Thank you!</strong> You have already voted.
					  </div>';
             }
             while (mysqli_stmt_fetch($stmt)) {
             echo '<tr width="100%"><td>'.$candidate_id.'</td><td>'.$candidate_name.'</td><td><form method="post" action="dbScripts/dbSubmitVote.php">
             <button name="submitbtn" value="'.$candidate_id.'" class="btn btn-warning" '.$status.'>Vote !!</button></form></td></tr>';
             }
             echo "</tbody></table>";
             
		}
}

?>