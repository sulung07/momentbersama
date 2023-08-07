<?php
$template = new templateControllerPanel();
$template->head($pages , array());


?>

<div class="account-pages mt-5 mb-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-pattern">

          <div class="card-body p-4">

            <div class="text-center w-75 m-auto">
            <div class="auth-logo">
              <a href="" class="logo logo-dark text-center">
              <span class="logo-lg">
              <img src="/assets/images/eirenesolutions150.png">
              </span>
              <h4>WEDDING CONSOLE  <br> by eirenesolutions.id </h4>
              </a>
              <a href="" class="logo logo-light text-center">
              <span class="logo-lg">
              <img src="/assets/images/eirenesolutions150.png">
              </span>
              <h4>WEDDING CONSOLE  <br> by eirenesolutions.id </h4>

              </a>
            </div>

            <p class="text-muted mb-4 mt-3">Enter your Username and password to access system.</p>


            </div>

            <form  method="post">

              <div class="form-group mb-3">
                  <label for="emailaddress">Email address</label>
                  <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email" <?php if(isset($_COOKIE['userMail'])){ ?> value="<?= $_COOKIE['userMail'] ?>" <?php } ?>>
              </div>

              <div class="form-group mb-3">
                  <label for="password">Password</label>
                  <div class="input-group input-group-merge">
                  <input type="password" name="password" id="password" required="" class="form-control" placeholder="Enter your password" <?php if(isset($_COOKIE['userPass'])){ ?> value="<?= $_COOKIE['userPass'] ?>" <?php } ?> >
                  <div class="input-group-append" data-password="false">
                      <div class="input-group-text">
                      <span class="password-eye"></span>
                      </div>
                  </div>
                  </div>
              </div>

              <div class="form-group mb-3">
                  <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" id="checkbox-signin" checked>
                  <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                  </div>
              </div>

              <div class="form-group mb-0 text-center">
              <button name="login" class="btn btn-dark btn-block font-weight-bold" type="submit"> Log In </button>
              </div>

            </form>

            <?php if(isset($_POST['login'])){
                            $this->getAction( 'actionLogRegister' , 'user-console/logregister')->actioncontrol($arr = array("signin"));
                        } 
                        ?>


          </div> <!-- end card-body -->
        </div>

      <!-- <div class="row mt-3">

        <div class="col-12 text-center">
            <p> <a href="/forgetpassword" class="text-secondary-50 ml-1">Forgot your password?</a></p>
            <p class="text-white-50"><a href="/verification" class="text-secondary ml-1"><button style="padding:10px 30px;"><b>Activation New Card</b></button></a></p>
        </div>
      </div> -->

    </div>
  </div>
  </div>
  </div>
<!-- end page -->

        <?php       
$template->footer($pages , array("dataTables" , "dataForms")); 
?>