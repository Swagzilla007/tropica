<?php
include_once 'include/class.user.php'; 
$user=new User();
$message = '';

if(isset($_REQUEST['submit'])) 
{ 
    extract($_REQUEST); 
    $register = $user->reg_user($fullname, $uname, $upass, $uemail); 
    if($register) 
    { 
        $message = "<div class='alert alert-success text-center' style='background: rgba(0,0,0,0.8); color: #ffbb2b; border: 1px solid #ffbb2b; margin-bottom: 20px;'>
                        Manager Added Successfully!
                    </div>";
    } 
    else 
    {
        $message = "<div class='alert alert-danger text-center' style='background: rgba(0,0,0,0.8); color: #ff4444; border: 1px solid #ff4444; margin-bottom: 20px;'>
                        Registration failed! Username or email already exists
                    </div>";
    }
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reg.css" type="text/css">
    <script language="javascript" type="text/javascript">
        function submitreg() {
            var form = document.reg;
            if (form.name.value == "") {
                alert("Enter Name.");
                return false;
            } else if (form.uname.value == "") {
                alert("Enter username.");
                return false;
            } else if (form.upass.value == "") {
                alert("Enter Password.");
                return false;
            } else if (form.uemail.value == "") {
                alert("Enter email.");
                return false;
            }
        }
    </script>
    <style>
        body {
            background-image: url('../images/home.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
        }

        .container {
            margin-top: 50px;
            width: 60%;
        }

        .well {
            background: rgba(0, 0, 0, 0.9);
            border: none;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        .registration-title {
            color: #ffbb2b;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        hr {
            border-color: rgba(255, 187, 43, 0.2);
            margin: 30px 0;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            color: #ffbb2b;
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 187, 43, 0.2);
            border-radius: 8px;
            height: 45px;
            color: #fff;
            padding: 10px 15px;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffbb2b;
            box-shadow: 0 0 8px rgba(255, 187, 43, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-register {
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffbb2b;
            border: 2px solid #ffbb2b;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .btn-register:hover {
            background-color: #ffbb2b;
            color: #000;
            transform: translateY(-2px);
        }

        #click_here {
            text-align: center;
            margin-top: 25px;
        }

        #click_here a {
            color: #ffbb2b;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        #click_here a:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="well">
            <h2 class="registration-title">Add New Manager</h2>
            <hr>
            <?php if($message) echo $message; ?>
            <form action="" method="post" name="reg">
                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" class="form-control" name="fullname" placeholder="example: Jhon Wiki" required>
                </div>
                <div class="form-group">
                    <label for="uname">User Name:</label>
                    <input type="text" class="form-control" name="uname" placeholder="exmple: witchbug" required>
                </div>
                <div class="form-group">
                    <label for="uemail">Email:</label>
                    <input type="email" class="form-control" name="uemail" placeholder="example: jhon@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="upass">Password</label>
                    <input type="text" class="form-control" name="upass" placeholder="abc123" required>
                </div>
                <button type="submit" class="btn btn-lg btn-primary button btn-register" name="submit" value="Add Manager" onclick="return(submitreg());">Submit</button>

               <br>
                <div id="click_here">
                    <a href="../admin.php">Back to Admin Panel</a>
                </div>


            </form>
        </div>
    </div>

</body>

</html>