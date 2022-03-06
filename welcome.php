<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to my site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <head>
    <title>Image Upload</title>
    <link rel="stylesheet" 
          type="text/css"
          href="style.css" />
    </head>
    
    <body>
        <div id="content">
    
            <form method="POST" 
                action="" 
                enctype="multipart/form-data">
                <input type="file" 
                    name="uploadfile" 
                    value="" />
    
                <div>
                    <button type="submit"
                            name="upload">
                    UPLOAD
                    </button>
                </div>
            </form>
        </div>
    </body>

    <?php
    error_reporting(0);
    ?>
    <?php
    $msg = "";

    // If upload button is clicked ...
    if (isset($_POST['upload'])) {

        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];	
            $folder = "image/".$filename;
            
        $db = mysqli_connect("localhost", "root", "", "hackmerceddb");

            // Get all the submitted data from the form
            $sql = "INSERT INTO image (filename) VALUES ('$filename')";

            // Execute query
            mysqli_query($db, $sql);
            
            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
            }else{
                $msg = "Failed to upload image";
        }
    }
    $result = mysqli_query($db, "SELECT * FROM image");
    ?>


</body>
</html>