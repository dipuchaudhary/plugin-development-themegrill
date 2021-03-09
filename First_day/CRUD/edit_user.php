<!-- include connection -->
<?php include_once 'includes/db.php'; ?>
<!-- header -->
<?php include_once 'includes/header.php';?>

<!-- update user -->
<?php 
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE user_id = {$id}";
        $result = mysqli_query($conn,$sql);
        $user = mysqli_fetch_assoc($result);
        
    }

    // update
    $error = array();
    $first_name = $last_name = $email = '';

    if( isset( $_POST['update'] ) ){
        $update_id = $_POST['update_id'];
        if( $_POST['first_name'] === '' ) {
            $error['fname'] = "First Name is required";
        } else {
            $first_name = $_POST['first_name'];
        }
        if( '' === $_POST['last_name'] ){
            $error['lname'] = "Last Name is required";
        } else{
            $last_name = $_POST['last_name'];
        }
        if( $_POST['email'] === '' ){
            $error['email'] = "Email is required";
        } else {
            $email = $_POST['email'];
        }
        if( empty($error) )
        {
            $sql = "UPDATE users SET first_name = '{$first_name}',last_name = '{$last_name}',email = '{$email}' WHERE user_id ={$update_id}";
            if( mysqli_query($conn,$sql) ){
                echo "User updated successfully";
                header("location:index.php");
            } 
            else {
                echo "Error Updating:". mysqli_error($conn);
                
            }
            mysqli_close($conn);
        }
        else {
            header('Location: edit_user.php?id="'.$update_id.'"');
        }
    }

?>

<div class="container">
<h2>Edit User</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="mb-3">
    <label for="firstname">First Name</label>
    <input type="text" name="first_name" class="form-control" value="<?php echo $user['first_name']; ?>">
    <span class="error"> <?php echo isset($error['fname']) ? $error['fname'] : ''; ?></span>
    </div>
    <div class="mb-3">
    <label for="lastname">Last Name</label>
    <input type="text" name="last_name" class="form-control" value="<?php echo $user['last_name']; ?>">
    <span class="error"><?php echo isset($error['lname']) ? $error['lname'] : ''; ?></span>
    </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
    <span class="error"><?php echo isset($error['email']) ? $error['email'] : ''; ?></span>
  </div>
  <button type="submit" name="update" class="btn btn-primary">Submit</button>
  <input type="hidden" name="update_id" value="<?php echo $user['user_id'];?>">
</form>
</div>

<!-- footer -->
<?php include_once 'includes/footer.php'; ?>