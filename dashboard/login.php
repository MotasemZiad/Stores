<?php
  include_once('db/db_connection.php');
  $errors = [];
  $success = false;
  if($_SERVER['REQUEST_METHOD'] == "POST"){
      $email = $_POST['email'];
      $password = md5($_POST['password']);

      if(empty($email)){
        $errors["email_error"] = "Email is required!";
      }
      if(empty($password)){
        $errors["password_error"] = "Password is required!";
      }

      if(count($errors) > 0){
        $errors['general_error'] = "Please fill fields";
      }else {
        $query = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) > 0){
            session_start();
            $_SESSION['is_login'] = true;
            $errors = [];
            $success = true;
            header('Location: index.php');
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
                    <span>Login with Modern</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <?php
                      if(!empty($errors['general_error'])){
                        echo "<div class='alert alert-danger'>". $errors['general_error']. "</div>";
                      }elseif($success){
                        echo "<div class='alert alert-success'> User login successfully</div>";
                      }
                    ?>
                    <form class="form-horizontal form-simple" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
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
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg input-lg" id="user-password"
                        placeholder="Enter Password" required name="password">
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                        <?php
                            if(!empty($errors['password_error'])){
                              echo "<span class='text-danger'>". $errors['password_error']. "</span>";
                            }
                        ?>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                          <fieldset>
                            <input type="checkbox" id="remember-me" class="chk-remember">
                            <label for="remember-me"> Remember Me</label>
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12 text-center text-md-right"><a href="#" class="card-link">Forgot Password?</a></div>
                      </div>
                      <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                    </form>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="">
                    <p class="float-sm-left text-center m-0"><a href="#" class="card-link">Recover password</a></p>
                    <p class="float-sm-right text-center m-0">New to Modern Admin? <a href="register.php" class="card-link">Register</a></p>
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