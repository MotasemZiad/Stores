<?php
    include_once("db/db_connection.php");
    $errors = [];
    $success = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $category_id = $_POST['category_id'];

        # Image 
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];
        $file_tmp_name = $_FILES['image']['tmp_name'];

        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_random_name = time() . rand(1, 10000) . ".$file_extension"; // file_random_name is actually an image
        $upload_path = 'uploads/images/' . $file_random_name;
        move_uploaded_file($file_tmp_name, $upload_path);

        if(empty($name)){
          $errors["name_error"] = "Name is required!";
        }
        if(empty($address)){
          $errors["address_error"] = "Description is required!";
        }
        if(empty($phone)){
          $errors["phone_error"] = "First Price is required!";
        }

        if(count($errors) > 0){
          $errors['general_error'] = "Please fill fields";
        }else {
          $query = "UPDATE stores SET name='$name', address='$address', phone='$phone', category_id='$category_id', image='$file_random_name' WHERE id='".$_GET['id']."' ";
          $result = mysqli_query($connection, $query);
          if($result){
              $errors = [];
              $success = true;
              header('Location: show_all_stores.php');
          }else {
              $errors['general_error'] = "Error". mysqli_error($connection);
          }  
        }
    }
    
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      $query = "SELECT * FROM stores WHERE id = $id"; 
      $result = mysqli_query($connection, $query);
      $row = mysqli_fetch_assoc($result);
    }

    // Finish all the tasks except the image part
?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<?php include_once("shared/header.php"); ?>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern"
  data-col="2-columns">
  <?php 
  include_once("shared/nav.php"); 
  include_once("shared/side_bar.php");
  ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row"> 
      </div>
      <div class="content-body">
      <section id="basic-form-layouts">
          <div class="row match-height">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="basic-layout-form">Store Info</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                  <?php
                    if(!empty($errors['general_error'])){
                      echo "<div class='alert alert-danger'>". $errors['general_error']. "</div>";
                    }elseif($success){
                      echo "<div class='alert alert-success'> Product updated successfully</div>";
                    }
                  ?>
                    <form class="form" method="POST" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] . "?id=$id" ?>">
                      <div class="form-body">
                        <h4 class="form-section"><i class="ft-user"></i>Edit store</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput1">Name</label>
                              <input type="text" id="projectinput1" class="form-control" placeholder="Enter the name of the store"
                              name="name" value="<?php echo $row['name'] ?>">
                              <?php
                                if(!empty($errors['name_error'])){
                                  echo "<span class='text-danger'>". $errors['name_error']. "</span>";
                                }
                              ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput2">Address</label>
                              <input type="text" id="projectinput2" class="form-control" placeholder="Enter the address of the store"
                              name="address" value="<?php echo $row['address'] ?>">
                              <?php
                                if(!empty($errors['address_error'])){
                                  echo "<span class='text-danger'>". $errors['address_error']. "</span>";
                                }
                              ?>
                            </div>
                          </div>
                        </div>
                         <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput1">Phone Number</label>
                              <input type="text" id="projectinput1" class="form-control" placeholder="Enter the phone of the store"
                              name="phone" value="<?php echo $row['phone'] ?>">
                              <?php
                                if(!empty($errors['phone_error'])){
                                  echo "<span class='text-danger'>". $errors['phone_error']. "</span>";
                                }
                              ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput2">Category</label>
                              <select class="form-control" name="category_id">
                              <?php
                                include_once('db/db_connection.php');
                                $query = 'SELECT * FROM categories';
                                $result = mysqli_query($connection, $query);
                                while($category_row = mysqli_fetch_assoc($result)){
                                    echo '<option value='. $category_row['id'] .'>' . $category_row['name'] . '</option>';
                                }
                              ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput1">Image</label>
                              <input type="file" id="projectinput1" class="form-control"
                              name="image" value="<?php echo $row['image'] ?>">
                              <?php
                                if(!empty($errors['image_error'])){
                                  echo "<span class='text-danger'>". $errors['image_error']. "</span>";
                                }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            Update 
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
         </div>
    </div>
  </div>
        <?php include_once("shared/footer.php"); ?>
    </body>
</html>