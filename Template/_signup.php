<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once('database/config.php');
    ;
    $cust_first_name = $_POST["cust_first_name"];
    $cust_last_name = $_POST["cust_last_name"];
    $cust_email = $_POST["cust_email"];
    $cust_phoneNO = $_POST["cust_phoneNO"];
    $cust_username = $_POST["cust_username"];
    $cust_last_name = $_POST["cust_last_name"];
    $cust_password = $_POST["cust_password"];
    $cpassword = $_POST["cpassword"];

    $exists=false;
    if(($cust_password == $cpassword) && $exists==false){
        $sql = "INSERT INTO `customers` ( `cust_first_name`, `cust_last_name`, `cust_email`, `cust_phoneNO`, `cust_username`, `cust_password`) VALUES ('$cust_first_name', '$cust_last_name', '$cust_email', '$cust_phoneNO', '$cust_username', '$cust_password')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
        }
    }
    else{
        $showError = "Passwords do not match";
    }
}

?>

<?php
if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
}
if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
}
?>

<div class="container my-4" >
    <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="./assets/shoewoo_logo.png" alt="" width="72" height="72">
            <h2>Signup to our website</h2>
    </div>
    
    <form action="signup.php" method="post">

        <div class="form-group">
            <label for="cust_first_name">First Name</label>
            <input type="text" class="form-control" id="cust_first_name" name="cust_first_name" aria-describedby="emailHelp">

        </div>

        <div class="form-group">
            <label for="cust_last_name">Last Name</label>
            <input type="text" class="form-control" id="cust_last_name" name="cust_last_name" aria-describedby="emailHelp">

        </div>

        <div class="form-group">
            <label for="cust_email">Email Address</label>
            <input type="email" class="form-control" id="cust_email" name="cust_email">
        </div>

        <div class="form-group">
            <label for="cust_phoneNO">Phone No</label>
            <input type="number" class="form-control" id="cust_phoneNO" name="cust_phoneNO">
        </div>


        <div class="form-group">
            <label for="cust_username">Username</label>
            <input type="text" class="form-control" id="cust_username" name="cust_username" aria-describedby="emailHelp">

        </div>
        <div class="form-group">
            <label for="cust_password">Password</label>
            <input type="password" class="form-control" id="cust_password" name="cust_password">
        </div>


        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
        </div>

        <button type="submit" class="btn btn-primary">SignUp</button>
    </form>
</div>

