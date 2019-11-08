<!-- main start -->
<div id="main">
  <div class="container">
    <div class="row mt-4">
      <div class="col-sm-12">
        <h1 class="title font-color-light-blue text-center mb-0 mt-0">register with us!</h1>
        <div class="card-body  pt-0 pb-0 mt-4">
          <!-- form start -->
          <form id="frm_auth" data-view="register" method="POST" autocomplete="off"> 
            <div class="row pb-3">
              <div class="col-sm-6">
                <div class="form-group mb-1">
                  <label for="username" class="font-color-light-blue mb-0 font-color-gray">name</label>
                  <div class="input-icons"> 
                    <i class="m-auto fa fa-user icon"></i> 
                      <input id="username" name="username" type="text" required class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control focus" autofocus> 
                  </div>                  
                </div>
                <div class="form-group mb-1">
                  <label for="pwd" class="font-color-light-blue mb-0 font-color-gray">password</label>
                  <div class="input-icons"> 
                    <i class="m-auto fa fa-lock icon"></i> 
                      <input id="pwd" name="pwd" type="password" required class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"> 
                  </div>                  
                </div>
                <div class="form-group mb-1">
                  <label for="confirm_pwd" class="font-color-light-blue mb-0 font-color-gray">confirm password</label> 
                  <div class="input-icons">
                    <i class="m-auto fa fa-lock icon"></i>
                    <input id="confirm_pwd" name="confirm_pwd" type="password" required class="form-control <?php echo $theme ? "brightly" : "darkly";?>-form-control">
                  </div>
                </div>
                <div class="form-group mb-1">
                  <label for="email" class="font-color-light-blue mb-0 font-color-gray">email</label> 
                  <div class="input-icons">
                    <i class="m-auto fa fa-envelope icon"></i>
                    <input id="email" name="email" type="email" required class="form-control <?php echo $theme ? "brightly" : "darkly"; ?>-form-control">
                  </div>
                </div>

                <div class="form-group mb-1 mt-3">
                  <button id="btn_submit" type="submit" class="pl-5 pr-5 <?php echo $theme ? "brightly-btn" : "dark-purple-button"; ?>" data-view="register">register</button>
                </div>                           
              </div>
              <div class="col-sm-6 ml-auto mr-auto">
                <div id="reg-description" class="reg-description row h-100">
                  <div class="col-sm-12 my-auto font-color-light-blue">
                    <div class="messages"> 
                      <?php echo isset($description1) ? nl2br($description1) : '' ; ?>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-sm-12">
                <div class="messages membership-ad p-2">
                  <?php echo isset($description2) ? nl2br($description2) : '' ; ?>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
            
    