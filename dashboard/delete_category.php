<?php 
    include_once('db/db_connection.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $query = "DELETE FROM categories WHERE id = $id";
            $result =  mysqli_query($connection, $query);

            if($result){
                header('Location: show_all_categories.php');
            }
        }else {
            echo "ERROR";
        }
    }
?>