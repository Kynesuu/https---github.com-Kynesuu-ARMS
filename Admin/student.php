<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/admin-login.php');
	}
		require_once "../connection/connection.php";
		$_SESSION["LoginStudent"]="";
	?>
<!---------------- Session Ends form here ------------------------>


<!--*********************** PHP code starts from here for data insertion into database ******************************* -->
<?php  
 	if (isset($_POST['btn_save'])) {

		$student_id= $_POST["ID"];

 		$first_name=$_POST["first_name"];

 		$middle_name=$_POST["middle_name"];
 		
 		$last_name=$_POST["last_name"];
 		
 		$father_name=$_POST["father_name"];
 		
 		$email=$_POST["email"];
 		
 		$mobile_no=$_POST["mobile_no"];

 		$course_code=$_POST['course_code'];

 		$session=$_POST['session'];
 		
 		$dob=$_POST["dob"];
 		 		
 		$gender=$_POST["gender"];
 		
		$permanent_address=$_POST["permanent_address"];
 		
 		$current_address=$_POST["current_address"];
 		
 		$place_of_birth=$_POST["place_of_birth"];
 		
 		$password=$_POST['password'];

 		$role=$_POST['role'];

 		

// *****************************************Images upload code starts here********************************************************** 
		$profile_image = $_FILES['profile_image']['name'];$tmp_name=$_FILES['profile_image']['tmp_name'];$path = "images/".$profile_image;move_uploaded_file($tmp_name, $path);


// *****************************************Images upload code end here********************************************************** 

 		$query = "Insert into student_info(ID, first_name, middle_name, last_name, father_name, email,mobile_no,course_code,session,profile_image,dob,gender,permanent_address,current_address,place_of_birth) values ('$student_id','$first_name','$middle_name','$last_name','$father_name','$email','$mobile_no','$course_code','$session','$profile_image','$dob','$gender','$permanent_address','$current_address','$place_of_birth')";
			
			$run=mysqli_query($con, $query);
			$student_info_id = mysqli_insert_id($con);
			if ($run) {
				echo "Your Data has been submitted";
				

			//  iNSERT TO STUDENT_LOGIN
			$query2="insert into student_login(student_info_id,user_id,Password,Role)values('$student_info_id','$email','$password','$role')";
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
		$course_code=$_POST['course_code'];

		$semester=$_POST['semester'];

		$student_course_id=$_POST['student_id'];

		$subject_code=$_POST['subject_code'];

		$date=date("d-m-y");

		$query3="insert into student_courses (course_code,semester,student_id,subject_code,assign_date) values ('$course_code','$semester','$student_course_id','$subject_code','$date')";
		$run3=mysqli_query($con,$query3);
		if ($run3) {
 			echo "Your Data has been submitted";
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
		<title>Admin - Register Student</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">Student Management System </h4>
						<button type="button" class="btn btn-primary ml-5" data-toggle="modal" data-target=".bd-example-modal-lg">Add Student</button>
					</div>
				</div>
				<div class="col-md-2 pt-3 w-100">

				<!-- ADD NEW STUDENT -->
  				    <!-- Large modal -->
					<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					   <div class="modal-dialog modal-lg">
						    <div class="modal-content">
							    <div class="modal-header bg-info text-white">
							        <h4 class="modal-title text-center">Add New Student</h4>
						        </div>
							    <div class="modal-body">
							        <form action="student.php" method="POST" enctype="multipart/form-data">
										<div class="row mt-3">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Applicant First Name:*</label>
											        <input type="text" name="first_name" class="form-control" required>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Applicant Middle Name:</label>
												    <input type="text" name="middle_name" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1" required>Applicant Last Name:*</label>
												    <input type="text" name="last_name" class="form-control">
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Father Name:*</label>
											        <input type="text" name="father_name" class="form-control" required>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Student Learning No:</label>
												    <input type="text" name="ID" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Applicant Email:*</label>
												    <input type="email" name="email" class="form-control" pattern="a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|" required>
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Course which you want?: </label>
											        <select class="browser-default custom-select" name="course_code">
													    <option >Select Course</option>
													    <?php
															$query="select course_code from courses";
															$run=mysqli_query($con,$query);
															while($row=mysqli_fetch_array($run)) {
															 echo	"<option value=".$row['course_code'].">".$row['course_code']."</option>";
															}
														?>
													</select>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Select School Year:</label>
												    <select class="browser-default custom-select" name="session">
													    <option >Select School Year</option>
													    <?php
															$query="select session from sessions";
															$run=mysqli_query($con,$query);
															while($row=mysqli_fetch_array($run)) {
															 echo	"<option value=".$row['session'].">".$row['session']."</option>";
															}
														?>
													</select>

											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Your Profile Image:</label>
												    <input type="file" name="profile_image" placeholder="Student Age" class="form-control">
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
												<div class="form-group">
												    <label for="exampleInputPassword1">Mobile No:*</label>
												    <input type="number" name="mobile_no" class="form-control" required>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Gender:</label>
												    <select class="browser-default custom-select" name="gender">
													  <option>Select Gender</option>
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
											        <input type="text" name="permanent_address" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Current Address:</label>
												    <input type="text" name="current_address" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Place of Birth:</label>
												    <input type="text" name="place_of_birth" class="form-control">
											    </div>
											</div>
								  		</div>
								  		
								  		<!-- _________________________________________________________________________________
								  											Hidden Values are here
								  		_________________________________________________________________________________ -->
								  		<div>
											<input type="hidden" name="password" value="student123*">
											<input type="hidden" name="role" value="Student">
								  		</div>
								  		<!-- _________________________________________________________________________________
								  											Hidden Values are end here
								  		_________________________________________________________________________________ -->
								  		<div class="modal-footer">
						   		            <input type="submit" class="btn btn-primary" name="btn_save">
		      								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									    </div>
									</form>
						        </div>
						    </div>
					   </div>
					</div>
				</div>
				<div class="row w-100">
					<div class="col-md-12 ml-2">
						<section class="mt-3">
							<div class="row">
								<div class="col-md-6">
									<form action="search_student.php" method="post">
										<div class="form-group">
											<label for="exampleInputPassword1"><h5>Search:</h5></label>
											<div class="d-flex">
												<input type="text" name="search" id="search" class="form form-control" placeholder="Enter ID">
												<input class="btn btn-primary px-4 ml-4" type="submit" name="btnSearch" value="Search">
											</div>
										</div>
									</form>
								</div>	
								<div class="col-md-12 pt-5 mb-2">



								<!--***** ASSIGN SUBJECT TO STUDENTS *****-->
									<!-- Large modal -->
									<button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target=".bd-example-modal-lg1">Assign Subjects</button>
									<a class="btn btn-success" href="asign-single-student-subjects.php"> Assign Single Student Subject</a>
									<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header bg-info text-white">
														<h4 class="modal-title text-center">Assign Subjects To Student</h4>
													</div>
													<div class="modal-body">
														<form action="student.php" method="POST" enctype="multipart/form-data">
															<div class="row mt-3">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputEmail1">Select Course:*</label>
																		<select class="browser-default custom-select" name="course_code" required="">
																			<option >Select Course</option>
																			<?php
																				$query="select course_code from courses";
																				$run=mysqli_query($con,$query);
																				while($row=mysqli_fetch_array($run)) {
																				echo	"<option value=".$row['course_code'].">".$row['course_code']."</option>";

																				// $subjCode = $row['subject_code'];
																		
																				// echo "<option value='$subjCode'>$subjCode</option>";
																				}
																			?>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputPassword1" required>Enter Semester:*</label>
																		<input type="text" name="semester" class="form-control">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputPassword1">Enter Learning No:*</label>
																		<input type="text" name="student_id" class="form-control">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputPassword1">Select Subject:*</label>
																		<select class="browser-default custom-select" name="subject_code" required="">
																			<option >Select Subject</option>
																			<?php
																				$query="select subject_code from course_subjects";
																				$run=mysqli_query($con,$query);
																				while($row=mysqli_fetch_array($run)) {
																				// echo "<option value=".$row['subject_code'].">".$row['subject_code']."</option>";

																				$subjCode = $row['subject_code'];
																		
																				echo "<option value='$subjCode'>$subjCode</option>";
																				}
																			?>
																		</select>
																	</div>
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
							<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th>Lrn. No</th>
									<th>Student Name</th>
									<th>Current Address</th>
									<th>Session</th>
									<th>Course</th>
									<th>Admission</th>
									<th>Profile</th>
									<th colspan="1">Operations</th>
								</tr>
								<?php 
								$query="select * from student_info";
								$run=mysqli_query($con,$query);
								while($row=mysqli_fetch_array($run)) {?>
									<tr>
										<td><?php echo $row["ID"] ?></td>
										<td><?php echo $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"] ?></td>
										<td><?php echo $row["current_address"] ?></td>
										<td><?php echo $row["session"] ?></td>
										<td><?php echo $row["course_code"] ?></td>
										<!-- date_format($date,"Y/m/d H:i:s"); -->
										<td><?php echo date("Y-M-d",strtotime($row["admission_date"])); ?></td>
										<td><?php  $profile_image= $row["profile_image"] ?>
										<img height='50px' width='50px' src=<?php echo "images/$profile_image"  ?> >
										</td>
										<td width='170'> 
											<?php 
												echo "<a class='btn btn-primary' href=display-student.php?student_id=".$row['ID'].">Profile</a> 
												<a class='btn btn-danger' href=delete-function.php?student_id=".$row['ID'].">Delete</a> "
											?>
										</td>
									</tr>
								<?php }
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