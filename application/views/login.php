<!-- main start -->
<div id="main">
  <div class="container">
    <div class="row mt-4">
      <div class="col-sm-12">
        <h1 class="title font-color-light-blue text-center mb-0 mt-0">login</h1>
        <div class="card-body  pt-0 pb-0 mt-4">
          <!-- form start -->
          <form id="frm_auth" data-view="login" method="POST" autocomplete="off" novalidate> 
            <div class="row pb-3">
              <div class="col-sm-6">
                <div class="form-group mb-1">
                  <label for="username" class="font-color-light-blue mb-0 font-color-gray">name</label>
                  <div class="input-icons"> 
                    <i class="m-auto fa fa-user icon"></i> 
                      <input id="username" name="username" placeholder="e.g. elite" type="text" required="required" class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"> 
                  </div>                  
                </div>
                <div class="form-group mb-1">
                  <label for="pwd" class="font-color-light-blue mb-0 font-color-gray">password</label>
                  <div class="input-icons"> 
                    <i class="m-auto fa fa-lock icon"></i> 
                      <input id="pwd" name="pwd" type="password" required="required" class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"> 
                  </div>                  
                </div>

                <div class="form-group mb-1 mt-3">
                  <button id="btn_submit" type="submit" class="pl-5 pr-5 <?php echo $theme ? "brightly-btn" : "dark-purple-button"; ?>" data-view="login">login</button>
                </div>                           

                <div class="join-now-btn mt-5">
                  <a href="<?php echo base_url();?>auth/join"><button type="button" class="<?php echo $theme ? "brightly-btn" : "dark-purple-button"; ?> w-100" >join us!</button></a>
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
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
            
    