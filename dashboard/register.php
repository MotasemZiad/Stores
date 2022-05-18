<?php 
  include_once('db/db_connection.php');
  $errors = [];
  $success = false;
  if($_SERVER['REQUEST_METHOD'] == "POST"){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = md5($_POST['password']); // md5 for hashing the password
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $description = $_POST['description'];
      $status = 1;

      if(empty($username)){
        $errors["username_error"] = "Username is required!";
      }
      if(empty($email)){
        $errors["email_error"] = "Email is required!";
      }
      if(empty($password)){
        $errors["password_error"] = "Password is required!";
      }
      if(empty($phone)){
        $errors["phone_error"] = "Mobile Phone is required!";
      }
      if(empty($address)){
        $errors["address_error"] = "Address is required!";
      }
      if(empty($description)){
        $errors["description_error"] = "Description is required!";
      }

      if(count($errors) > 0){
        $errors['general_error'] = "Please fill fields";
      }else {
        $query = "INSERT INTO admins(username, email, password, phone, address, status, description) VALUES('$username', '$email', '$password', '$phone', '$address', '$status', '$description')";
        $result = mysqli_query($connection, $query);
        if($result){
            $errors = [];
            $success = true;
            header('Location: login.php');
        }else {
            $errors['general_error'] = "Error". mysqli_error($connection);
        }  
      }
  }
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<?php include_once('shared/header.php'); ?>

<body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">
                      <img src="../dashboard/app-assets/images/logo/logo-dark.png" alt="branding logo">
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Register with Modern</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <?php
                      if(!empty($errors['general_error'])){
                        echo "<div class='alert alert-danger'>". $errors['general_error']. "</div>";
                      }elseif($success){
                        echo "<div class='alert alert-success'> User registered successfully</div>";
                      }
                    ?>
                    <form class="form-horizontal form-simple" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" class="form-control form-control-lg input-lg" id="username" placeholder="Your Username"
                        required name="username">
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                        <?php
                          if(!empty($errors['username_error'])){
                            echo "<span class='text-danger'>". $errors['username_error']. "</span>";
                          }
                        ?>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" class="form-control form-control-lg input-lg" id="email" placeholder="Your Email"
                        required name="email">
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                        <?php
                          if(!empty($errors['email_error'])){
                            echo "<span class='text-danger'>". $errors['email_error']. "</span>";
                          }
                        ?>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="password" class="form-control form-control-lg input-lg" id="password"
                        placeholder="Your Password" required name="password">
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                        <?php
                          if(!empty($errors['password_error'])){
                            echo "<span class='text-danger'>". $errors['password_error']. "</span>";
                          }
                        ?>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" class="form-control form-control-lg input-lg" id="phone" placeholder="Your Phone"
                        required name="phone">
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                        <?php
                          if(!empty($errors['phone_error'])){
                            echo "<span class='text-danger'>". $errors['phone_error']. "</span>";
                          }
                        ?>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" class="form-control form-control-lg input-lg" id="address" placeholder="Your Address"
                        required name="address">
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                        <?php
                          if(!empty($errors['address_error'])){
                            echo "<span class='text-danger'>". $errors['address_error']. "</span>";
                          }
                        ?>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control form-control-lg input-lg" id="description" placeholder="Your Description"
                        required name="description">
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                        <?php
                          if(!empty($errors['description_error'])){
                            echo "<span class='text-danger'>". $errors['description_error']. "</span>";
                          }
                        ?>
                      </fieldset>
                      <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Register</button>
                    </form>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="">
                    <p class="float-sm-right text-center m-0">Already have an account? <a href="login.php" class="card-link">Login</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="../dashboard/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="../dashboard/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="../dashboard/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="../dashboard/app-assets/js/core/app.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="../dashboard/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>