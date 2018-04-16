	<!DOCTYPE HTML>
	<html>
		<head>
			<title>Student Application</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<link rel="stylesheet" type="text/css" href="newApplication.css">
			<script type="text/javascript" src="app.js"></script>
		</head>
		<body>
			<form action="$_SERVER[PHP_SELF]" method="post">
			<div class="col-xs-4">
				<h3>Contact Information</h3>
				<div class="form-group">
						<label for="last-name">Last Name</label>
						<input type="text" class="form-control" name="last-name" id="last-name" required>
						<label for="first-name">First Name</label>
						<input type="text" class="form-control" name="first-name" id="first-name" required>
						<label for="middle-initial">Middle Initial</label>
						<input type="text" class="form-control" name="middle-initial" id="middle-initial">
						<label for="email">Email Address</label>
						<input type="email" class="form-control" name="email" id="email" required>
						<label for="phone">Phone Number</label>
						<input type="tel" class="form-control" name="phone" id="phone" required>
				</div>
				<h3>Student Information</h3>
				<div class="form-group" id="student-info">
						<label for="directory-id">Directory ID</label>
						<input type="text" class="form-control" name="directory-id" id="directory-id" required>
						<label for="uid">University ID</label>
						<input type="number" class="form-control" name="uid" id="uid" required>
						<label for="transcript">Upload Transcript</label>
						<input type="file" class="form-control-file" name="transcript" accept="application/pdf" value="Upload Transcript" id="transcript">
					<div class="radio" id="standing">
						<fieldset>
							<legend>Education Level</legend>
							<label><input type="radio" name="edu-level" required>Bachelors Student</label>
							<label><input type="radio" name="edu-level">Masters Student</label>
							<label><input type="radio" name="edu-level">Ph.D Student</label>
						</fieldset>
					</div>
					<label for="department">Department</label>
					<input type="text" class="form-control" name="department" id="department" value="Computer Science">
					<label for="advisor">Advisor</label>
					<input type="text" class="form-control" name="advisor" id="advisor">
					<div class="container">
						<a href="#table-exp" class="btn btn-info" data-toggle="collapse">Click to Enter Experience</a>
						<div id="table-exp" class="collapse">
							<table class="table" id="exp-table">
								<thead>
									<tr>
										<th>Course</th>
										<th>Have you been a TA for this class in past?</th>
										<th>Are you currently a TA for this class?</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>CMSC131</td>
										<td><input type="checkbox" name="CMSC131-past"></td>
										<td><input type="checkbox" name="CMSC131-current"></td>
									</tr>
									<tr>
										<td>CMSC132</td>
										<td><input type="checkbox" name="CMSC132-past"></td>
										<td><input type="checkbox" name="CMSC132-current"></td>
									</tr>
									<tr>
										<td>CMSC216</td>
										<td><input type="checkbox" name="CMSC216-past"></td>
										<td><input type="checkbox" name="CMSC216-current"></td>
									</tr>
										<tr>
										<td>CMSC250</td>
										<td><input type="checkbox" name="CMSC250-past"></td>
										<td><input type="checkbox" name="CMSC250-current"></td>
									</tr>
									<tr>
										<td>CMSC330</td>
										<td><input type="checkbox" name="CMSC330-past"></td>
										<td><input type="checkbox" name="CMSC330-current"></td>
									</tr>
									<tr>
										<td>CMSC351</td>
										<td><input type="checkbox" name="CMSC351-past"></td>
										<td><input type="checkbox" name="CMSC351-current"></td>
									</tr>
									<tr>
										<td><button type="button" class="btn btn-default" aria-label="Left Align" onclick="addClass(this.parentNode.parentNode.parentNode.parentNode);">
  												<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<h3>For Non-US Students Only</h3>
				<div class="radio">
					<fieldset>
						<legend>Have you passed the Maryland English Institute?</legend>
						<label><input type="radio" name="mei-ans">Yes</label>
						<label><input type="radio" name="mei-ans">No</label>
					</fieldset>
					<div class="radio">
						<fieldset>
							<legend>Are you currently taking a UMEI course?</legend>
							<label><input type="radio" name="umei-ans">Yes</label>
							<label><input type="radio" name="umei-ans">No</label>
						<fieldset>
					</div>
				</div>
				
			</div>
			</form>
		</body>
	</html>