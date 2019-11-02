<?php
	require_once("dbConnector.php");
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true || isset($_SESSION["adminlogin"]) && $_SESSION["adminlogin"] === true) {
		$sql = "SELECT candidate_id, candidate_name, vote_count from candidates order by vote_count desc";
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt)) {
			 mysqli_stmt_bind_result($stmt, $candidate_id, $candidate_name, $candidate_vote_count);
             echo '<table class="table table-bordered table-striped mb-0">';
             echo '<thead><tr>
             		<th>Candidate ID</th><th>Candidate Name</th><th>Candidate Vote Count</th>
             	   </tr></thead>';
             echo '<tbody>';
             while (mysqli_stmt_fetch($stmt)) {
             echo '<tr width="100%"><td>'.$candidate_id.'</td><td>'.$candidate_name.'</td><td>'.$candidate_vote_count.'</td></tr>';
             }
             echo "</tbody></table>";
		}
	}

?>