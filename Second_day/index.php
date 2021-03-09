<?php
     include_once 'model.php';
    $model = new Model();
    $model->Addtask();
    $datas = $model->showTask();

    if(isset ($_GET['delete'])) {
        $id = $_GET['delete'];
        $model->deleteTask($id);
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Todos</title>
  </head>
  <body>
    <h1 class="text-center">Todos with PHP OOP AND MYSQL</h1>
    <div class="container mt-3">
        <form action="" method="post">
            <div class="input-group mb-2">
            <input type="text" name="task" class="form-control" placeholder="Enter task">
            <input class="btn btn-success" name="submit" type="submit" value="Add Task">
            </div>
            <span class="error"><?php echo isset($error['task']) ?? '' ?></span>
        </form>
    </div>


    <div class="container mt-5">
    <table class="table table-striped table-hover">
    <thead>
    <tr>
    <th>S.N</th>
    <th>Task</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($datas as $data): ?>
            <tr>
            <td><?php echo $data['id'];?></td>
            <td><?php echo $data['task_name'];?></td>
            <td><a class="btn btn-primary" href="edit.php?edit=<?php echo $data['id'];?>">Edit</a></td>
            <td><a class="btn btn-danger" href="index.php?delete=<?php echo $data['id'];?>">Delete</a></td>
            
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>