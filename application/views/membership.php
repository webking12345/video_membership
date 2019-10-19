    
                    <div class="row membership-part font-color-light-blue mt-4">
                        <div class="col-sm-6 ml-auto mr-auto">
                            <div class="membership " >
                                <h3 class="text-center mb-3">Choose your best option:</h3>
                                <div class="row">
                                    <div class="col"></div>                         
                                    <div class="col-sm-9 membership-btn">
                                        <div class="row">
                                            <div class="col-4 col-sm-4 m-btn img-container p-0" data-btn="1" data-active=0 id="membership-1">
                                                <img class="w-100" src="<?php echo base_url(); ?>public/images/default-button.png" alt="button-1">
                                                <div class="membership-num img-txt">1</div>
                                            </div>
                                            <div class="col-4 col-sm-4 p-0">
                                                <img class="w-100" src="<?php echo base_url(); ?>public/images/dot-line.png" alt="dot-line">
                                            </div>
                                            <div class="col-4 col-sm-4 m-btn img-container p-0" data-btn="2" data-active=0 id="membership-2">
                                                <img class="w-100" src="<?php echo base_url(); ?>public/images/default-button.png" alt="button-2">
                                                <div class="membership-num img-txt">2</div>
                                            </div>
                                        </div>
                                        <div class="row btn2">
                                            <div class="col-4 col-sm-4 p-0">
                                                <img class="w-100" src="<?php echo base_url(); ?>public/images/dot-line-vertical.png" alt="dot-line-vertical">
                                            </div>
                                            <div class="col-4 col-sm-4"></div>
                                            <div class="col-4 col-sm-4 p-0">
                                                <img class="w-100" src="<?php echo base_url(); ?>public/images/dot-line-vertical.png" alt="dot-line-vertical">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-sm-4 m-btn img-container p-0" data-btn="3" data-active=0 id="membership-3">
                                                <img class="w-100" src="<?php echo base_url(); ?>public/images/default-button.png" alt="button-3">
                                                <div class="membership-num img-txt">3</div>
                                            </div>
                                            <div class="col-4 col-sm-4 p-0">
                                                <img class="w-100" src="<?php echo base_url(); ?>public/images/dot-line.png" alt="dot-line">
                                            </div>
                                            <div class="col-4 col-sm-4 m-btn img-container p-0" data-btn="4" data-active=0 id="membership-4">
                                                <img class="w-100" src="<?php echo base_url(); ?>public/images/default-button.png" alt="button-4">
                                                <div class="membership-num img-txt">4</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                </div>
                                <div class="row checkout-row mt-3">
                                    <div class="col"></div>
                                    <div class="col-sm-9 p-0">
                                        <select id="currency" name="currency" class="browser-default custom-select w-auto <?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?>">
                                            <option value="£" selected>GBP</option>
                                            <option value="€">EURO</option>
                                            <option value="$">USD</option>
                                        </select>
                                        <input type="hidden" name="membership" id="membership_id" value="1">
                                        <button id="submit" type="button" id="checkout" class="float-right <?php echo ($theme ? "brightly-btn" : "dark-purple-button") ?>">Checkout</button>
                                    </div>
                                    <div class="col"></div>                                
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="membership-description text-center">
                                <?php 
                                    $str = '';
                                    if(sizeof($level) > 0){
                                        foreach($level as $key=>$l){
                                            $str .= '<div class="priceing-card d-none" data-id="'.$key.'" >';
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
                                
                                <!-- <div class="whole w-100" data-mem-id="1">
                                    <div class="type">
                                        <p>level 1</p>
                                    </div>
                                    <div class="plan">
                                        <div class="header">
                                            <span>$</span>00<sup>00</sup>
                                            <p class="month">per month</p>
                                        </div>
                                        <div class="content">
                                            <ul>
                                                <li id="1"><i class="fa fa-check"></i><span class="ml-3">feature1</span></li>
                                                <li id="2"><i class="fa fa-check"></i><span class="ml-3">feature2</span></li>
                                                <li id="3"><i class="fa fa-close"></i><span class="ml-3">feature3</span></li>
                                                <li id="4"><i class="fa fa-close"></i><span class="ml-3">feature4</span></li>
                                                <li id="5"><i class="fa fa-close"></i><span class="ml-3">feature5</span></li>
                                                <li id="6"><i class="fa fa-close"></i><span class="ml-3">feature6</span></li>
                                                <li id="7"><i class="fa fa-close"></i><span class="ml-3">feature7</span></li>
                                            </ul>
                                        </div>                                 
                                        <div class="price">
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>  
