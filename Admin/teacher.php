<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
		$_SESSION['LoginTeacher']="";
	?>
<!---------------- Session Ends form here ------------------------>

<!--*********************** PHP code starts from here for data insertion into database ******************************* -->
<?php  
 	if (isset($_POST['btn_save'])) {

 		$first_name=$_POST["first_name"];

 		$middle_name=$_POST["middle_name"];

 		$last_name=$_POST["last_name"];
 		
 		$email=$_POST["email"];
 		
 		$phone_no=$_POST["phone_no"];
 		
 		$teacher_status=$_POST["teacher_status"];
 		
 		$application_status=$_POST["application_status"];
 		
 		$cnic=$_POST["cnic"];
 		
 		$dob=$_POST["dob"];
 		
 		$other_phone=$_POST["other_phone"];
 		
 		$gender=$_POST["gender"];
 		
		$permanent_address=$_POST["permanent_address"];
 		
 		$current_address=$_POST["current_address"];
 		
 		$place_of_birth=$_POST["place_of_birth"];
 		
 		$matric_complition_date=$_POST["matric_complition_date"];
 		
 		$matric_awarded_date=$_POST["matric_awarded_date"];
 		
 		$fa_complition_date=$_POST["fa_complition_date"];
 		
 		$fa_awarded_date=$_POST["fa_awarded_date"];
 		
 		$ba_complition_date=$_POST["ba_complition_date"];
 		
 		$ba_awarded_date=$_POST["ba_awarded_date"];

 		$ma_complition_date=$_POST["ma_complition_date"];
 		
 		$ma_awarded_date=$_POST["ma_awarded_date"];

		//$teacher_info_id=$_POST["teacher_info_id"];

 		$date=date("d-m-y");

 		$password=$_POST['password'];

 		$role=$_POST['role'];

		
// *****************************************Images upload code starts here********************************************************** 
 		$profile_image = $_FILES['profile_image']['name'];$tmp_name=$_FILES['profile_image']['tmp_name'];$path = "images/".$profile_image;move_uploaded_file($tmp_name, $path);

		$matric_certificate = $_FILES['matric_certificate']['name'];$tmp_name=$_FILES['matric_certificate']['tmp_name'];$path = "images/".$matric_certificate;move_uploaded_file($tmp_name, $path);

		$fa_certificate = $_FILES['fa_certificate']['name'];$tmp_name=$_FILES['fa_certificate']['tmp_name'];$path = "images/".$fa_certificate;move_uploaded_file($tmp_name, $path);

		$ba_certificate = $_FILES['ba_certificate']['name'];$tmp_name=$_FILES['ba_certificate']['tmp_name'];$path = "images/".$ba_certificate;move_uploaded_file($tmp_name, $path);

		$ma_certificate = $_FILES['ma_certificate']['name'];$tmp_name=$_FILES['ma_certificate']['tmp_name'];$path = "images/".$ma_certificate;move_uploaded_file($tmp_name, $path);

// *****************************************Images upload code end here********************************************************** 


 		$query="Insert into teacher_info(first_name,middle_name,last_name,email,phone_no,profile_image,teacher_status,application_status,cnic,dob,other_phone,gender,permanent_address,current_address,place_of_birth,matric_complition_date,matric_awarded_date,matric_certificate,fa_complition_date,fa_awarded_date,fa_certificate,ba_complition_date,ba_awarded_date,ba_certificate,ma_complition_date,ma_awarded_date,ma_certificate,hire_date)values('$first_name','$middle_name','$last_name','$email','$phone_no','$profile_image','$teacher_status','$application_status','$cnic','$dob','$other_phone','$gender','$permanent_address','$current_address','$place_of_birth','$matric_complition_date','$matric_awarded_date','$matric_certificate','$fa_complition_date','$fa_awarded_date','$fa_certificate','$ba_complition_date','$ba_awarded_date','$ba_certificate','$ma_complition_date','$ma_awarded_date','$ma_certificate','$date')";
 		$run=mysqli_query($con, $query);
		$teacher_info_id;
 		if ($run) {
 			echo "Your Data has been submitted";
			 $teacher_info_id = mysqli_insert_id($con);

			//  iNSERT TO TEACHER_LOGIN
			$query2="insert into teacher_login(teacher_info_id,user_id,Password,Role)values('$teacher_info_id','$email','$password','$role')";
			$run2=mysqli_query($con, $query2);
			if ($run2) {
				echo "Your Data has been submitted into login";
			}
			else {
				echo "Your Data has not been submitted into login";
			}
 		}
 		else {
 			echo "Your Data has not been submitted";
 		}
 		
 	}
