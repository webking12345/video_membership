    
                    <div class="row membership-part font-color-light-blue mt-4">
                        <div class="col-sm-6 ml-auto mr-auto">
                            <div class="membership">
                                <h3 class="text-center mb-3">Choose your best option:</h3>
                                <div class="row">
                                    <div class="col-lg-12 membership-indicator-container" style="display:flex; align-items:flex-end; background:url('<?php echo base_url(); ?>public/images/fuel-background.png')  no-repeat; background-size:contain; background-position: center !important">
                                        <img id="indicator" src="<?php echo base_url(); ?>public/images/fuel-indicator-1.png" style="display:block; margin-left:auto; margin-right:auto;" class="membership-indicator" alt="">
                                    </div>
                                </div>
                                <div class="row checkout-row mt-3 mb-3">
                                    <div class="col"></div>
                                    <div class="col-sm-9 p-0">
                                        <select id="currency" name="currency" class="browser-default custom-select w-auto <?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?>">
                                            <option value="£" selected>GBP</option>
                                            <option value="€">EURO</option>
                                            <option value="$">USD</option>
                                        </select>
                                        <input type="hidden" name="membership" id="membership_id" value="1">
                                        <button type="button" id="checkout" class="float-right <?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?>">Checkout</button>
                                    </div>
                                    <div class="col"></div>                                
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="min-height:100px">
                            <div class="membership-description text-center">
                                <div class="plan d-none" data-id="0" >
                                    <h3 class="title mt-5 mb-3">Please level up membership to purchase</h3>
                                </div>
                                <?php 
                                    $str = '';
                                    if(sizeof($level) > 0){
                                        $i=0;
                                        foreach($level as $key=>$l){
                                            $i++;
                                            $str .= '<div class="plan d-none" data-id="'.$i.'" >';
                                            $str .= '<h3 class="title mt-5 mb-3">'.$l["name"].'</h3>';
                                            $str .= '<div class="price mb-3">';
                                            $str .= '<span class="currency">£</span>';
                                            $str .= '<span class="amount">'.$l["price"].'</span>';
                                            $str .= '<span class="end">/'.$l["timeline"].'</span>';
                                            $str .= '</div>';
                                            $str .= '<div class="features mb-3"><ul>';
                                            foreach($feature as $key=>$f){
                                                $icon = "close";
                                                if(substr_count($l['feature'], $key)){
                                                    $icon = "check";
                                                }
                                                $str .= '<li id="'.$key.'"><i class="fa fa-'.$icon.'"></i><span class="ml-3">'.$f.'</span></li>';
                                            }
                                            $str .='</ul></div></div>';
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
