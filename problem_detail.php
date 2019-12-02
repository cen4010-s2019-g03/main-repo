<?php
require('session_info.php');
$conn = new mysqli('localhost','cen4010fal19_g03','h4sRH3MC+n','cen4010fal19_g03');
$result = $conn->query("SELECT `entry_id`, `first`, `last`, `date_time_reported`, `reported_by`, `title`, `location`, `description`, `type`, `priority`, `Issue_Statuses`.`status`, `photo_file_name` FROM `Issues` JOIN `Users` ON `Issues`.`reported_by` = `Users`.`znum` JOIN `Issue_Statuses` ON `Issues`.`status` = `Issue_Statuses`.`status_id` WHERE `entry_id` = " . $_GET['id']);
if ($result->num_rows == 1) {
	while($row = $result->fetch_assoc()) {
		$entry_id = $row['entry_id'];
		$reported_by_fname = $row['first'];
		$reported_by_lname = $row['last'];
		$reported_by_znum = $row['reported_by'];
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
$result = $conn->query("SELECT `Comment_ID`, `first`, `last`, `Issue_Comments`.`Insert_Date_Time`, `Comment_Text`, `photo_file_name` FROM `Issue_Comments` JOIN `Users` ON `Issue_Comments`.`Created_By` = `Users`.`znum` WHERE `Issue_ID` = " . $_GET['id']);
if ($result->num_rows >= 1) {
	$comments = array();
	while($row = $result->fetch_assoc()) {
		$comment = array($row['Comment_ID'], $row['first'], $row['last'], $row['Insert_Date_Time'], $row['Comment_Text'], $row['photo_file_name']);
		array_push($comments, $comment);
	}
}
$result = $conn->query("SELECT * FROM `Users`");
if ($result->num_rows >= 1) {
	$users = array();
	while($row = $result->fetch_assoc()) {
		$user = array($row['znum'], $row['first'], $row['last']);
		array_push($users, $user);
	}
}
$result = $conn->query("SELECT * FROM `Issue_Statuses`");
if ($result->num_rows >= 1) {
	$statuses = array();
	while($row = $result->fetch_assoc()) {
		$status1 = array($row['status_id'], $row['status']);
		array_push($statuses, $status1);
	}
}
$result = $conn->query("SELECT * FROM `History` WHERE `rec_type` = 'Issue' AND `foreign_id` = " . $_GET['id'] . " ORDER BY `insert_date_time` desc, `hist_id` asc");
if ($result->num_rows >= 1) {
	$histories = array();
	while($row = $result->fetch_assoc()) {
		$history = array($row['description'], $row['insert_date_time']);
		array_push($histories, $history);
	}
}
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
		<h1>Problem Detail</h1>
		<div class="text-left ml-3 mb-2">
			<a href="view_problems.php"><button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> All Problems</button></a>

			<a href="#"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</button></a>
			
			<a href="#"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#issueHistoryModal"><i class="fas fa-history"></i> View History</button></a>
		</div>
		<?php
		if(isset($_SESSION['alerts'])){
			foreach($_SESSION['alerts'] as $alert){
				echo('<div class="alert alert-' . $alert[0] . '">' . $alert[1] . '</div>');
			}
			unset($_SESSION['alerts']);
		}
		?>
		<div class="row">
			<div class="col-md-1 col-sm-2">
				<p>
				<strong>ID #</strong><br />
				<?php echo($entry_id); ?>
				</p>
			</div>
			<div class="col-md-2 col-sm-5">
				<p>
				<strong>Title</strong><br />
				<?php echo($title); ?>
				</p>
			</div>
			<div class="col-md-2 col-sm-5">
				<p>
				<strong>Location</strong><br />
				<?php echo($location); ?>
				</p>
			</div>
			<div class="col-md-2 col-sm-4">
				<p>
				<strong>Date Reported</strong><br />
				<?php echo($date_time_reported); ?>
				</p>
			</div>
			<div class="col-md-2 col-sm-4">
				<p>
				<strong>Reported By</strong><br />
				<?php echo($reported_by_lname . ', ' . $reported_by_fname); ?>
				</p>
			</div>
			<div class="col-md-1 col-sm-2">
				<p>
				<strong>Priority</strong><br />
				<?php
				if($priority == 1) {
					echo('High');
				} else if($priority == 3){
					echo('Low');
				} else {
					echo('Medium');
				}
				?>
				</p>
			</div>
			<div class="col-md-2 col-sm-2">
				<p>
				<strong>Status</strong><br />
				<?php echo($status); ?>
				</p>
			</div>
		</div>
		<div class="col-sm-12">
			<p>
			<strong>Description</strong><br />
			<?php echo($description); ?>
			</p>
		</div>		
		<?php
		if($photo_file_name != null) {
			echo('<div class="col-sm-12">');
			echo('<p>');
			echo('<strong>Photo</strong><br />');
			echo('<img class="img-fluid border rounded" src="photos/' . $photo_file_name . '" />');
			echo('</p>');
			echo('</div>');
		}
		?>
		<div class="col-sm-12">
			<p>
			<strong>Comments</strong><br />
			<?php
			if(isset($comments) and count($comments) > 0){
				foreach($comments as $comment){
					echo($comment[1] . ' ' . $comment[2] . ', ' . $comment[3] . ':<br />' . $comment[4] . '<br />');
					if($comment[5] != null) {
						echo('<img class="img-fluid border rounded" src="photos/' . $comment[5] . '" /><br />');
					}
				}
			}
			else {
				echo('<div class="alert alert-primary" role="alert">No comments have been added to this campus problem.</div>');
			}
			?>
			</p>
			<form action="db_process/add_problem_comment.php" id="addProblemCommentForm" method="POST" enctype = "multipart/form-data">
				<input type="hidden" name="problemID" id="problemID" value="<?php echo($_GET['id']); ?>" />
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group border p-2">
							<label for="comment">Add Comment</label>
							<textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group border p-2">
							<label for="uploadPhoto">Add Photo</label>
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
				<button type="reset" class="btn btn-secondary">Clear Form</button>
				<button type="submit" class="btn btn-primary">Save Comment</button>
			</form>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editModalLabel">Edit Campus Problem</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="db_process/update_problem.php" id="updateProblemsForm" method="POST" enctype = "multipart/form-data">
						<div class="modal-body">
							<input type="hidden" name="problemID" id="problemID" value="<?php echo($_GET['id']); ?>" />
							<div class="form-group">
								<label class="float-left" for="title">Title</label>
								<input type="text" class="form-control" name="title" id="title" value="<?php echo($title); ?>">
							</div>
							<div class="form-group">
								<label class="float-left" for="location">Location</label>
								<input type="text" class="form-control" name="location" id="location" value="<?php echo($location); ?>">
							</div>
							<div class="form-group">
								<label class="float-left" for="reportedBy">Reported by</label>
								<select class="form-control" name="reportedBy" id="reportedBy">
									<?php
									foreach($users as $user){
										echo('<option value="' . $user[0] . '"');
										if($reported_by_znum == $user[0]) echo(' selected');
										echo('>' . $user[2] . ', ' . $user[1] . '</option>');
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label class="float-left" for="priority">Priority</label>
								<select class="form-control" name="priority" id="priority">
									<option value="1"<?php if($priority == 1) echo(' selected'); ?>>High</option>
									<option value="2"<?php if($priority == 2) echo(' selected'); ?>>Medium</option>
									<option value="3"<?php if($priority == 3) echo(' selected'); ?>>Low</option>
								</select>
							</div>
							<div class="form-group">
								<label class="float-left" for="status">Status</label>
								<select class="form-control" name="status" id="status">
									<?php
									foreach($statuses as $status1){
										echo('<option value="' . $status1[0] . '"');
										if($status == $status1[1]) echo(' selected');
										echo('>' . $status1[1] . '</option>');
									}
									?>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="issueHistoryModal" tabindex="-1" role="dialog" aria-labelledby="issueHistoryModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="issueHistoryModalLabel">Campus Problem History</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php
						if(isset($histories) and count($histories) > 0) {
							foreach($histories as $history) {
								echo('<small>' . date('m/d/Y g:i A', strtotime($history[1])) . ':<br />' . $history[0] . '</small><hr />');
							}
						} else {
							echo('No history exists for this campus problem.');
						}
						?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/745dd24e30.js"></script>
	</body>
</html> 
