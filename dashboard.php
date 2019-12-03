<?php
require('session_info.php');
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
		
		<title>CampusLive</title>
	</head>

	<body>
		<?php include('header.php'); ?>
		<h1>CampusLive Dashboard</h1>
		<?php
		if(isset($_SESSION['alerts'])){
			foreach($_SESSION['alerts'] as $alert){
				echo('<div class="alert alert-' . $alert[0] . '">' . $alert[1] . '</div>');
			}
			unset($_SESSION['alerts']);
		}
		?>
		<div class="col-sm-6 offset-sm-3">
			<div class="container">
				<div class="row">
					<div class="col-sm border">
						<h3>Campus Problems</h3>
						<p><a href="report_problem.php">Report a Campus Problem</a></p>
						<p><a href="view_problems.php">View Reported Problems</a></p>
					</div>
					<div class="col-sm border">
						<h3>Campus Events</h3>
						<p><a href="upcoming_events.php">View Campus Events</a></p>
						<p><a href="schedule_event.php">Add Event</a></p>
					</div>
				</div>
			</div>
		</div>
		<br />
		<h5>System Reports</h5>
		<a href="TCPDF/reports/maintenance_summary_report.php" target="_blank">Maintenance Summary Report <i class="fas fa-file-pdf"></i></a> 
		
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/745dd24e30.js"></script>
	</body>
</html>
 
