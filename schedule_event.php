<?php
session_start();
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
		<h1>Schedule an Event</h1>
		<div class="text-left ml-3 mb-2">
			<a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go Back</button></a>
		</div>
		<div class="container-fluid">
			<?php
			if(isset($_SESSION['alerts'])){
				foreach($_SESSION['alerts'] as $alert){
					echo('<div class="alert alert-' . $alert[0] . '">' . $alert[1] . '</div>');
				}
				unset($_SESSION['alerts']);
			}
			?>
			<form action="db_process/new_event.php" id="viewProblemsForm" method="POST">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group border p-2">
							<div class="row">
								<div class="col-md-6">
									<label for="date">Date</label>
									<input type="date" class="form-control" name="date" id="date">
								</div>
								<div class="col-md-6">
									<label for="hour">Time</label>
									<div class="row">
										<div class="col-4">
											<select class="form-control" name="hour" id="hour">
												<option selected disabled></option>
												<option value="12">12</option>
												<option value="1">01</option>
												<option value="2">02</option>
												<option value="3">03</option>
												<option value="4">04</option>
												<option value="5">05</option>
												<option value="6">06</option>
												<option value="7">07</option>
												<option value="8">08</option>
												<option value="9">09</option>
												<option value="10">10</option>
												<option value="11">11</option>

											</select>
										</div>
										<div class="col-4">
											<select class="form-control" name="minute" id="minute">
												<option selected disabled></option>
												<option value="00">00</option>
												<option value="05">05</option>
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
												<option value="25">25</option>
												<option value="30">30</option>
												<option value="35">35</option>
												<option value="40">40</option>
												<option value="45">45</option>
												<option value="50">50</option>
												<option value="55">55</option>
											</select>
										</div>
										<div class="col-4">
											<select class="form-control" name="AM_PM" id="AM_PM">
												<option selected disabled></option>
												<option value="AM">AM</option>
												<option value="PM">PM</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group border p-2">
							<label for="location">Location</label>
							<input type="text" class="form-control" name="location" id="location">
						</div>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group border p-2">
							<label for="title">Title</label>
							<input type="text" class="form-control" name="title" id="title">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group border p-2">
							<label for="description">Description</label>
							<textarea class="form-control" name="description" id="description" rows="5"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group border p-2">
							<label for="uploadPhoto">Upload a Photo</label>
							<div class="row">
								<div class="col-md-9">
									<input type="file" class="form-control-file" name="uploadPhoto" id="uploadPhoto" accept="image/*" disabled>
								</div>
								<div class="col-md-3">
									<button type="button" class="btn btn-danger float-md-right" onclick="document.getElementById('uploadPhoto').value = '';" disabled>Remove</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<a href="dashboard.php"><button type="button" class="btn btn-secondary mb-2">Cancel</button></a>
				<button type="submit" class="btn btn-primary mb-2">Submit</button>
			</form>
		</div>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/745dd24e30.js"></script>
	</body>
</html> 