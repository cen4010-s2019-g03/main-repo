<?php
session_start();
$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
$result = $conn->query("SELECT * FROM `Issues` JOIN `Users` ON `Issues`.`reported_by` = `Users`.`znum` WHERE `entry_id` = " . $_GET['id']);
if ($result->num_rows == 1) {
	while($row = $result->fetch_assoc()) {
		$reported_by_fname = $row['first'];
		$reported_by_lname = $row['last'];
		$date_time_reported = $row['date_time_reported'];
		$title = $row['title'];
		$location = $row['location'];
		$description = $row['description'];
		$type = $row['type'];
		$priority = $row['priority'];
		$status = $row['status'];
		$photo_file_name = $row['photo_file_name'];
	}
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
		<h1>Problem Detail</h1>
		<div class="text-left ml-3 mb-2">
			<a href="view_problems.php"><button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> All Problems</button></a>
		</div>
		<div class="col-sm-12">
			<?php
			if(isset($_SESSION['alerts'])){
				foreach($_SESSION['alerts'] as $alert){
					echo('<div class="alert alert-' . $alert[0] . '">' . $alert[1] . '</div>');
				}
				unset($_SESSION['alerts']);
			}
			?>
			<p>
			<strong>Date Reported:</strong> <?php echo($date_time_reported); ?><br />
			<strong>Reported By:</strong> <?php echo($reported_by_lname . ', ' . $reported_by_fname); ?><br />
			</p>
			<p>
			<strong>Description:</strong>
			</p>
			<p>
			<?php echo($title); ?>
			</p>
			<p>
			<strong>Photo:</strong>
			</p>
			<p>
			<?php
			if($photo_file_name == null) {
				echo('<span class="text-danger">No photo was uploaded.</span>');
			}
			?>
			</p>
		</div>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/745dd24e30.js"></script>
	</body>
</html>