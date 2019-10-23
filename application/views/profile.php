<!-- main start -->
<div id="main">
  <div class="container">
    <div class="row mt-4">
      <div class="col-sm-12">
        <h1 class="title font-color-light-blue text-center mb-0 mt-0">profile</h1>
        <div class="card-body  pt-0 pb-0 mt-4">
          <!-- form start -->
          <form id="frm_auth" data-view="register" method="POST" autocomplete="off" novalidate> 
            <div class="row pb-3">
              <div class="col-sm-6">
                <div class="form-group mb-1">
                  <label for="username" class="font-color-light-blue mb-0 font-color-gray">name</label>
                  <div class="input-icons"> 
                    <i class="m-auto fa fa-user icon"></i> 
                      <input id="username" readonly style="background-color:rgb(0,0,0,0)" name="username" placeholder="e.g. elite" type="text" value="<?php echo $username; ?>" class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"> 
                  </div>                  
                </div>
                <div class="form-group mb-1">
                  <label for="pwd" class="font-color-light-blue mb-0 font-color-gray">new password</label>
                  <div class="input-icons"> 
                    <i class="m-auto fa fa-lock icon"></i> 
                      <input id="pwd" name="pwd" type="password" value="<?php echo $default_pwd; ?>" class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"> 
                  </div>                  
                </div>
                <div class="form-group mb-1">
                  <label for="confirm-pwd" class="font-color-light-blue mb-0 font-color-gray">confirm password</label> 
                  <div class="input-icons">
                    <i class="m-auto fa fa-lock icon"></i>
                    <input id="confirm-pwd" name="confirm-pwd" type="password" value="<?php echo $default_pwd; ?>" class="form-control <?php echo $theme ? "brightly" : "darkly";?>-form-control">
                  </div>
                </div>
                <div class="form-group mb-1">
                  <label for="email" class="font-color-light-blue mb-0 font-color-gray">email</label> 
                  <div class="input-icons">
                    <i class="m-auto fa fa-envelope icon"></i>
                    <input id="email" name="email" placeholder="e.g. example@test.com" type="text" value="<?php echo $email; ?>" class="form-control <?php echo $theme ? "brightly" : "darkly"; ?>-form-control">
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group mb-1 mt-3">
                      <button id="btn_submit" type="submit" class="pl-5 pr-5 <?php echo $theme ? "brightly-btn" : "dark-purple-button"; ?>" data-view="register">save</button>
                    </div>
                  </div>
                  <?php if(!$is_member) {?>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 mt-3">
                        <a href="<?php echo base_url();?>auth/join">
                          <button type="button" class="pl-5 pr-5 <?php echo $theme ? "brightly-btn" : "dark-purple-button"; ?>">join us</button>
                        </a>
                      </div>
                    </div>
                  <?php }?>
                </div>
              </div>
              <div class="col-sm-6 ml-auto mr-auto">
                <div id="reg-description" class="reg-description row h-100">
                  <div class="col-sm-12 my-auto font-color-light-blue">
                    <div class="messages">                      
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-sm-12">
                  <div class="membership-ad pt-3">
                    <?php if($is_member) {
                      echo "Your membership will be expire at ".$membership_end_date;
                    } else {
                      echo "Please Join Us!!!";
                    }?>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
            
    