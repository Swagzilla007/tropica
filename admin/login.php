<?php 
session_start(); 
include_once 'include/class.user.php'; 
$user=new User();

$message = '';
if(isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $login = $user->check_login($emailusername, $password);
    if($login) {
        header("Location: ../admin.php");
    } else {
        $message = "<div class='alert alert-danger' style='background: rgba(0,0,0,0.8); color: #ff4444; border: 1px solid #ff4444; margin-bottom: 20px; text-align: center; padding: 10px; border-radius: 5px;'>
                        Invalid username or password!
                    </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reg.css" type="text/css">
    <style>
        body {
            background-image: url('../images/home.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
        }

        .login-container {
            margin-top: 100px;
            width: 400px;
        }

        .well {
            background: rgba(0, 0, 0, 0.9);
            border: none;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        .login-title {
            color: #ffbb2b;
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
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

        .btn-login, .btn-back {
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
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-login:hover, .btn-back:hover {
            background-color: #ffbb2b;
            color: #000;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .error-message {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #ff4444;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
    <script language="javascript" type="text/javascript">
        function submitlogin() {
            var form = document.login;
            if (form.emailusername.value == "") {
                alert("Enter email or username.");
                return false;
            } else if (form.password.value == "") {
                alert("Enter Password.");
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="container login-container">
        <div class="well">
            <h2 class="login-title">Admin Login</h2>
            <?php if($message) echo $message; ?>
            <form action="" method="post" name="login">
                <div class="form-group">
                    <label for="emailusername">Email/Username:</label>
                    <input type="text" class="form-control" name="emailusername" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <button type="submit" class="btn btn-login" name="submit" onclick="return(submitlogin());">Login</button>
                
                <a href="../index.php" class="btn-back">Back To Home</a>
            </form>
        </div>
    </div>

</body>

</html>