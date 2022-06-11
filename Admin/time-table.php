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
<!doctype html>
<html lang="en">
	<head>
	<title>Admin - Time Table</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../Css/footer.css">
	<link rel="stylesheet" type="text/css" href="../../Css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	
<?php
include('room/dbcon.php');
$query = $conn->query("SELECT * FROM room_sched ORDER BY id");
?>
<script>
    $(document).ready(function() {
     var calendar = $('#calendar').fullCalendar({
      editable:true,
      header:{
       left:'prev,next today',
       center:'title',
       right:'month,agendaWeek,agendaDay'
      },
      events: [<?php while ($row = $query ->fetch_object()) { ?>{ id : '<?php echo $row->id; ?>', title : '<?php echo $row->title; ?>', start : '<?php echo $row->start_event; ?>', end : '<?php echo $row->end_event; ?>', }, <?php } ?>],
      selectable:true,
      selectHelper:true,
      select: function(start, end, allDay)
      {
      var title = prompt("Enter Event Title");
      if(title)
      {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
        url:"room/insert.php",
        type:"POST",
        data:{title:title, start:start, end:end},
        success:function(data)
        {
          calendar.fullCalendar('refetchEvents');
          alert("Added Successfully");
          window.location.replace("index.php");
        }
        })
      }
      },
 
      editable:true,
      eventResize:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"room/update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function(){
        calendar.fullCalendar('refetchEvents');
        alert('Event Update');
        }
      })
      },
 
      eventDrop:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"room/update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function()
        {
        calendar.fullCalendar('refetchEvents');
        alert("Event Updated");
        }
      });
      },
 
      eventClick:function(event)
      {
      if(confirm("Are you sure you want to remove it?"))
      {
        var id = event.id;
        $.ajax({
        url:"room/delete.php",
        type:"POST",
        data:{id:id},
        success:function()
        {
          calendar.fullCalendar('refetchEvents');
          alert("Class Scedule Removed");
        }
        })
      }
      },
 
    });
  });
</script>

	</head>
	
	<title>ROOM PLOTTING</title>
  
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">ROOM PLOTTING</h4>
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
																	
									<div class="container">
										<div id="calendar"></div>
									</div>

								
							</div>				
						</section>
					</div>
				</div>
			</div>
		</main>
	</body>
</html>

