<?php
    include_once('db/db_connection.php');
    $errors = [];
    $success = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['category_name'];

        if(empty($name)){
          $errors["name_error"] = "Name is required!";
        }

        if(count($errors) > 0){
          $errors['general_error'] = "Please fill fields";
        }else {
          $query = "INSERT INTO categories(name) VALUES('$name')";
          $result = mysqli_query($connection, $query);
          if($result){
              $errors = [];
              $success = true;
              header('Location: show_all_categories.php');
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
                  <h4 class="card-title" id="basic-layout-form">Category Info</h4>
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
                    <form class="form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                      <div class="form-body">
                        <h4 class="form-section"><i class="ft-user"></i>Add a new category</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput1">Category Name</label>
                              <input type="text" id="projectinput1" class="form-control" placeholder="Category Name"
                              name="category_name">
                              <?php
                                if(!empty($errors['name_error'])){
                                  echo "<span class='text-danger'>". $errors['name_error']. "</span>";
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