<?php
    include_once('db/db_connection.php');
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
          $errors["address_error"] = "Address is required!";
        }
        if(empty($phone)){
          $errors["phone_error"] = "Phone number is required!";
        }
        // if($file_size > 20000){
        //   $errors["image_error"] = "Image is too large!";
        // }
        // if($file_type != "png" || $file_type != "jpg" || $file_type != "jpeg"){
        //   $errors["image_error"] = "Image must be from type png or jpg!";
        // }


        if(count($errors) > 0){
          $errors['general_error'] = "Please fill fields";
        }else {
          $query = "INSERT INTO stores(name, address, phone, image, category_id) VALUES('$name', '$address', '$phone', '$file_random_name', '$category_id')";
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
                      echo "<div class='alert alert-success'> Category added successfully</div>";
                    }
                  ?>
                    <form class="form" method="POST" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>">
                      <div class="form-body">
                        <h4 class="form-section"><i class="ft-user"></i>Add a new store</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput1">Name</label>
                              <input type="text" id="projectinput1" class="form-control" placeholder="Enter the name of the store"
                              name="name">
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
                              name="address">
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
                              <input type="text" id="projectinput1" class="form-control" placeholder="Enter the phone number of the store"
                              name="phone">
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
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<option value='. $row['id'] .'>' . $row['name'] . '</option>';
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
                              name="image">
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
                            Add 
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