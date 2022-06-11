 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	$teacher_id= $_SESSION['teacher_id'];
	if (!$_SESSION["LoginTeacher"])
	{
		header('location:../teacher-login/login.php');
	}
		require_once "../connection/connection.php";
	?>

<!---------------- Session Ends form here ------------------------>


<!doctype html>
<html lang="en">
	<head>
		<title>Teacher - Courses</title>
	</head>
	<style>
	table, tr, th, td {
  		border: none;
 		border-collapse: collapse;
		}
	</style>
	
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/teacher-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 main-background mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4 class="">Professor Schedule Information</h4>
				</div>


				<div>
					
					
				<center><strong>University of Caloocan City</strong></center>
       			<center>Biglang-Awa St Cor 11th Ave Catleya St. Caloocan City</center>
        		<center>Telefax: 310-6855</center>
        		<br>
        		<center><strong><h4>FACULTY LOAD</h4></strong></center>
        		<center>
							


							<?php
								$sr_no=1;
								$teacher_email=$_SESSION['LoginTeacher'];
								$query="select * from teacher_info where email='$teacher_email'";
								$run=mysqli_query($con,$query);
								while($row1=mysqli_fetch_array($run)) {
									$teacher_id=$row1["teacher_id"];
								}
								$query1="select * from teacher_courses where teacher_courses_id ='$teacher_id'";
								$run1=mysqli_query($con, $query1);
								while($row2=mysqli_fetch_array($run1)) {
									
							?>
        		 <?php echo $row2['semester']. "";}?> <strong>1st </strong>Semester, School Year <strong>2021 - 2022</strong></center>
        		<br>
			
        		</div>
        		
        			<center>
        				<?php 
        				$query="select * from teacher_info where teacher_id ='$teacher_id'";
						$run=mysqli_query($con, $query);
							while($row=mysqli_fetch_assoc($run)) {
        				?>
        				<strong align="left">College/Dept.:</strong> <?php echo $row ["department"]. "";?>
        				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        				<strong>Employment Status: </strong> <?php echo $row ["teacher_status"]. "";}?>
        			</center>
        			<br>


        			<table style="width:100%;border: hidden;">
				        <?php 
						$sr_no=1;
						$teacher_email=$_SESSION['LoginTeacher'];
						$query1="select * from teacher_info where email='$teacher_email'";
						$run1=$run=mysqli_query($con,$query1);
						while($row=mysqli_fetch_array($run1)) {
							$teacher_id=$row["teacher_id"];
						
						?>
					<tr style="border: hidden;">
							<th style="border: hidden;"><?php echo $row ["last_name"]. "";?></th>
						    <th style="border: hidden;"><?php echo $row ["first_name"]. "";?></th>
						    <th style="border: hidden;"><?php echo $row ["middle_name"]. "";?></th>
						  </tr>
						<?php } ?>
						  <tr style="border: hidden;">
						    <td style="border: hidden;">Last Name</td>
						    <td style="border: hidden;">Last Name</td>
						    <td style="border: hidden;">M.I</td>
						  </tr>
						</table>

				<div class="row">
					<div class="col-md-12">
						<section class="border mt-3">
							<table border="1" class="w-100 table-striped table-dark"cellpadding="5" >
								<tr>
									
									<th>Subject Code</th>
									<th>Course Description</th>
									<th>Course</th>
									<th>YR/SEC.</th>
									<th>Units</th>
									<th>Days</th>
									<!--<th>Semester</th>-->
									<th>Time</th>
									<th>Room No</th>
									<th>Class Size</th>
								</tr>
								<?php
								// $sr_no=1;
								// $teacher_email=$_SESSION['LoginTeacher'];
								// $query2="select * from teacher_info where email='$teacher_email'";
								// $run2=$run=mysqli_query($con,$query1);
								// while($row=mysqli_fetch_array($run1)) {
								// 	$teacher_id=$row["teacher_id"];
								// }
								// $query="select ys.year_and_section, cs.subject_name,tc.course_code,tc.subject_code,tc.total_classes,tt.room_no,TIME_FORMAT(tt.timing_from,'%h:%i %p') as timing_from,TIME_FORMAT(tt.timing_to,'%h:%i %p') as timing_to from teacher_courses tc inner join time_table tt on tc.subject_code=tt.subject_code inner join course_subjects cs on tc.subject_code = cs.subject_code inner join yr_and_section ys on tt.sec_id = ys.sec_id where teacher_id='$teacher_id'";
								
								// //select ys.year_and_section, cs.subject_name,tc.course_code,tc.subject_code,tc.total_classes,tt.room_no,TIME_FORMAT(timing_from,'%h:%i %p') as timing_from,TIME_FORMAT(timing_to,'%h:%i %p') as timing_to from teacher_courses tc inner join time_table tt on tc.subject_code=tt.subject_code inner join course_subjects cs on tc.subject_code = cs.subject_code inner join yr_and_section ys on tt.sec_id = ys.sec_id where teacher_id='$teacher_id'";
								

								$infoID = $_SESSION['teacher_info_id'];
								$query2="select * from teacher_courses where teacher_id = '$infoID';";
								$run=mysqli_query($con,$query2);
								while($row=mysqli_fetch_array($run)) {
									echo "<tr>";
									
									echo "<td>".$row["subject_code"]."</td>";
									echo "<td>".$row["subject_name"]."</td>";
									echo "<td>".$row["course_code"]."</td>";
									echo "<td>".$row["sec_id"]."</td>";
									echo "<td>".$row["units"]."</td>";
									echo "<td>".$row["day"]."</td>";
									echo "<td>".$row["time"]."</td>";
									// echo "<td>".$row["timing_from"]."<br>".$row["timing_to"]."</td>";
									echo "<td>".$row["room_no"]."</td>";
									echo "<td>".$row["total_classes"]."</td>";
									
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