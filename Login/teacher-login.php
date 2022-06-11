<!-- PHP Starts Here -->
<?php 

    require_once "../connection/connection.php"; 
    $message="Email Or Password Does Not Match";
    if(isset($_POST["btnlogin"]))
    {
        $username=$_POST["email"];
        $password=$_POST["password"];

        // teacher_login / admin_lgin / student_login
        $query="select * from teacher_login where user_id='$username' && Password='$password' ";
        $result=mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            //Login Successful

            while ($row=mysqli_fetch_array($result)) {
                session_start();
                $_SESSION['LoginTeacher']=$row["user_id"];
                $_SESSION['Name']=$row["Role"];
                $_SESSION['teacher_id'] = $row['ID'];
                $_SESSION['teacher_info_id'] = $row['teacher_info_id'];
                header('Location: ../Teacher/teacher-index.php');
            }
            
            /* while ($row=mysqli_fetch_array($result)) {
                if ($row["Role"]=="Admin")
                {
                    $_SESSION['LoginAdmin']=$row["user_id"];
                    $_SESSION['Name']=$row["Role"];
                    header('Location: ../admin/admin-index.php');
                }
                   else if ($row["Role"]=="Teacher" && $row["account"]=="Activate")
                {
                    $_SESSION['LoginTeacher']=$row["user_id"];
                    $_SESSION['Name']=$row["Role"];
                    $_SESSION['teacher_id'] = $row['ID'];
                    header('Location: ../Teacher/teacher-index.php');
                }
                else if ($row["Role"]=="Student" && $row["account"]=="Activate")
                {
                    $_SESSION['LoginStudent']=$row['user_id'];
                    $_SESSION['Name']=$row["Role"];
                    header('Location: ../Student/student-index.php');
                }
                else if ($row["Role"]=="Registrar" && $row["account"]=="Activate")
                {
                    $_SESSION['LoginRegistrar']=$row['user_id'];
                    $_SESSION['Name']=$row["Role"];
                    header('Location: ../Registrar/registrar-index.php');
                }
            } */
        }
        else
        { 
            // header("Location: teacher-login.php?wrong-login");
            //echo "error";
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../Images/ucclogo.png" type="image/x-icon">
    
    <!-- css style goes here -->

      <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../Css/footer.css">
      <link rel="stylesheet" type="text/css" href="../Css/style.css">

    <!-- css style go to end here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
        <title>Login - AHRMS</title>
    </head>
    <body class="login-background">
        
        <div class="login-div mt-3 rounded">
            <div class="logo-div text-center">
                <img src="../Images/ucclogo.png" alt="" class="align-items-center" width="100" height="100">
            </div>


            <div class="login-padding">
                <h2 class="text-center text-white">TEACHER LOGIN</h2>   
                <form class="p-1" action="teacher-login.php" method="POST">


                    <label><h6>Enter Your ID/Email:</h6></label>
                     <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                          </div>
                          <input type="text" name="email" class="form-control" placeholder="Enter User ID" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>


                        <label><h6>Enter Password:</h6></label>
                     <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-key fa" aria-hidden="true"></i></span>
                          </div>
                          <input type="Password" name="password" class="form-control" placeholder="Enter Password" aria-label="Password" aria-describedby="basic-addon1" required>
                          <!-- <?php echo $message; ?> -->
                        </div>



                    
                    <div class="form-group text-center mb-3 mt-4">
                        <input type="submit" onclick="errorMessage()" name="btnlogin" value="LOGIN" class="btn btn-white pl-5 pr-5 " >
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script>
    function errorMessage() {
        var error = document.getElementById("error")
        if (isNaN(document.getElementById("number").value))
        {
             
            // Changing content and color of content
            error.textContent = "Please enter a valid number"
            error.style.color = "red"
        } else {
            error.textContent = ""
        }
    }
</script>
</html>



