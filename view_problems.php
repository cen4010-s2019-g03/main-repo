<?php
$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
if(isset($_GET['dateReported']) and isset($_GET['reportedBy']) and isset($_GET['location']) and isset($_GET['description'])){
	$result = $conn->query("SELECT * FROM `Issues` JOIN `Students` ON `Issues`.`reported_by` = `Students`.`znum` WHERE `date_time_reported` >= '" . (empty($_GET['dateReported']) ? '1000-01-01' : $_GET['dateReported']) . "' AND `date_time_reported` < '" . (empty($_GET['dateReported']) ? '9999-12-31' : date('Y-m-d', strtotime('+1 day', strtotime($_GET['dateReported'])))) . "' AND CONCAT(UPPER(`last`), ', ',UPPER(`first`)) LIKE '%" . strtoupper($_GET['reportedBy']) . "%' AND UPPER(`title`) LIKE '%" . strtoupper($_GET['description']) . "%' AND UPPER(`location`) LIKE '%" . strtoupper($_GET['location']) . "%' ORDER BY `date_time_reported` ASC");
}
else{
	$result = $conn->query("SELECT * FROM `Issues` JOIN `Students` ON `Issues`.`reported_by` = `Students`.`znum` ORDER BY `date_time_reported` ASC");
}
$conn->close();
?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<!-- Site CSS -->
		<link rel="stylesheet" href="campusLive.css">
		
		<title>campusLive</title>
	</head>
	<body>
		<h1>View Reported Problems</h1>
		<div class="text-left ml-3 mb-2">
			<a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go Back</button></a>
		</div>
		<div class="col-sm-12">
			<form action="view_problems.php" class="border" id="viewProblemsForm" method="GET">
				<div class="row m-2">
					<div class="col-md-5 form-group order-md-1">
						<label for="dateReported">Date reported</label>
						<input type="date" class="form-control" name="dateReported" id="dateReported">
					</div>
					<div class="col-md-5 form-group order-md-2">
						<label for="reportedBy">Reported by</label>
						<input type="text" class="form-control" name="reportedBy" id="reportedBy">
					</div>
					
					<div class="col-md-5 form-group order-md-4">
						<label for="location">Location</label>
						<input type="text" class="form-control" name="location" id="location">
					</div>
					<div class="col-md-5 form-group order-md-5">
						<label for="description">Description/Keyword</label>
						<input type="text" class="form-control" name="description" id="description">
					</div>
					<div class="col-md-2 form-group order-md-3">
						<label class="d-sm-none d-md-block">&nbsp;</label>
						<button type="reset" class="btn btn-secondary btn-block">Clear</button>
					</div>
					<div class="col-md-2 form-group order-md-6">
						<label class="d-sm-none d-md-block">&nbsp;</label>
						<button type="submit" class="btn btn-primary btn-block">Filter</button>
					</div>
				</div>
			</form>
			<table class="table mt-2">
				<thead>
					<tr>
						<th scope="col">Title</th>
						<th scope="col">Date/Time Reported</th>
						<th scope="col">Location</th>
						<th scope="col">Reported By</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo('<tr><td>' . $row['title'] . '</td><td>' . $row['date_time_reported'] . '</td><td>' . $row['location'] . '</td><td>' . $row['last'] . ', ' . $row['first'] . '</td></tr>');
						}
					} else {
						echo('<tr><td colspan="4">No data to display.</td></tr>');
					}
					?>
				</tbody>
			</table>
		</div>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/745dd24e30.js"></script>
	</body>
</html>