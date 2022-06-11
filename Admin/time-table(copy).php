<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>

<!--*********************** PHP code starts from here for data insertion into database ******************************* -->
<?php 
 
 	if (isset($_POST['btn_save'])) {

 		$course_code=$_POST["course_code"];

 		$semester=$_POST["semester"];

 		$timing_from=$_POST["timing_from"];
 		
 		$timing_to=$_POST["timing_to"];
 		
 		$day=$_POST["day"];
 		
 		$subject_code=$_POST["subject_code"];

 		$room_no=$_POST["room_no"];

 		$year_and_section=$_POST["year_and_section"];
 		
 		$query="insert into time_table(course_code,semester,timing_from,timing_to,day,subject_code,room_no,sec_id)values('$course_code','$semester','$timing_from','$timing_to','$day','$subject_code','$room_no','$year_and_section')";
 		$run=mysqli_query($con, $query);
 		if ($run) {
 			echo "Your Data has been submitted";
 		}
 		else {
 			echo "Your Data has not been submitted";
 		}
 	}
?>

<!-- ---------------------------------------update time table------------------------------------------------ -->
<?php 
 
 	if (isset($_POST['btn_update'])) {

 		echo $course_code=$_POST["course_code"];

 		echo $semester=$_POST["semester"];

 		echo $timing_from=$_POST["timing_from"];
 		
 		echo $timing_to=$_POST["timing_to"];
 		
 		echo $day=$_POST["day"];
 		
 		echo $subject_code=$_POST["subject_code"];

 		echo $room_no=$_POST["room_no"];

 		echo $sec_id=$_POST["sec_id"];

 		$query1="update time_table set course_code='$course_code',semester='$semester',timing_from='$timing_from',timing_to='$timing_to',day='$day',subject_code='$subject_code',room_no='$room_no',sec_id='$sec_id' where subject_code='$subject_code'";
 		$run1=mysqli_query($con, $query1);
 		if ($run1) {
 			echo "Your Data has been updated";
 		}
 		else {
 			echo "Your Data has not been updated";
 		}
 	}
?>
<!-- ---------------------------------------update time table------------------------------------------------ -->

<!--*********************** PHP code end from here for data insertion into database ******************************* -->

<?php

require_once("timetable/dbcontroller.php");
$db_handle = new DBController();

$sql = "SELECT * from time_table";
$posts = $db_handle->runSelectQuery($sql);
?>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function createNew() {
	$("#add-more").hide();
	var data = '<tr class="table-row" id="new_row_ajax">' +
	'<td contenteditable="true" id="txt_title" onBlur="addToHiddenField(this,\'title\')" onClick="editRow(this);"></td>' +
	'<td contenteditable="true" id="txt_description" onBlur="addToHiddenField(this,\'description\')" onClick="editRow(this);"></td>' +
	'<td><input type="hidden" id="title" /><input type="hidden" id="description" /><span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links">Save</a> / <a onclick="cancelAdd();" class="ajax-action-links">Cancel</a></span></td>' +	
	'</tr>';
  $("#table-body").append(data);
}
function cancelAdd() {
	$("#add-more").show();
	$("#new_row_ajax").remove();
}
function editRow(editableObj) {
  $(editableObj).css("background","#FFF");
}

function saveToDatabase(editableObj,column,id) {
  $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
  $.ajax({
    url: "timetable/edit.php",
    type: "POST",
    data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id,
    success: function(data){
      $(editableObj).css("background","#FDFDFD");
    }
  });
}
function addToDatabase() {
  var title = $("#title").val();
  var description = $("#description").val();
  
	  $("#confirmAdd").html('<img src="loaderIcon.gif" />');
	  $.ajax({
		url: "timetable/add.php",
		type: "POST",
		data:'title='+title+'&description='+description,
		success: function(data){
		  $("#new_row_ajax").remove();
		  $("#add-more").show();		  
		  $("#table-body").append(data);
		}
	  });
}
function addToHiddenField(addColumn,hiddenField) {
	var columnValue = $(addColumn).text();
	$("#"+hiddenField).val(columnValue);
}

