<!-- main start -->
<div id="main">
  <div class="container">
    <div class="row mt-4">
      <div class="col-sm-12">
        <h1 class="title font-color-light-blue text-center mb-0 mt-0">profile</h1>
        <div class="card-body  pt-0 pb-0 mt-4">
          <!-- form start -->
          <form id="frm_auth" data-view="register" method="POST" autocomplete="off"> 
            <div class="row pb-3">
              <div class="col-sm-3"></div>
              <div class="col-sm-6">
                <div class="form-group mb-1">
                  <label for="username" class="font-color-light-blue mb-0 font-color-gray">name</label>
                  <div class="input-icons"> 
                    <i class="m-auto fa fa-user icon"></i> 
                      <input id="username" readonly style="background-color:rgb(0,0,0,0)" required name="username" type="text" value="<?php echo $username; ?>" class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"> 
                  </div>                  
                </div>
                <div class="form-group mb-1">
                  <label for="pwd" class="font-color-light-blue mb-0 font-color-gray">new password</label>
                  <div class="input-icons"> 
                    <i class="m-auto fa fa-lock icon"></i> 
                      <input id="pwd" name="pwd" type="password" required value="<?php echo $default_pwd; ?>" class="form-control <?php echo $theme ? "brightly" : "darkly" ?>-form-control"> 
                  </div>                  
                </div>
                <div class="form-group mb-1">
                  <label for="confirm_pwd" class="font-color-light-blue mb-0 font-color-gray">confirm password</label> 
                  <div class="input-icons">
                    <i class="m-auto fa fa-lock icon"></i>
                    <input id="confirm_pwd" name="confirm_pwd" type="password" required value="<?php echo $default_pwd; ?>" class="form-control <?php echo $theme ? "brightly" : "darkly";?>-form-control">
                  </div>
                </div>
                <div class="form-group mb-1">
                  <label for="email" class="font-color-light-blue mb-0 font-color-gray">email</label> 
                  <div class="input-icons">
                    <i class="m-auto fa fa-envelope icon"></i>
                    <input id="email" name="email" type="email" required value="<?php echo $email; ?>" class="form-control <?php echo $theme ? "brightly" : "darkly"; ?>-form-control">
                  </div>
                </div>

                <div class="row justify-content-center mt-4">
                      <button id="btn_submit" type="submit" class="pl-5 pr-5 <?php echo $theme ? "brightly-btn" : "dark-purple-button"; ?>" data-view="register">save</button>
                  <!-- <?php if(!$is_member) {?>
                    <div class="col-lg-6">
                      <div class="form-group mb-3 mt-3">
                        <a href="<?php echo base_url();?>profile/join">
                          <button type="button" class="pl-5 pr-5 <?php echo $theme ? "brightly-btn" : "dark-purple-button"; ?>">join us</button>
                        </a>
                      </div>
                    </div>
                  <?php }?> -->
                </div>
              </div>
            </div>
          </form>
          <div class="row p-2 justify-content-center">
            <div class="col-lg-6 reg-description font-color-gray">
              <div class="font-color-gray p-2">
                  <?php
                    $str = "you are registered with us! <br>
                    If you wish to upgrade to
                    membership please select
                    from the options below";

                    if($is_member)
                    {
                      if($is_expired)
                      {
                        $str = "your membership has
                        expired.
                        Please top up or continue
                        with pay2play.";
                      } else {
                        $str = "your " . $current_membership->level_name . " membership
                        expires in " . $remain_days . " days.
                        It will not roll over
                        automatically";
                      }
                    }

                    echo $str;
                  ?>
              </div>
            </div>
          </div>
          <form id="frm_merbership" action="">
            <div class="row membership-part font-color-light-blue mt-4">
              <div class="col-sm-6 ml-auto mr-auto">
                    <div class="membership">
                        <h3 class="text-center mb-3">Choose your best option:</h3>
                        <div class="row">
                            <div class="col-lg-12 membership-indicator-container" style="display:flex; overflow:hidden; align-items:flex-end; background:url('<?php echo base_url(); ?>public/images/fuel-background.png')  no-repeat; background-size:contain; background-position: center !important">
                                <img id="indicator" src="<?php echo base_url(); ?>public/images/fuel-indicator-1.png" style="display:block; margin-left:auto; margin-right:auto;" class="membership-indicator" alt="">
                            </div>
                        </div>
                        <div class="row checkout-row mt-3 mb-3">
                            <div class="col"></div>
                            <div class="col-sm-9 p-0" align="center">
                                <input type="hidden" name="membership_id" id="membership_id" value="1">
                                <input type="hidden" name="membership_title" id="membership_title">
                                <input type="hidden" name="membership_amount" id="membership_amount">
                                <button type="button" id="checkout" class="<?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?>">Checkout</button>
                            </div>
                            <div class="col"></div>                                
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" style="min-height:100px">
                    <div class="membership-description text-center">
                        <?php 
                            $str = '';
                            if(sizeof($level) > 0){
                                foreach($level as $key=>$l){
                                    $str .= '<div class="plan d-none" data-id="'.$key.'" >';
                                    $str .= '<h3 class="title mt-5 mb-3">'.$l->level_name.'</h3>';
                                    $str .= '<div class="price mb-3">';
                                    $str .= '<span class="currency">$</span>';
                                    $str .= '<span class="amount">'.$l->price.'</span>';
                                    $str .= '<span class="end">/'.$l->timeline.'</span>';
                                    $str .= '</div>';
                                    $str .= '<div class="description mb-3">';
                                    $str .= $l->description;
                                    $str .='</div></div>';
                                }
                            }                                    
                            echo $str;
                        ?>                             
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  let plan_id = <?php echo $is_member ? ($current_membership->membership_id-1) : 0; ?>
</script>
            
    