<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/admin-login.php');
	}
		require_once "../../Connection/connection.php";
	?>

<!DOCTYPE html>
<html>
 <head>
  <title>ROOM PLOTTING</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../Css/footer.css">
  <link rel="stylesheet" type="text/css" href="../../Css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  

<?php
include('dbcon.php');
include('../../common/common-header.php');
include('../../common/admin-sidebar.php');
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
        url:"insert.php",
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
        url:"update.php",
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
        url:"update.php",
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
        url:"delete.php",
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
 <?php
?>
 <body>
  <br />
  <h2 align="center">ROOM PLOTTING</a></h2>
  <br />
  <div class="container">
    <div id="calendar"></div>
   </div>
 </body>
</html>