function deleteRecord(id) {
	if(confirm("Are you sure you want to delete this row?")) {
		$.ajax({
			url: "timetable/delete.php",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
}
</script>
<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Time Table</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">Class Schedule Management</h4>
						<!--<button type="button" class="btn btn-primary ml-5" data-toggle="modal" data-target=".bd-example-modal-lg">Add Class Time</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ml-2">
						<section class=" mt-3">
							<div class="row">
								<div class="col-md-8"></div>
								<div class="col-md-3 ml-5 ">
									<div class="col-md-12 pt-3 ml-5">
										
										<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header bg-info text-white">
														<h4 class="modal-title text-center">Add Time</h4>
													</div>
													<div class="modal-body">
														<form action="time-table.php" method="post">
															<div class="row mt-3">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputEmail1">Course Code: </label>
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
																<div class="col-md-6">
																	<div class="form-group">
																		

																		<label for="exampleInputPassword1">Select Year and Section:*</label>
																	<select class="browser-default custom-select" name="year_and_section" required="">
																		<option >Select year and section</option>
																		<?php
																			$query="select * from yr_and_section";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {
																			echo	"<option value=".$row['year_and_section'].">".$row['year_and_section']."</option>";
																			}
																		?>
																	</select>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputEmail1">Timing From: </label>
																		<input type="time" name="timing_from" class="form-control">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="formp">
																		<label for="exampleInputPassword1">Timing To:</label>
																		<input type="time" name="timing_to" class="form-control">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputEmail1">Lecture Day: </label>
																		<select class="browser-default custom-select" name="day">
																			<option >Select Week Day</option>
																			<?php
																			$teacher_id=$_SESSION['teacher_id'];
																			$query="select * from weekdays";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {
																			echo	"<option value=".$row['day_id'].">".$row['day_name']."</option>";
																			}
																			?>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="formp">
																		<label for="exampleInputPassword1">Please Select Subject:*</label>
																	<select class="browser-default custom-select" name="subject_code" required="">
																		<option >Select Subject</option>
																		<?php
																			$query="select * from course_subjects";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {
																				$subject_arr[$row['subject_code']] = $row;
																			}
																			//echo	"<option value=".$row['subject_code'].">".$row['subject_code']."</option>";
																			//}
																			foreach ($subject_arr as $row => $value) {?>
																				// code...
																				<option value="<?=$value['subject_code'];?>"><?=$value['subject_code'];?></option>

																		<?php	}?>
																	</select>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="formp">
																		<label for="exampleInputPassword1">Enter Room No:</label>
																		<input type="text" name="room_no" class="form-control" placeholder="Room No">
																	</div>
																</div>
																<div class="formp">
																	<label for="exampleInputEmail1">Select Semester:</label>
																		<select class="browser-default custom-select" name="semester">
																			<option >Select Semester</option>
																			<?php
																			$teacher_id=$_SESSION['teacher_id'];
																			$query="select distinct(semester) as semester from course_subjects";
																			$run=mysqli_query($con,$query);
																			while($row=mysqli_fetch_array($run)) {
																			echo	"<option value=".$row['semester'].">".$row['semester']."</option>";
																			}
																			?>
																		</select>

																</div>
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn btn-primary" name="btn_save" value="Save Data">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															</div> 	
														</form>
													</div>
												</div>
										</div>
										</div>
									</div>-->
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="w-100 table-elements table-three-tr" cellpadding="3">
										<tr class="table-tr-head table-three text-white">
										<table class="w-100 table-elements table-three-tr">
										<thead>
											<tr>
											<th class="table-header" colspan="2">Time</th>
											<th class="table-header" colspan="2">Monday</th>
											<th class="table-header" colspan="2">Tuesday</th>
											<th class="table-header" colspan="2">Wednesday</th>
											<th class="table-header" colspan="2">Thursday</th>
											<th class="table-header" colspan="2">Friday</th>
											<th class="table-header" colspan="2">Saturday</th>
											<th class="table-header" colspan="2">Sunday</th>
											<th class="table-header" >Actions</th>
											</tr>
										</thead>
										<tbody id="table-body" >
											<?php
											if(!empty($posts)) { 
											foreach($posts as $k=>$v) {
											?>
											<tr class="table-row" id="table-row-<?php echo $posts[$k]["id"]; ?>">
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_from','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["timing_from"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["timing_to"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["timing_to"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["subject_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["course_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["subject_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["course_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["subject_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["course_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["subject_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["course_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["subject_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["course_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["subject_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["course_code"]; ?></td>
												<td contenteditable="true" onBlur="saveToDatabase(this,'timing_to','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["subject_code"]; ?></td>
												<td><a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts[$k]["id"]; ?>);">Delete</a></td>
											</tr>
											<?php
											}
											}
											?>
										</tbody>
										
									</table>
								</div>
								<div class="ajax-action-button" id="add-more" onClick="createNew();">Add More</div>
							</div>				
						</section>
					</div>
				</div>
			</div>
		</main>
	</body>
</html>

