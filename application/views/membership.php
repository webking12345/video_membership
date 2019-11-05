    
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
                                        <button type="submit" class="<?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?>">Checkout</button>
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
