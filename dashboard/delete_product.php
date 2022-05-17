<?php 
    include_once('db/db_connection.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $query1 = "SELECT * FROM products WHERE id = $id";
            $result = mysqli_query($connection, $query1);
            while($row = mysqli_fetch_assoc($result)){
                unlink('uploads/images/' . $row['image']);
            }

            $query = "DELETE FROM products WHERE id = $id";
            $result =  mysqli_query($connection, $query);
            if($result){
                header('Location: show_all_products.php');
            }
        }else {
            echo "ERROR";
        }
    }
?>