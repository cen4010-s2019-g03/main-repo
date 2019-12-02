<?php
require('session_info.php');
$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
$result = $conn->query("SELECT * FROM `Events` JOIN `Users` ON `Events`.`created_by` = `Users`.`znum` ORDER BY `event_date` ASC, `event_time` ASC");
$conn->close();
?>
<!doctype html>
<html lang="en">
	<head>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153631369-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153631369-1');
</script>

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
		<?php include('header.php'); ?>
		<h1>Upcoming Events</h1>
		<div class="text-left ml-3 mb-2">
			<a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go Back</button></a>
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
			<table class="table mt-2">
				<thead>
					<tr>
						<th scope="col">Event Name</th>
						<th scope="col">Location</th>
						<th scope="col">Date and Time</th>
						<th scope="col">Hosted By</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo('<tr><td><a href="event_detail.php?id=' . $row['event_id'] . '">' . $row['event_name'] . '</a></td><td>' . $row['event_location'] . '</td><td>' . date('m/d/Y', strtotime($row['event_date'])) . ' ' . date('g:i A', strtotime($row['event_time'])) . '</td><td>' . $row['first'] . ' ' . $row['last'] . '</td></tr>');
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
