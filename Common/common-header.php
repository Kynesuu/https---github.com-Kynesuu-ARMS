<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="$baseUrl/../Images/ucclogo.png" type="image/x-icon">
    
    <!-- css style goes here -->

      <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../Css/footer.css">
      <link rel="stylesheet" type="text/css" href="../Css/style.css">

    <!-- css style go to end here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
 

    <nav class="navbar navbar-expand-lg navbar-dark header-back sticky-top header-navbar-fonts">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="../images/ucclogo.png" class="logo-image" width="50" height="50">
        <h3 class="text-light text-uppercase ml-2">University of Caloocan City</h3>
      </a>
      
      <!--
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
          
          <li class="nav-item active">
            <a class="nav-link" href="../index.php">HOME<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../academics.php">ACADEMICS<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../admission.php">ADMISSION<span class="sr-only">(current)</span></a>
          </li>
        -->


            <div class="btn-group ml-auto">
                <button type="button" class="btn btn-danger"><h5><?php echo $_SESSION['Name'] ?></h5></button>
                <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                
              

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="../admin/manage-accounts.php"><i class="fa fa-pencil" aria-hidden="true"></i> User config</a>
                <a class="dropdown-item" href="../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
              </div>
            </div>
            
      
    </nav>