<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Kevin Lewitzke</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans|Roboto:100,300,400,500,700,900,100i,300i,400i,500i,700i,900i">
		<link rel="stylesheet" href="stylesheet.css">
	</head>
	<body>
		<div class="container">
			<button class="btn btn-primary mt-2 mb-2" id="back-button"><i class="fas fa-arrow-left"></i> Go Back</button>
			<h1>Kevin Lewitzke</h1>
			<hr />
			<img src="assets/kl_pic_1.jpg" class="float-left mr-2 rounded-0 img-thumbnail" width="200" height="200" />
			<p>Kevin works full-time as a Systems Accountant at Florida's Turnpike Enterprise. He is currently pursuing a Bachelor's of Science Degree in Computer Science from Florida Atlantic University. He has an Associate in Science Degree in Computer Programming and Analysis from Valencia College.</p>
			<p>He has extensive experience working with databases, and writing complex queries for business analytic purposes. He has experience programming in PHP, SQL, HTML5, Java, and C++.</p>
			<p>He also has a Bachelor's of Science Degree in Hospitality Management. He spent nearly 10 years working in the theme park industry, before returning to school in 2013 to pursue a career change.</p>
			<div class="text-center">
			<h6><b>View Kevin's Profiles</b></h6>
			<a href="https://github.com/klewitzke" class="btn btn-primary"><i class="fab fa-github"></i> GitHub</a>
			<a href="https://devpost.com/klewitzke" class="btn btn-primary"><i class="fas fa-code"></i> Devpost</a>
			</div>
		</div>
		<script	src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/745dd24e30.js"></script>
		<script>
		$(document).ready(function(){
			$('#back-button').on('click', function(e){
				e.preventDefault();
				window.history.back();
			});
		});
		</script>
	</body>
</html>