?>


<?php  
	if (isset($_POST['btn_save2'])) {
		$course_code = $_POST['course_code'];

		$semester = $_POST['semester'];

		$teacher_id = $_POST['teacher_id'];

		$subject_code = $_POST['subject_code'];

		$subject_name = $_POST['subject_name'];

		$total_classes = $_POST['total_classes'];

		$year_and_section = $_POST['year_and_section'];

		$units = $_POST['units'];

		$time = $_POST['time'];

		$day = $_POST['day'];
		
		$room_no = $_POST['room_no'];

		$date = date("d-m-y");

		$query3="insert ignore into teacher_courses (course_code, units, day, time, room_no, semester, teacher_id, subject_code, subject_name, assign_date, total_classes, sec_id) values ('$course_code', '$units', '$day', '$time', '$room_no', '$semester', '$teacher_id', '$subject_code', '$subject_name', '$date', '$total_classes', '$year_and_section')";
		$run3=mysqli_query($con,$query3);
		
		if ($run3) {
 			echo "Your Data has been submitted";
			header("Refresh:0");
 		}
 		else {
 			echo "Your Data has not been submitted";
 		}


	}
?>
<!--*********************** PHP code end from here for data insertion into database ******************************* -->
 

<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Register Teacher</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">Teacher Management System </h4>
						<button type="button" class="btn btn-primary ml-5" data-toggle="modal" data-target=".bd-example-modal-lg">Add Teacher</button>
					</div>
				</div>
				<div class="row w-100">
					<div class=" col-lg-6 col-md-6 col-sm-12 mt-1 ">
						<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-info text-white">
										<h4 class="modal-title text-center">Add New Teacher</h4>
									</div>
									<div class="modal-body">
										<form action="teacher.php" method="post" enctype="multipart/form-data">
											<div class="row mt-3">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">First Name: </label>
														<input type="text" name="first_name" class="form-control" required="" placeholder="First Name">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Middle Name: </label>
														<input type="text" name="middle_name" class="form-control" required="" placeholder="Middle Name">
													</div>
												</div><div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Last Name: </label>
														<input type="text" name="last_name" class="form-control" required="" placeholder="Last Name">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Teacher Email:</label>
														<input type="text" name="email" class="form-control" required="" placeholder="Enter Email">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Mobile No</label>
														<input type="number" name="phone_no" class="form-control"placeholder="Enter Mobile Number">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Select Your Profile </label>
														<input type="file" name="profile_image" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Teacher Status: </label>
														<select class="browser-default custom-select" name="teacher_status">
															<option selected>Select Status</option>
															<option value="Permanent">Permanent</option>
															<option value="Contract">Contract</option>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Application Status:</label>
														<select class="browser-default custom-select" name="application_status">
															<option >Select Status</option>
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">UMID No:</label>
														<input type="text" name="cnic" class="form-control" placeholder="Cnic No">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Date of Birth: </label>
														<input type="date" name="dob" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Other Phone:</label>
														<input type="number" name="other_phone" class="form-control" placeholder="Other Phone No">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Gender:</label>
														<select class="browser-default custom-select" name="gender">
															<option selected>Select Gender</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Permanent Address: </label>
														<input type="text" name="permanent_address" class="form-control" placeholder="Enter Permanent Address">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Current Address:</label>
														<input type="text" name="current_address" class="form-control" placeholder="Enter Current Address">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Place of Birth:</label>
														<input type="text" name="place_of_birth" class="form-control" placeholder="Enter Place of Birth">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Matric/OLevel Complition Date: </label>
														<input type="date" name="matric_complition_date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Matric/OLevel Awarded Date:</label>
														<input type="date" name="matric_awarded_date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Upload Matric/OLevel Certificate:</label>
														<input type="file" name="matric_certificate" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">FA/ALevel Complition Date: </label>
														<input type="date" name="fa_complition_date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">FA/ALevel Awarded Date:</label>
														<input type="date" name="fa_awarded_date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Upload FA/ALevel Certificate:</label>
														<input type="file" name="fa_certificate" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">BA Complition Date: </label>
														<input type="date" name="ba_complition_date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">BA Awarded Date:</label>
														<input type="date" name="ba_awarded_date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Upload BA Certificate:</label>
														<input type="file" name="ba_certificate" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">MA Complition Date: </label>
														<input type="date" name="ma_complition_date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">MA Awarded Date:</label>
														<input type="date" name="ma_awarded_date" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="formp">
														<label for="exampleInputPassword1">Upload MA Certificate:</label>
														<input type="file" name="ma_certificate" class="form-control">
													</div>
												</div>
											</div>
											<!-- _________________________________________________________________________________
																				Hidden Values are here
											_________________________________________________________________________________ -->
											<div>
												<input type="hidden" name="password" value="teacher123*">
												<input type="hidden" name="role" value="Teacher">
											</div>
											<!-- _________________________________________________________________________________
																				Hidden Values are end here
											_________________________________________________________________________________ -->
											<div class="modal-footer">
												<input type="submit" class="btn btn-primary" name="btn_save" value="Save Data">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row w-100">
					<div class="col-md-12 ml-2">
						<section class="mt-3">
							<div class="row">
								<div class="col-md-3 offset-9 pt-5 mb-2">

									<!-- ASSIGN SUBJECT TO PROFESSOR/TEACHER -->
									
									<!-- Large modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg1">Assign Subjects</button>
									<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header bg-info text-white">
													<h4 class="modal-title text-center">Assign Subjects To Teachers</h4>
												</div>
												<div class="modal-body">
													<form action="teacher.php" method="POST" enctype="multipart/form-data">
														<div class="row mt-3">

															<!-- Select Course -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputEmail1" style="font-weight: bold;">Select Course: <span class="text-danger">*</span></label>
																	<select class="browser-default custom-select" name="course_code" required="">
																		<option >Select Course</option>
																		<?php
																			$query="select distinct(course_code) from courses";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {	

																			$course_code = $row['course_code'];
																
																			echo "<option value='$course_code'>$course_code</option>";

																			// echo "<option value=".$row['course_code'].">".$row['course_code']."</option>";
																			}
																		?>
																	</select>
																</div>
															</div>

															<!-- Select Year -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;">Select Year and Section: <span class="text-danger">*</span></label>
																	<select class="browser-default custom-select" name="year_and_section" required="">
																		<option >Select year and section</option>
																		<?php
																			$query="select * from yr_and_section";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {

																			$yearSec = $row['year_and_section'];
																	
																			echo "<option value='$yearSec'>$yearSec</option>";
																			// echo	"<option value=".$row['year_and_section'].">".$row['year_and_section']."</option>";
																			}
																		?>
																	</select>

																</div>
															</div>
														</div>
														
														<!-- Select Prof -->
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;">Select Professor: <span class="text-danger">*</span></label>
																	<select class="browser-default custom-select" name="teacher_id" required="true">
																		<option >Select professor</option>
																		<?php
																			$query="select teacher_id,first_name,last_name from teacher_info";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {

																			// $yearSec = $row['year_and_section'];
																			// $yearSec = $row['year_and_section'];
																
																			// echo "<option value='$yearSec'>$yearSec</option>";
																			echo "<option value=".$row['teacher_id'].">"."Prof.".$row['first_name']." ".$row['last_name']."</option>";
																			}
																		?>
																	</select>
																</div>
															</div>

															<!-- Select Subject -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;">Please Select Course Code: <span class="text-danger">*</span></label>
																	<select class="browser-default custom-select" name="subject_code" required="">
																		<option >Select Subject Code</option>
																		<?php
																			$query="select subject_code from course_subjects";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {

																			$subjCode = $row['subject_code'];
																		
																			echo "<option value='$subjCode'>$subjCode</option>";
																			// echo "<input type='text' value='$subjCode'></input>";
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>

														<!-- Select Classes & Semester -->
														<div class="row">
															<!-- Select Classes -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;">Enter Total Classes: <span class="text-danger">*</span></label>
																	<input type="text" name="total_classes" class="form-control" required>
																</div>
															</div>

															<!-- Select Semester -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;" required>Enter Semester: <span class="text-danger">*</span></label>
																	<select name="semester" id="" class="browser-default custom-select">
																		<option value="1st Semester">1st Semester</option>
																		<option value="2nd Semester">2nd Semester</option>
																	</select>															
																</div>
															</div>
														</div>

														<!-- Selct Course Descripition & Enter Course Unit -->
														<div class="row">
															<!-- Selct Course Descripition -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;">Select Course Description: <span class="text-danger">*</span></label>
																	<select class="browser-default custom-select" name="subject_name" required="true">
																		<option >Select Subject Description</option>
																		<?php
																			$query="select subject_name from course_subjects";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {
																			// echo "<option value='.$row['subject_name'].'>$row['subject_name']</option>";
																			$subject_name = $row['subject_name'];
																		
																			echo "<option value='$subject_name'>$subject_name</option>";
																			}
																		?>
																	</select>
																</div>
															</div>

															<!-- Enter Course Unit  -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;">Enter Course Units: <span class="text-danger">*</span></label>
																	<select name="units" id="" class="browser-default custom-select">
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="5">5</option>
																	</select>	
																</div>
															</div>
														</div>

														<!-- Enter Day and Time -->
														<div class="row">
															<!-- Select Day -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;">Select Day of classes: <span class="text-danger">*</span></label>
																	<!-- <input type="text" name="total_classes" class="form-control" required> -->
																	<select name="day" id="" class="browser-default custom-select">
																		<option value="Monday">Monday</option>
																		<option value="Tuesday">Tuesday</option>
																		<option value="Wednesday">Wednesday</option>
																		<option value="Thursday">Thursday</option>
																		<option value="Friday">Friday</option>
																		<option value="Saturday">Saturday</option>
																		<option value="Sunday">Sunday</option>
																	</select>
																</div>
															</div>

															<!-- Select Time -->
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputPassword1" style="font-weight: bold;"  required>Enter Time of classes: <span class="text-danger">*</span></label>
																	<input type="Text" name="time" class="form-control" placeholder="Ex. 2:00 - 5:00 PM">															
																</div>
															</div>
														</div>

														<!-- Enter Room Number -->
														<div class="col-md-13">
															<div class="form-group">
																<label for="exampleInputPassword1" style="font-weight: bold;">Enter Room Number: <span class="text-danger">*</span></label>
																<input type="text" name="room_no" class="form-control" placeholder="Ex. Computer Laboratory 2" required>
															</div>
														</div>
														
														<div class="modal-footer">
															<input type="submit" class="btn btn-primary" name="btn_save2">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														</div>
													</form>
												</div>
											</div>
									</div>
									</div>
								</div>
							</div>
							<table class="w-100 table-elements mb-5 table-three-tr" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th>Teacher ID</th>
									<th>Teacher Name</th>
									<th>Current Address</th>
									<th>Hire Date</th>
									<th>Email</th>
									<th>Operations</th>
								</tr>
								<?php 
								$query="select teacher_id,first_name,middle_name,last_name,current_address,ma_certificate,hire_date,email from teacher_info";
								$run=mysqli_query($con,$query);
								while($row=mysqli_fetch_array($run)) {
									echo "<tr>";
									echo "<td>".$row["teacher_id"]."</td>";
									echo "<td>".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</td>";
									echo "<td>".$row["current_address"]."</td>";
									echo "<td>".$row["hire_date"]."</td>";
									echo "<td>".$row["email"]."</td>";
									echo	"<td width='170'><a class='btn btn-primary' href=display-teacher.php?teacher_id=".$row['teacher_id'].">Profile</a> <a class='btn btn-danger' href=delete-function.php?teacher_id=".$row['teacher_id'].">Delete</a></td>";
									echo "</tr>";
								}
								?>
							</table>				
						</section>
					</div>
				</div>	 	
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>


