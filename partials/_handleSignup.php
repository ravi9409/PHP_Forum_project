<?php
include "_bootstrap.php";
$showError = "false";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $showError = '';
    $sqlSelect = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
    $resultSelect = mysqli_query($connection, $sqlSelect);
    $numRows = mysqli_num_rows($resultSelect);
    if ($numRows > 0) {
        $showError = "Email already in use";
    } else {
        if ($pass == $cpass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $showAlert = true;
                header("Location: /forum/index.php?signupsucess=true");
                exit();
            }
        } else {
            $showError = "Password do not match";
        }
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Sign Up not successful click back button to go back to login page</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }

}


?>