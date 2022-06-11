<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Bootstrap/css/index.css">
</head>
<body>

<div class="row w-100">
		<button class="show-btn button-show ml-auto">
		<i class="fa fa-bars py-1" aria-hidden="true"></i>
		</button> 
	</div>
		<nav id="sidebarMenu" class="">
			<div class="col-xl-2 col-lg-3 col-md-4 sidebar position-fixed border-right">
				<div class="sidebar-header">
					<div class="nav-item pl-2 p-2 ml-1">
						<a class="nav-link text-white" href="../student/student-index.php">
							<span class="home"></span>
							<i class="fa fa-home mr-2" aria-hidden="true"></i> Dashboard 
						</a>
					</div>
				</div>
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link" href="../student/student-profile.php">
						<span data-feather="file"></span>
						<i class="fa fa-user mr-2" aria-hidden="true"></i> Personal Profile
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../student/student-personal-information.php">
						<span data-feather="file"></span>
						<i class="fa fa-info-circle mr-2" aria-hidden="true"></i>Personal Information
						</a>
					</li>
					<!-- <li class="nav-item has-submenu" id="dropdown">
						<a class="nav-link" href="#">
						<span data-feather="shopping-cart"></span>
						<i class="fa fa-th-list mr-2" aria-hidden="true"></i> Courses
						</a>
							<ul class="submenu collapse">
								<li><a class="nav-link" href="#">Submenu item 1 </a></li>
								<li><a class="nav-link" href="#">Submenu item 2 </a></li>
								<li><a class="nav-link" href="#">Submenu item 3 </a></li>
							</ul>
					</li> -->

					<div class="accordions accordion-flush pl-2 m-1" id="accordionFlushExample">
						<div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
							<button class="accordion-button collapsed  border-bottom p-1" type="button" >
								<i class="fa fa-th-list mr-2 " aria-hidden="true"></i> Courses 
							</button>
							<i class="bi bi-caret-down-fill pr-3"></i>
						</div>
						<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body">
								<li><a class="nav-link" href="courses-enrolled.php">Enrolled</a></li>
								<li><a class="nav-link" href="courses-completed.php">Completed</a></li>			
							</div>
						</div>
					</div>
				
					<li class="nav-item">
						<a class="nav-link" href="../student/student-transcript.php">
						<span data-feather="shopping-cart"></span>
						<i class="fa fa-th-list mr-2" aria-hidden="true"></i> Student Transcript
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../student/student-fee.php">
						<span data-feather="users"></span>
						<i class="fa fa-credit-card-alt mr-2" aria-hidden="true"></i> Student Fee
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../student/student-password.php">
						<span data-feather="bar-chart-2"></span>
						<i class="fa fa-key mr-2" aria-hidden="true"></i> Change Password
						</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<script>
			const toggleBtn = document.querySelector(".show-btn");
			const sidebar = document.querySelector(".sidebar");
			// undefined
			toggleBtn.addEventListener("click",function(){
				sidebar.classList.toggle("show-sidebar");
			});


		</script>
	
</body>
</html>

