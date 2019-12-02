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
		
		<title>campusLive</title>
	</head>
	<body>
		<?php include('header.php'); ?>
		<h1>Report a Campus Problem</h1>
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
			
		
			<form action="db_process/new_problem.php" id="viewProblemsForm" method="POST" enctype = "multipart/form-data">
				<div class="row">
					<div class="col-lg-5 col-sm-4">
						<div class="form-group border p-2">
							<label for="title">Title</label>
							<input type="text" class="form-control" name="title" id="title">
						</div>
					</div>
					<div class="col-lg-5 col-sm-4">
						<div class="form-group border p-2">
							<label for="location">Location</label>
							<input type="text" class="form-control" name="location" id="location">
						</div>
					</div>
					<div class="col-lg-2 col-sm-4">
						<div class="form-group border p-2">
							<label for="priority">Priority</label>
							<select class="form-control" name="priority" id="priority">
								<option value="1">High</option>
								<option value="2" selected>Medium</option>
								<option value="3">Low</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group border p-2">
							<label for="description">Description</label>
							<textarea class="form-control" name="description" id="description" rows="5"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group border p-2">
							<label for="uploadPhoto">Upload a Photo</label>
							<div class="row">
								<div class="col-md-9">
									<input type="file" class="form-control-file" name="uploadPhoto" id="uploadPhoto" accept="image/*" >
								</div>
								<div class="col-md-3">
									<button type="button" class="btn btn-danger float-md-right" onclick="document.getElementById('uploadPhoto').value = '';" disabled>Remove</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<a href="dashboard.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/745dd24e30.js"></script>
	</body>
</html> 
