<?php

session_start();

/*Check if user login*/
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin" === true]){
    header("location: Welcome.php"); // if logged in, send to welcome page (NOTE CREATED YET)
    exit;
}

require_once "Config.php"; // Adding config file

/*Initializing variables*/
$username = $password = "";
$username_err = $password_err = $login_err = "";

//Check if login from data
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //check if username empty
    if(empty(trim($_POST["username"]))){ //trim username if empty, trimming removes whitespaces/predefined chars on both sides of string
        $username_err = "Please enter a username.";
    }else{
        $username = trim($_POST["username"]);
    }

    //check if password empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please ender your password.";
    }else{
        $password = trim($_POST["password"]);
    }

    //Validate
    if(empty($username_err) && empty($password_err)){
        //Querry
        $sql = "SELECT id, username, 
        password FROM USERS 
            WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            //linking variables to the statement as paramaters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            //set the paramaters
            $param_username = $username;

            //execute statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_results($stmt); // Storing the results

                //if username already exists, verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_results($stmt, $id, $username, $hashed_password); //binding results

                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start(); // start session if password is correct

                            //store session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            //send to welcome page once logged in
                            header("location: welcome.php");
                        }else{
                            //if password is invalid
                            $login_err = "INVALID username or password.";
                        }
                    }
                }else{
                    //if username doesn't exist
                    $login_err = "INVALID username or password.";
                }
            }else{
                //if anything else happens
                echo "Something went wrong, try again later.";
            }

            //close statement
            mysqli_stmt_close($stmt);
        }
    }
    //close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in you information to login.</p>

        <?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control <?php echo(!empty($username_err)) ? 'is-invalid' : '';
                    ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?> </span>
                </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login"> 
            </div>
        </form>
    </div>
</body>
</html>