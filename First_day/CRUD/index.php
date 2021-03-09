<!-- include connection -->
<?php include_once 'includes/db.php'; ?>
<!-- header -->
<?php include_once 'includes/header.php';?>

<!-- nav section -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PHP CRUD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="add_user.php">Add User</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<!-- show user list -->
<?php include_once 'show_user.php';?>
<!-- footer -->
<?php include_once 'includes/footer.php'; ?>