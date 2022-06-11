	

<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../admin-login/login.php');
	}
		require_once "../Connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>

	
<?php

require_once("dbcontroller.php");
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
    url: "edit.php",
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
		url: "add.php",
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
			url: "delete.php",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
}
</script>

<style>
body{width:615px;}
.tbl-qa{width: auto;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: center;padding:10px;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;}
.ajax-action-links {color: #09F; margin: 10px 0px;cursor:pointer;}
.ajax-action-button {border:#094 1px solid;color: #09F; margin: 10px 0px;cursor:pointer;display: inline-block;padding: 10px 20px;}

</style>
<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Time Table</title>
	</head>
		
	<body>
	<?php include('../common/common-header.php') ?>
	<?php include('../common/admin-sidebar.php'); ?>
	<div class="sub-main">
	<div class="row">
	<div class="col-md-12">
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
</div>
<div class="ajax-action-button" id="add-more" onClick="createNew();">Add More</div>