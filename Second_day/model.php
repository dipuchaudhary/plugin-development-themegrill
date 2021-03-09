<?php

class Model {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "todo";
    private $conn;
    public $error;

    // connection
    public function __construct() {
       try{
           $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
           
       } catch(Exception $e) {
           echo "Connection failed:" .$e->getMessage();
       }
        
    }

    public function Addtask() {
        if( isset ($_POST['submit'] ) ) {
            if(empty($_POST['task'])){
                $this->error='Please fill the task';
            }
          else {
                $task_name = $_POST['task'];
                $sql = "INSERT INTO tasks(task_name) VALUES('$task_name')";
                $this->conn->query($sql);
                header("location: index.php");
            }
        }
        
    }
   

    public function showTask() {
        $query = "SELECT * FROM tasks";
        $result = $this->conn->query($query);
        
        $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

        return $rows;
    }

    public function edit($id) {
        $sql = "SELECT * FROM tasks WHERE id = $id";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function update($name,$id) {
        $sql = "UPDATE tasks SET task_name = '$name' WHERE id = $id";
        $this->conn->query($sql);
        header('Location:index.php');
    }

    public function deleteTask($id) {
        $sql = "DELETE FROM tasks WHERE id= $id";
        $this->conn->query($sql);
        header('Location: index.php');
    }

}


?>