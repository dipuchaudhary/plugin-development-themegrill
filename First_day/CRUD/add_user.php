<!-- include connection -->
<?php include_once 'includes/db.php'; ?>
<!-- header -->
<?php include_once 'includes/header.php';?>

<!-- add user -->
<?php 
    $error = array();
    $first_name = $last_name = $email = '';

    if( isset( $_POST['submit'] ) ){

        if( empty ($_POST['first_name'] ) ) {
            $error['fname'] = "First Name is required";
        } else {
            $first_name = $_POST['first_name'];
        }
        if( empty ($_POST['last_name'] ) ){
            $error['lname'] = "Last Name is required";
        } else{
            $last_name = $_POST['last_name'];
        }
        if( empty($_POST['email'] ) ){
            $error['email'] = "Email is required";
        } else {
            $email = $_POST['email'];
        }
        if( empty($error) )
        {
            $sql = "INSERT INTO users(first_name,last_name,email) VALUES('$first_name','$last_name','$email')";
            if( mysqli_query($conn,$sql) ){
                header("location:index.php");
            } else {
                echo "Error:" .$sql. mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
?>

<div class="container">
<h2>Add User</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="mb-3">
    <label for="firstname">First Name</label>
    <input type="text" name="first_name" class="form-control">
    <span class="error"> <?php echo isset($error['fname']) ? $error['fname'] : ''; ?></span>
    </div>
    <div class="mb-3">
    <label for="lastname">Last Name</label>
    <input type="text" name="last_name" class="form-control">
    <span class="error"><?php echo isset($error['lname']) ? $error['lname'] : ''; ?></span>
    </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control">
    <span class="error"><?php echo isset($error['email']) ? $error['email'] : ''; ?></span>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<!-- footer -->
<?php include_once 'includes/footer.php'; ?>