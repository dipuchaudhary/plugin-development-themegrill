
<!-- delete user -->
<?php
    if( isset ($_GET['delete'] ) ) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM users WHERE user_id = {$id}";
        mysqli_query($conn,$sql);
        header('Location: index.php');
    }
    
?>

<div class="container">
<table class="table table-striped table-hover">
  <thead>
    <th>User_id</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Action</th>
  </thead>
  <tbody>
 <!-- fetch userlist -->
<?php

$sql = "SELECT * FROM users";
$results = mysqli_query($conn,$sql);

    if(mysqli_num_rows($results) > 0) {
       while( $user = mysqli_fetch_assoc($results)){?>
          <tr>
            <td> <?php echo $user['user_id']; ?></td>
            <td> <?php echo $user['first_name']; ?></td>
            <td> <?php echo $user['last_name']; ?></td>
            <td> <?php echo $user['email']; ?></td>
            <td> 
            <a class="btn btn-primary" href="edit_user.php?id=<?php echo $user['user_id']; ?>">Edit</a>
            <a class="btn btn-danger" href="index.php?delete=<?php echo $user['user_id']; ?>">Delete</a>
            </td>
            </tr>
        <?php
       }
    }
    else {
        echo "<tr class='text-center'><td colspan='5'>no data found!</td></tr>";
    }

?>
 
  </tbody>
</table>
</div>